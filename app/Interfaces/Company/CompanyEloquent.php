<?php
namespace App\Interfaces\Company;

use App\Company;
use App\UsersCompany;
use JWTAuth;
use Tymon\JWTAuth\JWTException;

class CompanyEloquent implements \App\Interfaces\Company\CompanyInterfce {

    public function createCompany($request,$uid)
    {
        if(is_array($request))
            $request = (object) $request;

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->contact_name = isset($request->contact_name) ? $request->contact_name : null;
        $company->phone = isset($request->phone) ? $request->phone : null;
        $company->logo = isset($request->logo) ? $request->logo : null;
        $company->active = isset($request->active) ? $request->active : 0;
        $company->type = isset($request->type) ? $request->tpye : 1;
        $company->op = isset($request->op) ? $request->op : null;
        $company->type_pay = isset($request->type_pay) ? $request->type_pay : 1;
        $company->site = isset($request->site) ? $request->site : null;
        $company->social_page = isset($request->social_page) ? $request->social_page : null;
        if ($company->save()){
            $usersCompany = new UsersCompany();
            $usersCompany->company_id = $company->id;
            $usersCompany->user_id = $uid;
            $usersCompany->save();
            return ['success' => true , 'company' => $company];
        }else
            return ['success' => false];
    }

    public function getCompanies()
    {
        // TODO: Implement getCompanies() method.
    }

    public function getCompany($id)
    {
        // TODO: Implement getCompany() method.
    }

    public function setCompany($request)
    {
        // TODO: Implement setCompany() method.
    }

}