<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Company;

class CompanyUserController extends Controller
{
    public function index(Company $company)
    {
        $users = $company->users()->where('role_id', Role::COMPANY_OWNER->value)
            ->get();

        return view('companies.users.index', compact('company', 'users'));
    }
}
