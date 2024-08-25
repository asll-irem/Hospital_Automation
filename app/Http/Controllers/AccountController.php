<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    // Hesap bilgilerini görüntüleme
    public function accountForm()
    {
        $account = User::find(auth()->id());  // Şu anki oturum açmış kullanıcının bilgilerini al
        return view('account', compact('account')); //account adında bir view döndür ve kullanıcı bilgilerini bu view'a gönder(compact)
    }

    // Hesap bilgilerini güncelleme
    public function accountUpdate(Request $request)
    {
        $request->validate([ //formdan gelen verileri doğrular
            'name' => 'required|string|max:230',
            'surname' => 'required|string|max:230',
            'tc' => 'required|string|max:11',
            'email' => 'required|email|max:230',
            'phone' => 'required|string|max:11'
        ]);

        $user = User::find(auth()->id());

        if ($user) {
            // Kullanıcı varsa, bilgileri güncelle
            $user->update([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'tc' => $request->input('tc'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);

            return redirect()->route('account')->with('success', 'Hesap bilgileri başarıyla güncellendi.');
        } else {
            // Kullanıcı yoksa, yeni bir kullanıcı oluştur
            $user = User::create([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'tc' => $request->input('tc'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt('default_password') // Varsayılan bir şifre belirleyebilirsiniz
            ]);

            return redirect()->route('account')->with('success', 'Hessap başarıyla oluşturuldu.');
        }
    }
}
