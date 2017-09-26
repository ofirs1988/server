<?php
namespace App\Interfaces\Company;

interface CompanyInterfce
{
    public function createCompany($request,$uid);
    public function setCompany($request);
    public function getCompany($id);
    public function getCompanies();
}