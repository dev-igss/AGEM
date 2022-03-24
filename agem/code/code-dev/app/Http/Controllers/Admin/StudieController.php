<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Studie, App\Http\Models\Unit, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth, Session, DB, Response;

class StudieController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome($type){

        switch($type){
            case '0':
                $studies = Studie::where('type', '0')->orderby('id','Asc')->get();
            break;

            case '1':
                $studies = Studie::where('type', '1')->orderby('id','Asc')->get();
            break;

            case '2':
                $studies = Studie::where('type', '2')->orderby('id','Asc')->get();
            break;

            case '3':
                $studies = Studie::where('type', '3')->orderby('id','Asc')->get();
            break;

            case '4':
                $studies = Studie::where('type', '4')->orderby('id','Asc')->get();
            break;

            case 'all':
                $studies = Studie::orderby('id','Asc')->get();
            break;
        }
        
        $units = Unit::pluck('name', 'id');
            

        $data = [
            'studies' => $studies,
            'units' => $units
        ];

        return view('admin.studies.home',$data);
    }

    public function postStudieAdd(Request $request){
        $rules = [
    		'name' => 'required'
    	];
    	$messagess = [
    		'name.required' => 'Se requiere un nombre para el examen o estudio.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $s = new Studie;
            $s->name = e($request->input('name'));
            $s->unit_id = $request->input('unit_id');
            $s->type = $request->input('type');

            if($s->save()):
                $b = new Bitacora;
                $b->action = "Registro de examen o estudio ".$s->name;
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Estudio creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }
}
