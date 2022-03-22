<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Appointment, App\Http\Models\DetailAppointment, App\Http\Models\MaterialAppointment, App\Http\Models\Bitacora, App\User;
use Carbon\Carbon;

class PatientDayController extends Controller
{
    public function getPatientDay(){
        $today = Carbon::now()->format('Y-m-d');
        $appointments = Appointment::where('date',$today)
                    ->where('status', '1')
                    ->get();
        $detalles = DetailAppointment::all();
       

        $data = [
            'appointments' => $appointments,
            'detalles' => $detalles
        ];

        return view('patients_day.home', $data);
    }

    public function getMaterials($id){
        $idappointment = $id;
        $appointment = Appointment::findOrFail($id);
        $detalle = DetailAppointment::where('idappointment',$appointment->id)->get();

        $data = [
            'idappointment' => $idappointment,
            'appointment' => $appointment,
            'detalle' => $detalle
        ];

        return view('patients_day.materials', $data);
    }

    public function postMaterials(Request $request){
        $ibm_tec = $request->get('ibm');
        $tecnico = User::select('id')->where('ibm', $ibm_tec)->limit(1)->get();
        
        foreach($tecnico as $tec):
            $id_tec = $tec->id;
        endforeach;

        $cita = Appointment::findOrFail($request->get('appointmentid'));
        $cita->status = '3';
        $cita->idtecnico = $id_tec;
        $cita->save();

        $idappointment = $request->get('idappointment');
        $idstudy = $request->get('idstudy');
        $material = $request->get('material');
        $cantidad = $request->get('cantidad');
        $cont = 0;

        while($cont < count($idappointment)){
            $materials = new MaterialAppointment();
            $materials->idappointment = $idappointment[$cont];
            $materials->idstudy = $idstudy[$cont];
            $materials->material = $material[$cont];
            $materials->amount = $cantidad[$cont];
            $materials->save();
            $cont = $cont+1;
        }    

        if($materials->save()):     
            
            $b = new Bitacora;
            $b->action = "Tecnico finalizo atencion de cita";
            $b->user_id = $id_tec;
            $b->save();

            return redirect('/patients_days')->with('messages', '¡Registro de Materiales Exitos!.')
                ->with('typealert', 'success');

        endif;


    } 
}
