<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm() //Kullanıcıya giriş formunu gösterir
    {
        return view('auth.login');
    }

    public function showRegisterForm() //Kullanıcıya kayıt formunu gösterir.
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([ //Form verilerini doğrular. Kullanıcıdan alınan verilerin belirli kurallara ve kriterlere uygun olup olmadığını kontrol eder.
            'name' => 'required|string|max:230', //Ad alanı gerekli
            'surname' => 'required|string|max:230', //soyadı alani gerekli
            'user_tc' => 'required|string|unique:users,tc', //Tc benzersiz gerekli
            'password' => 'required|string|confirmed', //Şifrenin gerekli, string ve 'password_confirmation' ile doğrulanmış olması gerekir. şifrenin ve şifre tekrarının aynı olup olmadığını kontrol ediyor
        ]);

        User::create([ //Yeni kullanıcıyı oluştur.
            'name' => $request->name, //kullanıcı adı
            'surname' => $request->surname, //kullanıcı soyadı
            'tc' => $request->user_tc, //Tc kimlik no
            'password' => Hash::make($request->password), //Şifreyi güvenli bir şekilde şifreler.
        ]);

        return redirect()->route('login')->with('success', 'Kayıt başarılı. Lütfen giriş yapın.'); //kullancıyı giriş sayfasına yönlendirir ve başarı mesajı ile geri dönder
    }

    public function login(Request $request)
    {
        $request->validate([ // Form verilerini doğrular.Kullanıcıdan alınan verilerin belirli kuralllara uygun olup olmadığını kontrol ediyor
            'tc' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('tc', 'password'); //Giriş bilgilerini alır

        if (Auth::attempt($credentials)) { //Kimlik doğrulama işlemini gerçekleştirir.
            return redirect()->route('homePage'); // Kimlik doğrulama başarılıysa kullancıyı ana sayfaya yönlendir.
        }

        return redirect()->route('login')->withErrors(['tc' => 'Geçersiz Tc Kimlik No veya şifre.']); //Kimlik doğrulama başarısızsa, Giriş formuna geri gönder ve hata mesajı döndür. 
    }

    public function logout(Request $request)
    {
        Auth::logout(); //Mevcut oturumu sonlandır.
        $request->session()->invalidate(); //Oturum verilerini geçersiz kıl
        $request->session()->regenerateToken(); //Yeni bir csrf token oluşturur.

        return redirect()->route('login'); //Kullancıyı giriş sayfasına yönlendir.
    }
}
