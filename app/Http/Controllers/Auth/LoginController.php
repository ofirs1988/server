<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\JWTException;
use App\Interfaces\User\UserInterface AS UserInterface;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    protected $userObject;
    protected $redirectTo = '/';
    const ADMIN = true;
    const SITE = false;

    public function __construct(UserInterface $u)
    {
        $this->middleware('guest')->except('logout');
        $this->userObject = $u;
    }

    public function index(Request $request)
    {
        if ($request->social){
            $data = $this->LoginWhitSocial($request);
            if(is_array($data)){
                if($data['token']){
                    $success = true;
                    $token = $data['token'];
                    $user = $data['user'];
                    return response()->json(compact('success','token','user'));
                }
                return response()->json(compact('token'));
            }

            else
                return response()->json(array('success' => false, 'massage' => $data['token']['massage']), 203);
        }
        else
            return $this->LoginRegular($request);
    }

    public function LoginWhitSocial($request){
        //check if user social login
        $user_social = User::where(function ($q) use ($request){$q->where('fid',$request->id)
            ->OrWhere('gid',$request->id);})->first();
        if($user_social)
            return ['token' => JWTAuth::fromUser($user_social),'user' => $user_social];
        else{
            if($check_email = User::where('email',$request->email)->first()){
                $check_email->fid = $request->id;
                $check_email->save();
                return ['token' => JWTAuth::fromUser($check_email),'user' => $check_email];
            }else
                return app(\App\Http\Controllers\Auth\RegisterController::class)->RegisterScoial($request);
        }
    }

    public function LoginRegular($request){
        $result = $this->userObject->BaseAuthLogin($request,self::SITE);
        if(isset($result['token'])){
            $user = $result['user'][0];
            $token = $result['token'];
            $success = $result['success'];
            return response()->json(compact('success','token','user'));
        }else{
            return $result;
        }
    }

    public function LoginAdmin(Request $request){
        $result = $this->userObject->BaseAuthLogin($request,self::ADMIN);
        $rolesArray = ['Administrator','Author','Editor'];
        if(isset($result['token'])){
            $user = $result['user'];
            $token = $result['token'];
            $success = $result['success'];
            $permissionsList = $result['permissions'];
            $company = $result['company'];
                return response()->json(compact('success','token','user','permissionsList','company'));
        }else{
            return $result;
        }
        //$this->userObject->UpdateUserLogin();
    }


    protected function validators($data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);
    }
}
