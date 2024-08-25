<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointmentt;

class AppointmentController extends Controller
{
    public function appointmentForm()
    {
        $appointments = Appointmentt::with(['hospital', 'clinic', 'doctor', 'city', 'district']) //appointmentt modelininin verilerini sorgulamak için kullanılır.
            //with: Appointment modeline bağlı olan ilişkili modelleri de eager loading(önceden yükleme) ile birlikte getirir.
            ->where('user_id', auth()->id()) //user_id sütununu,oturum açmış kullanıcının id'sine eşit olacak şekilde filtreler. 
            ->get();

        return view('appointment', compact('appointments'));
    }
    public function store(Request $request) // store metodu randevu formundan gelen verileri işeyerek veri tabanına kaydeder.
    {

        $request->validate([ // validate form verilerini doğrulamak için kullanılır.
            'appointment_date' => 'required|date', //kullanıcı tarih seçmek zorunda
            'city_id' => 'required|exists:city,id', //kullanıcı şehir seçmek zorunda
            'district_id' => 'required|exists:district,id', //kullanıcı şehir seçmek zorunda
            'hospital_id' => 'required|exists:hospital,id', //kullanıcı hastane seçmek zorunda
            'clinic_id' => 'required|exists:clinic,id', //kullancısı klinik seçmek zorunda
            'doctor_id' => 'required|exists:doctor,id', //kullanıcı doktor seçmek zorunda
        ]);


        Appointmentt::create([  //Appointmentt modelini kullanarak  yeni bir randevu oluşturur.
            'user_id' => auth()->id(), //oturum açmış kullanıcının bilgisini alır
            'appointment_date' => $request->appointment_date, // formdan gelen randevu tarihini alır
            'city_id' => $request->city_id, //formdan gelen şehir id sini alır
            'district_id' => $request->district_id, // formdan gelen ilçe id sini alır
            'hospital_id' => $request->hospital_id, // formdan gelen hastane id sini alır
            'clinic_id' => $request->clinic_id, //formdan gelen klinik id sini alır
            'doctor_id' => $request->doctor_id, //formdan gelen doctor id sini alır

        ]);
        return redirect()->route('homePage')->with('success', 'Randevu başarıyla kaydedildi!'); //
    }
    public function delete(Request $request)
    {
        //
        // dd($request->index);
        // gelen değişkenleri dump et fonksiyonu öldür.
        $deleteRow = Appointmentt::where('id', $request->index)->first(); //appointment modelini kullanarak,gelen request nesnesindeki 'index' parametresine göre 'id' değerin eşleşen ilk kaydı arar.
        $deleteRow->delete(); //Bulunan kaydın delete metdou çağrılarak veri tabanınndan silinir
        return redirect('/appointment')->with('Randevunuz silinmiştir.'); //silme işleminden sonra kullancıyı appointment'a yönelndirir 

    }
}
