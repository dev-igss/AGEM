<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Models\Product, App\Http\Models\Environment, App\Http\Models\CodePatient, App\Http\Models\IncomeDetailProduct;
use DB, PDF;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('Permissions');
        $this->middleware('UserStatus');

    }

    public function getDashboard(){
        

        $data = [
           
        ];

        return view('admin.dashboard',$data);
    }

}
