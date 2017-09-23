<?php

namespace App\Http\Controllers\Auth;
use DB;
use App\User;
use App\UserIfno;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Interfaces\User\UserInterface AS UserInterface;
use JWTAuth;
use Illuminate\Http\Response;
use Tymon\JWTAuth\JWTException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/';
    protected $userObject;

    public function __construct(UserInterface $u)
    {
        $this->middleware('guest');
        $this->userObject = $u;
    }

    protected function validators($num,$param,$data)
    {
        return Validator::make($data, [
            'phone' => 'nullable|string|min:0|max:11',
            'email' => 'required|string|email|max:255|unique:wt_users',
            'password' => $param.'string|min:'.$num
        ]);
    }

    protected function create(Request $request)
    {
        $validator = $this->validators($num = '6' ,$param = 'required|',$request->all());
        if($validator->passes()){
            $result = $this->userObject->setUser($request);
            $createUser = $this->userObject->createUser($result);
                if($createUser->active){
                    return JWTAuth::fromUser($createUser);
                }else{
                    return response()->json(array('success' => true,
                        'data' => $createUser,
                        'active' => 0,
                        'massage' => 'User Created'),
                        200);
                }
        }else
            return response()->json(array('success' => false , 'massage' => $validator->errors()->first()), 201);
    }

    public function RegisterScoial($request){
        $request->request->add(['password' => Hash::make($request->id)]);
        if($request->social == 'facebook'){
            $request->request->add(['avatar' => 'http://graph.facebook.com/'. $request->id .'/picture?type=normal']);
        }
        $request->request->add(['active' => 1]);
        $token = $this->create($request);
        return $token;
    }
}
