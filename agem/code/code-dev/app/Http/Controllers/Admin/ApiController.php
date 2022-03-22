<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Patient, App\Http\Models\CodePatient, App\Http\Models\Appointment, App\Http\Models\DetailAppointment, App\Http\Models\Service, App\Http\Models\Studie;
use Carbon\Carbon;

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
                $code_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'RX')
                    ->where('status', '0')
                    ->get();
            break;

            case 1:
                $code_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'USG')
                    ->where('status', '0')
                    ->get();
            break;

            case 2:
                $code_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'MMO')
                    ->where('status', '0')
                    ->get();
            break;

            case 3:
                $code_last = CodePatient::where('patient_id', $id_temp)
                    ->where('nomenclature', 'DMO')
                    ->where('status', '0')
                    ->get();
            break;

        endswitch;

        $appoinment_last = Appointment::where('patient_id', $id_temp)
                ->where('area',$exam)
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->get();

               
        

        if(count($appoinment_last) == 0):
            $service = "";            
            $studie = "";

            $data = [
                'patient' => $patient,
                'code_last' => $code_last
            ];

        else:
            foreach($appoinment_last as $al):
                $detalles = DetailAppointment::with(['service', 'study'])->where('idappointment', $al->id)->get(); 
            endforeach;   

            $data = [
                'patient' => $patient,
                'code_last' => $code_last,
                'appointment_last' => $appoinment_last,
                'detalles' => $detalles
            ];
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

    
}
