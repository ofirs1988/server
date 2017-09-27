<?php
namespace App\Interfaces\User;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\UserIfno;
use JWTAuth;
use Tymon\JWTAuth\JWTException;

class UserEloquent implements \App\Interfaces\User\UserInterface {

    protected $user;

    function __construct(User $u)
    {
        $this->user = $u;
    }

    public function BaseAuthLogin($request,$param)
    {
        $credentials = $request->only('email', 'password');
        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return ['success' => false , 'massage' => 'invalid_credentials'];
            }
        } catch (JWTException $e) {
            // something went wrong
            return ['success' => false , 'massage' => 'could_not_create_token'];
        }
        try {
            if($user = JWTAuth::toUser($token)){
                if($user->active){
                    if($param){
                        return $this->isAuthorizedAdmin($user,$token);
                    }
                    $user = $user->with('roles')->where('id',$user->id)->get();
                    $permissions = $user[0]['roles'];
                    $permissionsList = $this->setPermissions($permissions);
                    if(is_array($permissionsList))
                        return ['success' => true, 'token' => $token,'user' => $user
                            , 'permissions' => $permissionsList];
                    else
                        return ['success' => false , 'massage' => 'user not permissions'];
                }else{
                    return ['success' => false , 'massage' => 'user not active'];
                }
            }
        } catch (JWTException $e) {
            return ['success' => false , 'massage' => $e->getMessage()];
        }
    }


    public function isAuthorized($param)
    {
        $token = JWTAuth::getToken();
        if(!$token)
            return ['success' => false ,'massage'=> 'Token not provided'];
        try{
            JWTAuth::refresh($token);
        }catch(TokenInvalidException $e){
            return ['success' => false ,'massage'=> 'The token is invalid'];
        }
        $user = JWTAuth::toUser($token);
        if($param){
            return $this->isAuthorizedAdmin($user,$token);
        }
        $userRole = JWTAuth::parseToken()->authenticate()->with('roles')->where('id',$user->id)->get();
        $permissionsList = $this->setPermissions($userRole[0]['roles']);
        return ['success' => true,'permissions' => $permissionsList];
    }


    protected function isAuthorizedAdmin($user,$token){
        $userData = $user->with('roles')->with('usersCompany')->where('id',$user->id)->get();
        if($userData[0]->usersCompany[0]['id']){
            $permissionsList = $this->setPermissions($userData[0]['roles']);
            if($permissionsList){
                return ['success' => true,'permissions' => $permissionsList,
                    'company' => $userData[0]->usersCompany[0],'user' => $user,'token' => $token];
            }
        }
    }

    protected function setPermissions($permissions){
        $permissionsList = [];
        foreach ($permissions AS $permission){
            $permissionsList[$permission->name] = ['permissions' => $permission->permissions];
        }
        return $permissionsList;
    }

    public function setActiveUser($id,$active)
    {
        return $this->user->ActiveUser($id,$active);
    }

    public function setRole($user,$role){
        $user->roles()->attach($role);
    }

    public function setUser($request)
    {
        $user = new \stdClass();
        //user table

        if(is_array($request))
            $request = (object) $request;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        //$user->remember_token = $request->token ? $request->token : null;
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->phone = isset($request->phone) ? $request->phone : null;
        $user->active = isset($request->active) ? $request->active : 0;
        $user->token = $this->getToken(73);
        $user->fid = isset($request->id) ? $request->id : null;
        $user->name = isset($request->name) ? $request->name : '';
        //$user->avatar = isset($request->avatar)  ? $request->avatar : ProfilePicDefault;
        $user->avatar = isset($request->avatar)  ? $request->avatar : app_path().'/assets/images/user.png';
        $user->type = isset($request->type) ? $request->type : null;
        $user->age =  isset($request->age)  ? $request->age : null;
        $user->city =  isset($request->city)  ? $request->city : null;
        $user->address = isset($request->address)  ? $request->address : null;
        $user->hometown = isset($request->hometown)  ? $request->hometown : null;
        $user->education = isset($request->education)  ? $request->education : null;
        $user->gender =  isset($request->gender)  ? $request->gender : null;
        $user->website = isset($request->website)  ? $request->website : null;
        $user->work = isset($request->work)  ? $request->work : null;
        if(is_object ($user)){
            return $this->createUser($user);
        }
        else
            return response()->json(array('success' => false , 'massage' => 'user is not object'), 201);
    }

    protected function createUser($request)
    {
        if($request){
            if(is_array($request))
                $request = (object) $request;
                $user = new User();
                $user->email = $request->email;
                $user->name = $request->name;
                $user->password = $request->password;
                $user->remember_token = $request->token;
                $user->created_at = date('Y-m-d H:i:s');
                $user->updated_at = date('Y-m-d H:i:s');
                $user->phone = $request->phone;
                $user->avatar = $request->avatar;
                $user->active = $request->active  ? $request->active : 0;
                $user->fid = $request->fid;
                if($user->save()){
                    $role = isset($request->role) ? $request->role : 1;
                    $this->setRole($user,$role);
                    $userInfo = new UserIfno();
                    $userInfo->user()->associate($user->id);
                    $userInfo->age =  $request->age;
                    $userInfo->city =  $request->city;
                    $userInfo->address = $request->address;
                    $userInfo->hometown = $request->hometown;
                    $userInfo->education = $request->education;
                    $userInfo->gender =  $request->gender;
                    $userInfo->website = $request->website;
                    $userInfo->work = $request->work;
                    $userInfo->save();
                }
                return $user;
        }
    }

    public function UpdateUserLogin()
    {
        $user = new User();
        $user->updated_at = Date('Y-m-d H:i:s');
        if(!$user->save()){
            return 'error update';
        }
    }

    public function getToken($length = 73)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }
        return $token;
    }

    //    public function getAll()
//    {
//        return $this->user->getAllUsers();
//    }
//
//    public function getByAddress($address)
//    {
//        //return $this->user->getUserByAddress($address);
//    }
//
//    public function getByEmail($email)
//    {
//        return $this->user->getUserByEmail($email);
//    }
//
//    public function getByFid($fid)
//    {
//        return $this->user->getUserByFid($fid);
//    }
//
//    public function getById($id)
//    {
//        return $this->user->getUserById($id);
//    }
//
//    public function getByName($name)
//    {
//        return $this->user->getUserByName($name);
//    }
//
//    public function getUser($id)
//    {
//
//    }

}