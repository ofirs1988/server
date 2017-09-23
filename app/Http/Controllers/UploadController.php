<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Input;
use JWTAuth AS JWTAuth;
use Tymon\JWTAuth\JWTException;
use App\Interfaces\Files\FilesInterface AS FilesInterface;

class UploadController extends Controller
{
    protected $fileObject;

    public function __construct(FilesInterface $file)
    {
        $this->fileObject = $file;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Settings user
//        $user = JWTAuth::parseToken()->authenticate();
//        if(!$user)
//            return response()->json(array('success' => false,
//                'massage' => 'not User ID'), 500);

        $user = User::where('id',1)->first();
            $upload = $this->fileObject->UploadVideo($user,$request);
            return $upload;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
