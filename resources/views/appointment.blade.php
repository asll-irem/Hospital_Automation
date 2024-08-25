<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Randevu Sistemi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .custom-table th,
        .custom-table td {
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- Menü Çubuğu --}}
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



    {{-- Tablo Başlıkları ve İçeriği --}}
    <table class="table table-bordered custom-table">
        <thead>
            <tr>
                <th>HASTANE</th>
                <th>KLİNİK</th>
                <th>DOKTOR</th>
                <th>İL</th>
                <th>İLÇE</th>
                <th>TARİH</th>
                <th>İŞLEM</th>
            </tr>
        </thead>
        <tbody>


            @csrf
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->hospital ? $appointment->hospital->name : 'Bilgi Yok' }}</td>
                    <td>{{ $appointment->clinic ? $appointment->clinic->name : 'Bilgi Yok' }}</td>
                    <td>{{ $appointment->doctor ? $appointment->doctor->name : 'Bilgi Yok' }}</td>
                    <td>{{ $appointment->city ? $appointment->city->name : 'Bilgi Yok' }}</td>
                    <td>{{ $appointment->district ? $appointment->district->name : 'Bilgi Yok' }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>
                        <form action="{{ route('appointment.delete') }}" method="POST">@csrf<button name="index"
                                type="submit" value="{{ $appointment->id }}">Sil</button></form>
                    </td>
                </tr>
            @endforeach

    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
