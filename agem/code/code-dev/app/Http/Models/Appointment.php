<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'appointments';
    protected $hidden = ['created_at', 'updated_at'];

    public function patient(){
        return $this->hasOne(Patient::class,'id','patient_id');
    }

    public function service(){
        return $this->hasOne(Service::class,'id','service_id');
    }

    public function studie(){
        return $this->hasOne(Studie::class,'id','study_id');
    }

    public function tecnico(){
        return $this->hasOne(User::class,'id','idtecnico');
    }
}
