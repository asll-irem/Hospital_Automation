<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Hospital;
use App\Models\Clinic;
use App\Models\Doctor;



class HomeController extends Controller
{

    public function homePage()
    {
        $cities = city::select('id', 'name')->get(); //Şehirlerin id ve isimlerini çek
        $districts = district::select('id', 'name')->get(); //ilçelerin id ve isimlerini çek
        $hospitals = hospital::select('id', 'name')->get(); //hastanenin id ve isimlerini çek
        $clinics = clinic::select('id', 'name')->get(); //kliniklerin id ve isimlerini çek
        $doctors = doctor::select('id', 'name')->get(); //doktorların id ve isimlerini çek


        return view('homePage', [ //Elde edilen verileri HomePage  sayfasına gönder
            'cities' => $cities,
            'districts' => $districts,
            'hospitals' => $hospitals,
            'clinics' => $clinics,
            'doctors' => $doctors,
        ]);
    }



    public function getDistricts($city_id) //belirli bir şehir id'sine göre ilçeleri getiren yöntem 
    {
        $districts = District::where('city_id', $city_id)->get(); //Verilen şehir id'sine sahip ilçeleri getir
        return response()->json($districts); //İlçeleri json formatında döndürür.
    }

    public function getHospitals($district_id) //Belirli bir ilçe id'sine göre  Hastaneleri getiren yöntem
    {
        $hospitals = Hospital::where('district_id', $district_id)->get(); //verilen ilçe id'sine sahip hastaneleri getir
        return response()->json($hospitals); //hastaneleri json formatında döndürür
    }

    public function getClinics($hospital_id) //Belirli bir hastane id'sine göre Klinikleri getiren yöntem
    {
        $clinics = Clinic::where('hospital_id', $hospital_id)->get(); //verilen hastane id'sine sahip klinikleri getir
        return response()->json($clinics); //klinikleri json formattında döndürür
    }

    public function getDoctors($clinic_id) //Belirli bir Klinik id'sine göre doktorları getiren yöntem
    {
        $doctors = Doctor::where('clinic_id', $clinic_id)->get(); //verilen klinik id'sine sahip doktorları getir
        return response()->json($doctors); //doktorları json formatında döndürür
    }
}
