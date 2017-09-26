<?php

namespace App\Http\Controllers;

use App\Interfaces\Company\CompanyInterfce AS Company;
use Illuminate\Http\Request;
use App\Interfaces\User\UserInterface AS User;

class CompanyController extends Controller
{

    protected $userObject;
    protected $companyObject;

    public function __construct(User $u,Company $c)
    {
        $this->userObject = $u;
        $this->companyObject = $c;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $this->userObject->setUser($request[0]);
        $company = $this->companyObject->createCompany($request[1],$user->id);
        return $company;
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

    protected function validators($num,$param,$data)
    {
        return Validator::make($data, [
            'phone' => 'nullable|string|min:0|max:11',
            'email' => 'required|string|email|max:255|unique:wt_users',
            'password' => $param.'string|min:'.$num
        ]);
    }
}
