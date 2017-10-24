<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//use JWTAuth AS JWTAuth;
//use Tymon\JWTAuth\JWTException;
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//->middleware('jwt.auth')
Route::post('getVideos', 'videosController@show');

Route::group(['prefix' => 'user'], function(){
    Route::post('createUser', 'Auth\RegisterController@create');
    Route::post('loginUser', 'Auth\LoginController@index');
    Route::post('userInfo', 'UserController@index');
    Route::post('getUser', 'UserController@store');
});
//Route::group(['prefix' => 'user','middleware' => 'jwt.auth'], function()
//{
//
//});



Route::group(['prefix' => 'admin'], function(){
    Route::post('getCampaign', 'CampaignController@getCampaign');
    Route::post('createCampaign', 'CampaignController@create');
    Route::post('createCompanyByAdmin', 'CompanyController@create');

    Route::group(['prefix' => 'upload'], function(){
        Route::post('uploadVideo', 'UploadController@index');

    });

    Route::group(['prefix' => 'user'], function(){
        Route::post('adminLogin', 'Auth\LoginController@LoginAdmin');
        Route::post('getUser', 'UserController@storeAdmin');
    });
});