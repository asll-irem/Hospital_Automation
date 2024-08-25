<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointmentt extends Model
{
    use HasFactory;

    protected $table = 'appointmentt';

    protected $fillable = [ //modelin hangi alanlarının atanabilir olduğunu belirtir.
        'user_id', 'appointment_date', 'city_id', 'district_id', 'hospital_id', 'clinic_id', 'doctor_id'
    ];

    // Doğru model isimleri ile ilişkiler
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id'); //belongsTo ilişkisi,bir modelin diğer modellerle olan ilişkisini belirtir.  
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
