<?= $this->extend('User/Layout/v_template'); ?>

<?= $this->section('content'); ?>
<style>
    main.kontainer-content {
        height: 100%;
    }

    main.kontainer-content header.second {
        height: 11vh !important;
    }

    main.kontainer-content header.first {
        height: 11.1vh !important;
    }
</style>

<main class="wrapper-content-attendance">
    <!-- <header>Isi Kehadiran Anda</header> -->
    <div class="wrapper-body-attendance">
        <div class="body-satu-attendance">
            <div class="date">
                <div class="text">Time & Date</div>
                <div class="date-time">
                    <h3 id="current-time"></h3>
                    <h3 id="date-today"></h3>
                </div>
            </div>
        </div>
        <div class="body-dua-attendance">
            <form id="myForm" action="<?= site_url('user/attendanceProccess') ?>" method="post" enctype="multipart/form-data">
                <div class="grid-satu-attendance">
                    <div class="wrapper-image">
                        <div class="image">
                            <div id="my_camera" class="mx-auto rounded overflow-hidden"></div>
                        </div>
                        <div class="text">
                            <button type="button" id="takephoto">
                                <a href="#hasil">
                                    <i class="fa-solid fa-camera"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="wrapper-maps">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="grid-dua-attendance">
                    <div class="wrapper-attendance">
                        <div class="hasilWrapper" id="hasil">
                            <h3>Image Results :</h3>
                            <div id="results" class=""></div>
                            <input type="hidden" id="photoStore" name="photoStore" value="">
                            <img name="foto" for="absen" class="screenshot" src="<?= base_url('uploadFoto/profile.png') ?>" alt="">
                        </div>
                        <div class="kbWrapper">
                            <div class="kordinatWrapper">
                                <div class="lat">latitude <span>:</span>
                                    <input type="text" name="lat" id="latitude" readonly /> <br />
                                </div>
                                <div class="long">longitude <span>:</span>
                                    <input type="text" name="long" id="longitude" readonly />
                                </div>
                            </div>
                            <div class="buttonWrapper">
                                <input type="submit" name="checkin" value="Check-In" class="bg-success bg-gradient">
                                <input type="submit" name="checkout" value="Check-Out" class="bg-primary bg-gradient">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
    </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script src="<?= base_url('admin') ?>/js/webcamjs/webcam.min.js"></script>
    <script>
        $(document).ready(function() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
        })
        $('#takephoto').on('click', take_snapshot);

        function take_snapshot() {
            //take snapshot and get image data
            Webcam.snap(function(data_uri) {
                //display result image
                $('#results').html('<img src="' + data_uri + '" class="gambar d-block mx3-auto rounded" name = "gambar"/>');

                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                $('#photoStore').val(raw_image_data);
                $('.screenshot').addClass('d-none');
            })
        };

        var buttonFoto = false;
        document.getElementById('takephoto').addEventListener('click', function() {
            buttonFoto = true; // Tombol telah diklik
        });

        document.getElementById('myForm').addEventListener('submit', function(event) {
            if (!buttonFoto) {
                event.preventDefault(); // Mencegah submit formulir
                Swal.fire({
                    icon: 'error',
                    title: 'Harus absen dengan foto',

                })
            }
        });

        // maps
        const getLocationButton = document.getElementById("getLocation");
        const latitudeInput = document.getElementById("latitude");
        const longitudeInput = document.getElementById("longitude");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const accuracy = position.coords.accuracy;

                // Memasukkan nilai latitude dan longitude ke dalam input
                latitudeInput.value = latitude;
                longitudeInput.value = longitude;
                var map = L.map("map").setView([latitude, longitude], 130);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);
                var marker = L.marker([latitude, longitude]).addTo(map);
                var circle = L.circle([latitude, longitude], {
                    radius: accuracy
                }).addTo(map);
                map.fitBounds(circle.getBounds())

                var googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }).addTo(map)

            });
        }
        //Tanggal
        let dateToday = document.getElementById("date-today");

        let today = new Date();
        let day = `${today.getDate() < 10 ? "0" : ""}${today.getDate()}`;

        let month = `${today.getMonth() + 1 < 10 ? "0" : ""}${today.getMonth() + 1}`;
        let year = today.getFullYear();

        dateToday.textContent = `${day} / ${month} / ${year}`;

        // Waktu
        let time = document.getElementById("current-time");

        setInterval(() => {
            let d = new Date();
            time.innerHTML = d.toLocaleTimeString();
        }, 1000);
    </script>

</main>
<?= $this->endSection(); ?>