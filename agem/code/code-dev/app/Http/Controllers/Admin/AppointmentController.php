<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Appointment, App\Http\Models\DetailAppointment, App\Http\Models\MaterialAppointment, App\Http\Models\Patient, App\Http\Models\CodePatient, App\Http\Models\Service, App\Http\Models\Studie, App\Http\Models\Bitacora;
use Validator, Str, Config, Auth, Session, DB, Response, Carbon\Carbon;

class AppointmentController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('UserStatus');
        $this->middleware('Permissions');
    }

    public function getHome(){        

        $appointments = Appointment::all();            

        $data = [
            'appointments' => $appointments
        ];

        return view('admin.appointments.home',$data);
    }

    public function getAppointmentAdd(){
        $services = Service::where('type','1')
            ->where('unit_id', '1')
            ->get();
        $studies = Studie::pluck('name','id');
        $detalles = DetailAppointment::all();

        $data = [
            'services' => $services,
            'studies' => $studies,
            'detalles' => $detalles
        ];

        return view('admin.appointments.add', $data);
    } 

    public function postAppointmentAdd(Request $request){
        $rules = [
            'date' => 'required'
    	];
    	$messagess = [
            'date.required' => 'Se requiere que asigne una fecha para la cita.'
    	];

        $validator = Validator::make($request->all(), $rules, $messagess);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $idpatient = $request->input('patient_id');
            $type_exam = $request->input('type_exam');
            $affiliation_p = Patient::select('affiliation')
                                ->where('id', $idpatient)
                                ->limit(1)
                                ->get();

            switch($type_exam):

                case '0':
                    $code_exp = CodePatient::select('code')
                        ->where('patient_id', $idpatient)
                        ->where('nomenclature', 'RX')
                        ->where('status', '0')
                        ->get();
                    $area = '0';
                    $appointments_odls = Appointment::where('patient_id', $idpatient)
                                ->where('area',$area)
                                ->count();
                break;

                case '1':
                    $code_exp = CodePatient::select('code')
                        ->where('patient_id', $idpatient)
                        ->where('nomenclature', 'RX')
                        ->where('status', '0')
                        ->get();
                    $area = '0';
                    $appointments_odls = Appointment::where('patient_id', $idpatient)
                                ->where('area',$area)
                                ->count();
                break;

                case '2':
                    $code_exp = CodePatient::select('code')
                        ->where('patient_id', $idpatient)
                        ->where('nomenclature', 'USG')
                        ->where('status', '0')
                        ->get();
                    $area = '2';
                    $appointments_odls = Appointment::where('patient_id', $idpatient)
                                ->where('area',$area)
                                ->count();
                break;

                case '3':
                    $code_exp = CodePatient::select('code')
                        ->where('patient_id', $idpatient)
                        ->where('nomenclature', 'MMO')
                        ->where('status', '0')
                        ->get();
                    $area = '3';
                    $appointments_odls = Appointment::where('patient_id', $idpatient)
                                ->where('area',$area)
                                ->count();
                break;

                case '4':
                    $code_exp = CodePatient::select('code')
                        ->where('patient_id', $idpatient)
                        ->where('nomenclature', 'DMO')
                        ->where('status', '0')
                        ->get();
                    $area = '4';
                    $appointments_odls = Appointment::where('patient_id', $idpatient)
                                ->where('area',$area)
                                ->count();
                break;

            endswitch;

            if(count($code_exp) == 0):
                $code_assig = "";
            else:
                foreach($code_exp as $ce):
                    $code_assig = $ce->code;
                endforeach;
            endif;

            if($appointments_odls == '0'):
                $appointments_type = '0';
            else:
                $appointments_type = '1';
            endif;

            DB::beginTransaction();

            $appointment = new Appointment;
            $appointment->patient_id = $idpatient;
            $appointment->date = $request->input('date');

            if($code_assig != NULL):
                $appointment->num_study = $code_assig;
            endif;
            $appointment->type = $appointments_type;
            $appointment->area = $area;
            $appointment->status = '0';    
            $appointment->save();      

            $idservice = $request->get('idservice');
            $idstudy = $request->get('idstudy');
            $comment = $request->get('comment');

            $cont=0;

            while ($cont<count($idservice)) {
                $detalle = new DetailAppointment();
                $detalle->idappointment=$appointment->id;
                $detalle->idservice=$idservice[$cont];
                $detalle->idstudy=$idstudy[$cont];
                $detalle->comment=$comment[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();

            if($appointment->save()):  
                foreach($affiliation_p as $ap):
                    $afp = $ap->affiliation;
                endforeach;

                $b = new Bitacora;
                $b->action = "Registro de cita para paciente con afiliación: ".$afp;
                $b->user_id = Auth::id();
                $b->save();

                return redirect('/admin/appointments')->with('messages', '¡Cita agendada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getAppointmentMaterials($id){
        $materials = MaterialAppointment::where('idappointment', $id)->get();

        $data = [
            'materials' => $materials
        ];

        return view('admin.appointments.materials', $data);
    }

    public function getAppointmentReschedule($id, $date){
        $appointment = Appointment::findOrFail($id);
        $appointment->date_old = $appointment->date;
        $appointment->date = $date;
        $appointment->status = '4';

        if($appointment->save()):               

            $b = new Bitacora;
            $b->action = "Reprogamación de cita para paciente con afiliación: ".$appointment->patient->affiliation;
            $b->user_id = Auth::id();
            $b->save();

            return redirect('/admin/appointments')->with('messages', '¡Cita reprogramada y guardada con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getAppointmentPatientsStatus($id, $status){        
        $appointment = Appointment::findOrFail($id);
        $patient = Patient::where('id', $appointment->patient_id)
                        ->limit(1)
                        ->get();
        
        switch($appointment->area):
            case '0':
                $nomen = 'RX';
            break;

            case '1':
                $nomen = 'RX';
            break;

            case '2':
                $nomen = 'USG';
            break;

            case '3':
                $nomen = 'MMO';
            break;

            case '4':
                $nomen = 'DMO';
            break;
        endswitch;
        
        $code_study = CodePatient::select('code')
                        ->where('patient_id', $appointment->patient_id)
                        ->where('nomenclature', $nomen)
                        ->where('status', '0')
                        ->limit(1)
                        ->get();

        foreach($code_study as $cs):
            $num_exp = $cs->code;
        endforeach;
        
        if($status == "1"):
            $appointment->num_study = $num_exp;
        endif;
        $appointment->status = $status;

        if($appointment->save()):               

            $b = new Bitacora;
            if($status == "1"):
                $b->action = "Cita no. ".$appointment->id.", paciente con afiliación ".$appointment->patient->affiliation." presente";
            else:
                $b->action = "Cita no. ".$appointment->id.", paciente con afiliación ".$appointment->patient->affiliation." ausente";
            endif;            
            $b->user_id = Auth::id();
            $b->save();

            return redirect('/admin/appointments')->with('messages', '¡Estado de cita actualizado con exito!.')
                ->with('typealert', 'success');
        endif;
    }
}
