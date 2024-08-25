<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesap Bilgileri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="{{ route('homePage') }}">
            <h3>Merkezi Hekim Randevu Sistemi</h3>
        </a>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appointment') }}">Randevu Sayfası</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account') }}">Hesap Bilgilerim</a>
                </li>
                <li class="nav-item">
                    <form id="logout_form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-link" type="submit">Çıkış</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('account.update') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Adı</td>
                        <td><input type="text" name="name" value="{{ $account->name }}" class="form-control"
                                required>
                        </td>
                    </tr>
                    <tr>
                        <td>Soyadı</td>
                        <td><input type="text" name="surname" value="{{ $account->surname }}" class="form-control"
                                required></td>
                    </tr>
                    <tr>
                        <td>TC Kimlik No</td>
                        <td><input type="text" name="tc" value="{{ $account->tc }}" class="form-control"
                                required>
                        </td>
                    </tr>
                    <tr>
                        <td>E-posta</td>
                        <td><input type="email" name="email" value="{{ $account->email }}" class="form-control"
                                required></td>
                    </tr>
                    <tr>
                        <td>Telefon</td>
                        <td><input type="text" name="phone" value="{{ $account->phone }}" class="form-control"
                                required></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>


    </div>
</body>

</html>
