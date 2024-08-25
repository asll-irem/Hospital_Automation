<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merkezi Hekim Randevu Sistemi</title>
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
                        <button class="nav-link" method="POST">Çıkış</button>
                    </form>

                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>{{-- oturumdaki succes anahtarına bağlı değeri alır --}}
        @endif
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="appointment_date">Randevu Tarihini Seçiniz</label>
                <input type="date" class="form-control" name="appointment_date" id="appointment_date" required>
            </div>

            <div class="form-group">
                <label for="city">İl Seçiniz</label>
                <select class="form-control" name="city_id" id="city" onchange="fetchDistricts()">//
                    <option value="">Bir şehir seçiniz</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="district-group" style="display: none;">
                <label for="district">İlçe Seçiniz</label>
                <select class="form-control" name="district_id" id="district" onchange="fetchHospitals()">
                    <option value="">Bir ilçe seçiniz</option>
                </select>
            </div>

            <div class="form-group" id="hospital-group" style="display: none;">
                <label for="hospital">Hastane Seçiniz</label>
                <select class="form-control" name="hospital_id" id="hospital" onchange="fetchClinics()">
                    <option value="">Bir hastane seçiniz</option>
                </select>
            </div>

            <div class="form-group" id="clinic-group" style="display: none;">
                <label for="clinic">Klinik Seçiniz</label>
                <select class="form-control" name="clinic_id" id="clinic" onchange="fetchDoctors()">
                    <option value="">Bir klinik seçiniz</option>
                </select>
            </div>

            <div class="form-group" id="doctor-group" style="display: none;">
                <label for="doctor">Doktor Seçiniz</label>
                <select class="form-control" name="doctor_id" id="doctor">
                    <option value="">Bir doktor seçiniz</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Randevuyu Kaydet</button>

        </form>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function fetchDistricts() {
            var city_id = document.getElementById('city')
                .value; //city_id sine sahip select elementinden şehir id'sini alır.
            if (city_id) { //Eğer şehir id'si mevcutsa 
                fetch('/districts/' + city_id) //şehir id'sine bağlı ilçeleri almak için API isteği gönderir
                    .then(response => response.json()) //yanıtı json formatnında alır
                    .then(data => { //district id'sine sahip select elementini bulur 
                        var districtSelect = document.getElementById('district');
                        districtSelect.innerHTML =
                            '<option value="">Bir ilçe seçiniz</option>'; //select elementinin içeriğini temizler ve ilk seçenek olarak bir ilçe seçiniz ekler
                        data.forEach(function(district) {
                            var option = document.createElement('option');
                            option.value = district.id; //ilçenin id'sini optionun value özelliğine atar
                            option.textContent = district.name; //ilçenin adını option'un içeriğine atar
                            districtSelect.appendChild(option); //oluşturukan option'u select elementine ekler.
                        });
                        document.getElementById('district-group').style.display =
                            'block'; //ilçe seçim grubunu görünür yap
                        document.getElementById('hospital-group').style.display = 'none';
                        document.getElementById('clinic-group').style.display = 'none';
                        document.getElementById('doctor-group').style.display = 'none';
                    });
            } else {
                document.getElementById('district').innerHTML =
                '<option value="">Bir ilçe seçiniz</option>'; //Eğer şehir id'si seçilmemişse,ilçe sseçim kutusunu sıfırlar. 
                document.getElementById('district-group').style.display = 'none'; //ilçe grubunu gizler
            }
        }

        function fetchHospitals() {
            var district_id = document.getElementById('district').value;
            if (district_id) {
                fetch('/hospitals/' + district_id)
                    .then(response => response.json())
                    .then(data => {
                        var hospitalSelect = document.getElementById('hospital');
                        hospitalSelect.innerHTML = '<option value="">Bir hastane seçiniz</option>';
                        data.forEach(function(hospital) {
                            var option = document.createElement('option');
                            option.value = hospital.id;
                            option.textContent = hospital.name;
                            hospitalSelect.appendChild(option);
                        });
                        document.getElementById('hospital-group').style.display = 'block';
                        document.getElementById('clinic-group').style.display = 'none';
                        document.getElementById('doctor-group').style.display = 'none';
                    });
            } else {
                document.getElementById('hospital').innerHTML = '<option value="">Bir hastane seçiniz</option>';
                document.getElementById('hospital-group').style.display = 'none';
            }
        }

        function fetchClinics() {
            var hospital_id = document.getElementById('hospital').value;
            if (hospital_id) {
                fetch('/clinics/' + hospital_id)
                    .then(response => response.json())
                    .then(data => {
                        var clinicSelect = document.getElementById('clinic');
                        clinicSelect.innerHTML = '<option value="">Bir klinik seçiniz</option>';
                        data.forEach(function(clinic) {
                            var option = document.createElement('option');
                            option.value = clinic.id;
                            option.textContent = clinic.name;
                            clinicSelect.appendChild(option);
                        });
                        document.getElementById('clinic-group').style.display = 'block';
                        document.getElementById('doctor-group').style.display = 'none';
                    });
            } else {
                document.getElementById('clinic').innerHTML = '<option value="">Bir klinik seçiniz</option>';
                document.getElementById('clinic-group').style.display = 'none';
            }
        }

        function fetchDoctors() {
            var clinic_id = document.getElementById('clinic').value;
            if (clinic_id) {
                fetch('/doctors/' + clinic_id)
                    .then(response => response.json())
                    .then(data => {
                        var doctorSelect = document.getElementById('doctor');
                        doctorSelect.innerHTML = '<option value="">Bir doktor seçiniz</option>';
                        data.forEach(function(doctor) {
                            var option = document.createElement('option');
                            option.value = doctor.id;
                            option.textContent = doctor.name;
                            doctorSelect.appendChild(option);
                        });
                        document.getElementById('doctor-group').style.display = 'block';
                    });
            } else {
                document.getElementById('doctor').innerHTML = '<option value="">Bir doktor seçiniz</option>';
                document.getElementById('doctor-group').style.display = 'none';
            }
        }
    </script>
</body>

</html>
