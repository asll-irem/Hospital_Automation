<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merkezi Hekim Randevu Sistemi - Kayıt Ol</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="text-center my-5">MERKEZİ HEKİM RANDEVU SİSTEMİ</h1>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="d-flex flex-column justify-content-center align-items-center border p-4 rounded shadow"
            style="max-width: 400px; margin: auto;">
            <h2 class="mb-4">Üye Ol</h2>

            <form id="register" action="{{ route('register') }}" method="POST" class="w-100">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" name="name" placeholder="İsim" class="form-control" required />
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="surname" placeholder="Soyisim" class="form-control" required />
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="user_tc" placeholder="Tc Kimlik No" class="form-control" required />
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" placeholder="Şifre" class="form-control" required />
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password_confirmation" placeholder="Şifreyi Onayla"
                        class="form-control" required />
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-3">Üye Ol</button>
            </form>
            <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Geri Çık</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
