<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Patient, App\Http\Models\Unit, App\Http\Models\CodePatient, App\Http\Models\Appointment, App\Http\Models\DetailAppointment, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth, Session, DB, Response;

class PatientController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){

        $patients = Patient::all();            

        $data = [
            'patients' => $patients
        ];

        return view('admin.patients.home',$data);
    }

    public function getPatientAdd(){

        $units = Unit::all();

        $data = [
            'units' => $units
        ];

        return view('admin.patients.add', $data);
    }

    public function postPatientAdd(Request $request){
        $rules = [
            'affiliation' => 'required',
    		'name' => 'required',
            'lastname' => 'required',
            'unit_id' => 'required'
    	];
    	$messagess = [
            'affiliation.required' => 'Se requiere el numero de afiliacion del paciente.',
    		'name.required' => 'Se requiere el nombre del paciente.',
            'lastname.required' => 'Se requiere los apellidos del paciente.',
            'unit_id.required' => 'Se requiere la unidad de afiliacion del paciente.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $p = new Patient;
            $p->affiliation = e($request->input('affiliation'));
            $p->name = e($request->input('name'));
            $p->lastname = e($request->input('lastname'));
            $p->unit_id = e($request->input('unit_id'));
            $p->age = $request->input('age');
            $p->birth = $request->input('birth'); 
            $p->gender = $request->input('gender');
            $p->contact = e($request->input('contact'));          

            if($p->save()):
                if($request->input('num_rx') != ""):
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;                                      
                    $cp->nomenclature = $request->input('num_rx_nom');
                    $cp->correlative = $request->input('num_rx_cor');
                    $cp->year = $request->input('num_rx_y');
                    $cp->code = $request->input('num_rx');
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_rx') == "" && $request->input('num_rx_nom') != "" && $request->input('num_rx_cor') != "" && $request->input('num_rx_y') != "" ):
                    $code_manual_rx = $request->input('num_rx_nom').$request->input('num_rx_cor').'-'.substr($request->input('num_rx_y'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;                                      
                    $cp->nomenclature = $request->input('num_rx_nom');
                    $cp->correlative = $request->input('num_rx_cor');
                    $cp->year = $request->input('num_rx_y');
                    $cp->code = $code_manual_rx;
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_usg') != ""):
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_usg_nom');
                    $cp->correlative = $request->input('num_usg_cor');
                    $cp->year = $request->input('num_usg_y');
                    $cp->code = $request->input('num_usg');
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_usg') == "" && $request->input('num_usg_nom') != "" && $request->input('num_usg_cor') != "" && $request->input('num_usg_y') != ""):
                    $code_manual_usg = $request->input('num_usg_nom').$request->input('num_usg_cor').'-'.substr($request->input('num_usg_y'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_usg_nom');
                    $cp->correlative = $request->input('num_usg_cor');
                    $cp->year = $request->input('num_usg_y');
                    $cp->code = $code_manual_usg;
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_mmo') != ""):
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_mmo_nom');
                    $cp->correlative = $request->input('num_mmo_cor');
                    $cp->year = $request->input('num_mmo_y');
                    $cp->code = $request->input('num_mmo');
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_mmo') == "" && $request->input('num_mmo_nom') != "" && $request->input('num_mmo_cor') != "" && $request->input('num_mmo_y') != ""):
                    $code_manual_mmo = $request->input('num_mmo_nom').$request->input('num_mmo_cor').'-'.substr($request->input('num_mmo_y'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_mmo_nom');
                    $cp->correlative = $request->input('num_mmo_cor');
                    $cp->year = $request->input('num_mmo_y');
                    $cp->code = $code_manual_mmo;
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_dmo') != ""):
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_dmo_nom');
                    $cp->correlative = $request->input('num_dmo_cor');
                    $cp->year = $request->input('num_dmo_y');
                    $cp->code = $request->input('num_dmo');
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_dmo') == "" && $request->input('num_dmo_nom') != "" && $request->input('num_dmo_cor') != "" && $request->input('num_dmo_y') != ""):
                    $code_manual_dmo = $request->input('num_dmo_nom').$request->input('num_dmo_cor').'-'.substr($request->input('num_dmo_y'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_dmo_nom');
                    $cp->correlative = $request->input('num_dmo_cor');
                    $cp->year = $request->input('num_dmo_y');
                    $cp->code = $code_manual_dmo;
                    $cp->status = '0';
                    $cp->save();
                endif;

                $b = new Bitacora;
                $b->action = "Registro de paciente con afiliacion: ".$p->affiliation;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/patients')->with('messages', '¡Paciente creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getPatientEdit($id){
        $patient = Patient::find($id);
        $code_rx = CodePatient::select('code')
                ->where('patient_id',$id)
                ->where('nomenclature', 'RX')
                ->where('status', '0')
                ->get();
        $code_usg = CodePatient::select('code')
            ->where('patient_id',$id)
            ->where('nomenclature', 'USG')
            ->where('status', '0')
            ->get();
        $code_mmo = CodePatient::select('code')
            ->where('patient_id',$id)
            ->where('nomenclature', 'MMO')
            ->where('status', '0')
            ->get();
        $code_dmo = CodePatient::select('code')
            ->where('patient_id',$id)
            ->where('nomenclature', 'DMO')
            ->where('status', '0')
            ->get();

            
        $data = [
            'patient' => $patient,
            'code_rx' => $code_rx,
            'code_usg' => $code_usg,
            'code_mmo' => $code_mmo,
            'code_dmo' => $code_dmo,
        ];

        return view('admin.patients.edit', $data);
    }

    public function postPatientEdit(Request $request, $id){
        $rules = [
    		'name' => 'required',
            'lastname' => 'required'
    	];
    	$messagess = [

    		'name.required' => 'Se requiere el nombre del paciente.',
            'lastname.required' => 'Se requiere los apellidos del paciente.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $p = Patient::findOrFail($id);
            $affiliation_ant = $p->affiliation;
            if($request->input('update_affiliation') != ""):
                $p->affiliation = $request->input('update_affiliation');
            endif;
            $p->name = e($request->input('name'));
            $p->lastname = e($request->input('lastname'));
            $p->gender = $request->input('gender');
            $p->age = $request->input('age');
            $p->birth = $request->input('birth');
            $p->contact = e($request->input('contact'));            

            if($p->save()):

                if($request->input('num_rx') != ""):
                    $cp = CodePatient::where('patient_id', $p->id)
                        ->where('nomenclature', 'RX')
                        ->where('status', '0')    
                        ->update(['status' => 1]);

                    $cp_new = new CodePatient;
                    $cp_new->patient_id = $p->id;
                    $cp_new->nomenclature = $request->input('num_rx_nom');
                    $cp_new->correlative = $request->input('num_rx_cor');
                    $cp_new->year = $request->input('num_rx_y');
                    $cp_new->code = $request->input('num_rx');
                    $cp_new->status = '0';
                    $cp_new->save();
                endif;

                if($request->input('num_rx') == "" && $request->input('num_rx_nom') != "" && $request->input('num_rx_cor') != "" && $request->input('num_rx_y') != "" ):
                    $cp = CodePatient::where('patient_id', $p->id)
                        ->where('nomenclature', 'RX')
                        ->where('status', '0')    
                        ->update(['status' => 1]);

                    $code_manual_rx = $request->input('num_rx_nom').$request->input('num_rx_cor').'-'.substr($request->input('num_rx_y'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;                                      
                    $cp->nomenclature = $request->input('num_rx_nom');
                    $cp->correlative = $request->input('num_rx_cor');
                    $cp->year = $request->input('num_rx_y');
                    $cp->code = $code_manual_rx;
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_usg') != ""):
                    $cp = CodePatient::where('patient_id', $p->id)
                        ->where('nomenclature', 'USG')
                        ->where('status', '0')    
                        ->update(['status' => 1]);

                    $cp_new = new CodePatient;
                    $cp_new->patient_id = $p->id;
                    $cp_new->nomenclature = $request->input('num_usg_nom');
                    $cp_new->correlative = $request->input('num_usg_cor');
                    $cp_new->year = $request->input('num_usg_y');
                    $cp_new->code = $request->input('num_usg');
                    $cp_new->status = '0';
                    $cp_new->save();
                endif;

                if($request->input('num_usg') == "" && $request->input('num_usg_nom') != "" && $request->input('num_usg_cor') != "" && $request->input('num_usg_y') != ""):
                    $cp = CodePatient::where('patient_id', $p->id)
                        ->where('nomenclature', 'USG')
                        ->where('status', '0')    
                        ->update(['status' => 1]);

                    $code_manual_usg = $request->input('num_usg_nom').$request->input('num_usg_cor').'-'.substr($request->input('num_usg_y'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_usg_nom');
                    $cp->correlative = $request->input('num_usg_cor');
                    $cp->year = $request->input('num_usg_y');
                    $cp->code = $code_manual_usg;
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_mmo') != ""):
                    $cp = CodePatient::where('patient_id', $p->id)
                        ->where('nomenclature', 'MMO')
                        ->where('status', '0')    
                        ->update(['status' => 1]);

                    $cp_new = new CodePatient;
                    $cp_new->patient_id = $p->id;
                    $cp_new->nomenclature = $request->input('num_mmo_nom');
                    $cp_new->correlative = $request->input('num_mmo_cor');
                    $cp_new->year = $request->input('num_mmo_y');
                    $cp_new->code = $request->input('num_mmo');
                    $cp_new->status = '0';
                    $cp_new->save();
                endif;

                if($request->input('num_mmo') == "" && $request->input('num_mmo_nom') != "" && $request->input('num_mmo_cor') != "" && $request->input('num_mmo_y') != ""):
                    $cp = CodePatient::where('patient_id', $p->id)
                        ->where('nomenclature', 'MMO')
                        ->where('status', '0')    
                        ->update(['status' => 1]);

                    $code_manual_mmo = $request->input('num_mmo_nom').$request->input('num_mmo_cor').'-'.substr($request->input('num_mmo_y'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_mmo_nom');
                    $cp->correlative = $request->input('num_mmo_cor');
                    $cp->year = $request->input('num_mmo_y');
                    $cp->code = $code_manual_mmo;
                    $cp->status = '0';
                    $cp->save();
                endif;

                if($request->input('num_dmo') != ""):
                    $cp = CodePatient::where('patient_id', $p->id)
                        ->where('nomenclature', 'DMO')
                        ->where('status', '0')    
                        ->update(['status' => 1]);

                    $cp_new = new CodePatient;
                    $cp_new->patient_id = $p->id;
                    $cp_new->nomenclature = $request->input('num_dmo_nom');
                    $cp_new->correlative = $request->input('num_dmo_cor');
                    $cp_new->year = $request->input('num_dmo_y');
                    $cp_new->code = $request->input('num_dmo');
                    $cp_new->status = '0';
                    $cp_new->save();
                endif;

                if($request->input('num_dmo') == "" && $request->input('num_dmo_nom') != "" && $request->input('num_dmo_cor') != "" && $request->input('num_dmo_y') != ""):
                    $cp = CodePatient::where('patient_id', $p->id)
                        ->where('nomenclature', 'DMO')
                        ->where('status', '0')    
                        ->update(['status' => 1]);
                        
                    $code_manual_dmo = $request->input('num_dmo_nom').$request->input('num_dmo_cor').'-'.substr($request->input('num_dmo_y'), -2);
                    $cp = new CodePatient;
                    $cp->patient_id = $p->id;
                    $cp->nomenclature = $request->input('num_dmo_nom');
                    $cp->correlative = $request->input('num_dmo_cor');
                    $cp->year = $request->input('num_dmo_y');
                    $cp->code = $code_manual_dmo;
                    $cp->status = '0';
                    $cp->save();
                endif;

                $b = new Bitacora;
                if($request->input('update_affiliation') != ""):
                    $b->action = "Actualización de datos del paciente con afiliacion: ".$affiliation_ant." a número de afiliación: ".$request->input('update_affiliation');
                else:
                    $b->action = "Actualización de datos del paciente con afiliacion: ".$affiliation_ant;
                endif;                
                $b->user_id = Auth::id();
                $b->save();

                return back()->with('messages', '¡Información de paciente actualizada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getPatientHistoryExam($id){
        $appointments_rx = Appointment::where('patient_id', $id)
                            ->where('area', '0')
                            ->get();
        
        $appointments_usg = Appointment::where('patient_id', $id)
                            ->where('area', '1')
                            ->get();
    
        $appointments_mmo = Appointment::where('patient_id', $id)
                            ->where('area', '2')
                            ->get();
        
        $appointments_dmo = Appointment::where('patient_id', $id)
                            ->where('area', '3')
                            ->get();

        $details = DetailAppointment::all();
            
        $data = [
            'appointments_rx' => $appointments_rx,
            'appointments_usg' => $appointments_usg,
            'appointments_mmo' => $appointments_mmo,
            'appointments_dmo' => $appointments_dmo,
            'details' => $details
        ];

        return view('admin.patients.history_exam', $data);
    }

    public function getPatientHistoryCode($id){
        $codes_rx = CodePatient::where('patient_id', $id)
                            ->where('nomenclature', 'RX')
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        $codes_usg = CodePatient::where('patient_id', $id)
                            ->where('nomenclature', 'USG')
                            ->orderBy('created_at', 'desc')
                            ->get();
    
        $codes_mmo = CodePatient::where('patient_id', $id)
                            ->where('nomenclature', 'MMO')
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        $codes_dmo = CodePatient::where('patient_id', $id)
                            ->where('nomenclature', 'DMO')
                            ->orderBy('created_at', 'desc')
                            ->get();
            
        $data = [
            'codes_rx' => $codes_rx,
            'codes_usg' => $codes_usg,
            'codes_mmo' => $codes_mmo,
            'codes_dmo' => $codes_dmo
        ];

        return view('admin.patients.history_code', $data);
    }
}
