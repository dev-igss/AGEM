<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Environment, App\Http\Models\Product;

class ApiController extends Controller
{
    public function __Construct(){
    	$this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function getService($parent){
        $services = Environment::where('type', '1')->where('parent', $parent)->get();

        return response()->json($services);
    }

    public function getEnvironment($parent){
        $environment = Environment::where('type', '2')->where('parent', $parent)->get();

        return response()->json($environment);
    }

    public function getproduct($code){

        if(!is_null($code)):
            $product = Product::where('code_ppr', $code)
                ->orWhere('code_int', $code)
                ->get();
        else:
            $product = "";
        endif;

        return response()->json($product);
    }
}
