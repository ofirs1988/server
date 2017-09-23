<?php
namespace App\Interfaces\User;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\UserIfno;
use JWTAuth;
use Tymon\JWTAuth\JWTException;

class UserEloquent implements \App\Interfaces\User\UserInterface {

    protected $user;

    function __construct(User $u)
    {
        $this->user = $u;
    }

    public function isAuthorized()
    {
        $token = JWTAuth::getToken();
        if(!$token)
            return ['success' => false ,'massage'=> 'Token not provided'];
        try{
            JWTAuth::refresh($token);
        }catch(TokenInvalidException $e){
            return ['success' => false ,'massage'=> 'The token is invalid'];
        }
        return ['success' => true];
    }


    public function BaseAuthLogin($request)
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
                   $user = $user->with('roles')->get();
                   return ['success' => true, 'token' => $token,'user' => $user];
                   //return response()->json(compact('token','user'));
               }else{
                   return ['success' => false , 'massage' => 'user not active'];
               }
            }
        } catch (JWTException $e) {
            return ['success' => false , 'massage' => $e->getMessage()];
        }

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
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = $request->token;
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
        //user role table
        //$user->role_id = !$request->role  ? 0 : $request->role;
        //user info table
        $user->age =  isset($request->age)  ? $request->age : null;
        $user->city =  isset($request->city)  ? $request->city : null;
        $user->address = $request->address  ? $request->address : null;
        $user->hometown = $request->hometown  ? $request->hometown : null;
        $user->education = $request->education  ? $request->education : null;
        $user->gender =  isset($request->gender)  ? $request->gender : null;
        $user->website = $request->website  ? $request->website : null;
        $user->work = $request->work  ? $request->work : null;
        if(is_object ($user))
            return $user;
        else
            return response()->json(array('success' => false , 'massage' => 'user is not object'), 201);
    }

    public function createUser($request)
    {
        if($request){
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