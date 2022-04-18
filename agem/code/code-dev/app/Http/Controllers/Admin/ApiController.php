<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Patient, App\Http\Models\CodePatient, App\Http\Models\Appointment, App\Http\Models\DetailAppointment, App\Http\Models\Service, App\Http\Models\Studie;
use Carbon\Carbon, DB;

class ApiController extends Controller
{
    public function __Construct(){
    	$this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    public function getPatient($code, $exam){
        $patient = Patient::where('affiliation', $code)
            ->get();

        foreach($patient as $p):
            $id_temp = $p->id;
        endforeach;

        switch($exam):
            case 0:
                $code_temp_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'RX')
                    ->where('status', '0')
                    ->get();
            break;

            case 1:
                $code_temp_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'RX')
                    ->where('status', '0')
                    ->get();
            break;

            case 2:
                $code_temp_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'USG')
                    ->where('status', '0')
                    ->get();
            break;

            case 3:
                $code_temp_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'MMO')
                    ->where('status', '0')
                    ->get();
            break;

            case 4:
                $code_temp_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'DMO')
                    ->where('status', '0')
                    ->get();
            break;

        endswitch;

        if(count($code_temp_last) > 0):
            $code_last = $code_temp_last;
        else:
            $code_last = [];
        endif;


        if($exam == "1"):
            $appoinment_last = Appointment::where('patient_id', $id_temp)
                ->where('area','0')
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->get();
        else:
            $appoinment_last = Appointment::where('patient_id', $id_temp)
                ->where('area',$exam)
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->get();
        endif;       

        if(count($appoinment_last) == 0):
            $service = "";            
            $studie = "";

            if(count($code_last) == 0):
                
                $data = [
                    'patient' => $patient
                ];
            else:
                $data = [
                    'patient' => $patient,
                    'code_last' => $code_last
                ];
            endif;

            

        else:
            foreach($appoinment_last as $al):
                $detalles = DetailAppointment::with(['service', 'study'])->where('idappointment', $al->id)->get(); 
            endforeach; 
            
            if(count($code_last) == 0):
                $data = [
                    'patient' => $patient,
                    'appointment_last' => $appoinment_last,
                    'detalles' => $detalles
                ];
            else:
                

                $data = [
                    'patient' => $patient,
                    'code_last' => $code_last,
                    'appointment_last' => $appoinment_last,
                    'detalles' => $detalles
                ];
            endif;
        endif;

               

        
        
        

        return response()->json($data);
    }

    public function getCodePatient($code){
        $date = Carbon::now();

        $codes_ant = CodePatient::where('nomenclature', $code)
                                ->where('year',$date->year)
                                ->count();
        $nomenclature = $code;
        
        $correlative = $codes_ant +'1';
        $year = $date->format('Y');
        $year_short = $date->format('y');
        
        if($codes_ant < 10):
            $code_new = $nomenclature.'0'.$correlative.'-'.$year_short;
        else:
            $code_new = $nomenclature.$correlative.'-'.$year_short;
        endif;       

        $data = [
            'nomenclature' => $nomenclature,
            'correlative' => $correlative,
            'year' => $year,
            'code' => $code_new
        ];

        return $data; 

        //return response()->json($data);
    }

    public function getStudies($type){
        $studies = Studie::where('type', $type)->get();


        return response()->json($studies);
    }

    public function getAppointments($date, $area){
        
        $citas = Appointment::where('date', $date)
                ->where('area',$area)
                ->count();
        //return $citas;
        return response()->json($citas);
    }

    public function getSchedule($date, $area){
        $cant_citas = Appointment::select(DB::raw('schedule_id, count(*) as total'))
                    ->where('date', $date)
                    ->where('area', $area)
                    ->groupBy('schedule_id')
                    ->get();

        //return $cant_citas;
        return response()->json($cant_citas);
    }

    public function getAppointmentsView(){
        
        $appointments = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->join('schedule', 'appointments.schedule_id', '=', 'schedule.id')
                ->select(DB::raw('CONCAT(patients.lastname,  \', \' , patients.name) AS title'), DB::raw('CONCAT(appointments.date,  \' \' , schedule.hour_in) AS start'), DB::raw('CONCAT(appointments.date,  \' \' , schedule.hour_out) AS end'), DB::raw('appointments.area AS area'), DB::raw('schedule.type AS type'))
                ->get();
           
        
        return $appointments;
        $data = [
           'appointments' => $appointments
        ];

        return response()->json($data);
    }

    public function getAppointmentsViewRx(){
        
        $appointments = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->join('schedule', 'appointments.schedule_id', '=', 'schedule.id')
                ->select(DB::raw('CONCAT(patients.lastname,  \', \' , patients.name) AS title'), DB::raw('CONCAT(appointments.date,  \' \' , schedule.hour_in) AS start'), DB::raw('CONCAT(appointments.date,  \' \' , schedule.hour_out) AS end'), DB::raw('appointments.area AS area'))
                ->where('appointments.area', 0)
                ->get();
           
        
        return $appointments;
        $data = [
           'appointments' => $appointments
        ];

        return response()->json($data);
    }

    public function getAppointmentsViewUmd(){
        
        $appointments = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->join('schedule', 'appointments.schedule_id', '=', 'schedule.id')
                ->select(DB::raw('CONCAT(patients.lastname,  \', \' , patients.name) AS title'), DB::raw('CONCAT(appointments.date,  \' \' , schedule.hour_in) AS start'), DB::raw('CONCAT(appointments.date,  \' \' , schedule.hour_out) AS end'), DB::raw('appointments.area AS area'), DB::raw('schedule.type AS type'))
                ->whereIn('appointments.area', ['2', '3', '4'])  
                ->get();
           
        
        return $appointments;
        $data = [
           'appointments' => $appointments
        ];

        return response()->json($data);
    }
    
}
