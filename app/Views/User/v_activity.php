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

<main class="wrapper-content-activity">
    <!-- <header>Isi Kehadiran Anda</header> -->
    <div class="wrapper-body-activity">
        <div class="body-satu-activity">
            <div class="date">
                <div class="text">Time & Date</div>
                <div class="date-time">
                    <h3 id="current-time"></h3>
                    <h3 id="date-today"></h3>
                </div>
            </div>
        </div>
        <div class="body-dua-activity">
            <form id="myForm" action="<?= site_url('user/activityProccess') ?>" method="post" enctype="multipart/form-data">
                <div class="grid-satu-activity">
                    <div class="row justify-content-md-center">
                        <div class="container">
                            <h3>Documentation</h3>
                            <div class="row">
                                <div class="col-sm">
                                    <div id="my_camera" class="mx-auto rounded overflow-hidden col-lg"></div>
                                </div>
                                <div class="col">
                                    <button type="button" id="takephoto" style="border:2px solid black; margin-top:20px; margin-bottom: 20px">
                                        <a href="#hasil">
                                            <i class="fa-solid fa-camera"></i>
                                        </a>
                                    </button>
                                </div>
                            </div>
                            <div class="row customFile" style="flex-wrap:wrap; margin-left:10px; width:90%">
                                <div class="customAddFile" style="width: 35%;">
                                    <label for="upload" class="upload-image customUpload">Add File</label>
                                </div>
                                <div class="customFileSelected" style="width: 65%;">
                                    <span id="file-chosen" class="filename customFileChosen">No file selected</span>
                                </div>
                            </div>
                            <input name="foto_absen" type="file" id="upload" accept=".png, .jpg, .jpeg" style="display: none;" onchange="updateFileDetails()"/>
                        </div>
                    </div>
                </div>
                <div class="grid-dua-activity">
                    <div class="container" style="justIfy-content:start">
                        <div class="row custom-row">
                            <div class="col-6" style="border:2px solid black; width:49%">
                                <textarea rows="8" placeholder="Description...." style="width: 100%; padding:10px 15px; margin-top:5px; border:2px solid black"></textarea>
                                <select class="form-select border border-dark data-container" id="lokasi" aria-label="multiple select example">
                                    <option disabled selected>Location</option>
                                    <option value="Gedung Karya">Karya</option>
                                    <option value="Gedung Karsa">Karsa</option>
                                    <option value="Gedung Cipta">Cipta</option>
                                    <option value="Merdeka Timur">Merdeka Timur</option>
                                </select>
                                <select class="form-select border-dark mt-3" aria-label="Default select example" id="lantai">
                                   <option disabled selected>Floor</option>
                                    
                                </select>
                                <div class="buttonWrapper">
                                    <button type="submit" class="btn btn-primary" name="mulai" value="Start Time" style="border:2px solid black;">Start Time</button>
                                    <button type="submit" class="btn btn-success" name="selesai" value="End Time" style="border:2px solid black;">End Time</button>
                                </div>
                            </div>
                            <div class="col-6 ml-4" style="border:2px solid black;">
                                <h3 style="margin:10px;">Image Result :</h3>
                                <div id="results" class=""></div>
                                <input type="hidden" id="photoStore" name="photoStore" value="">
                                <img name="foto" for="activity" class="screenshot responsive" id="output" src="<?= base_url('uploadFoto/activityprofile.png') ?>" alt="" style="-webkit-transform: scaleX(-1); transform: scaleX(-1);">
                            </div>
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

        dateToday.textContent = `${month} / ${day} / ${year}`;

        // Waktu
        let time = document.getElementById("current-time");

        setInterval(() => {
            let d = new Date();
            time.innerHTML = d.toLocaleTimeString();
        }, 1000);

        // filter lantai
        var lokasi_dan_lantai = {
            "Gedung Karya": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25],
            "Gedung Karsa": [1, 2, 3, 4, 5, 6, 7, 8, 9],
            "Gedung Cipta": [1, 2, 3, 4, 5, 6, 7],
            "Merdeka Timur": [1, 2, 3]
        };
        document.getElementById('lokasi').addEventListener('change', function () {
            var selectedLocation = this.value;
            var floor = lokasi_dan_lantai[selectedLocation];
            updateLokasi(floor);
        });
    
        function updateLokasi(floor) {
            var lantaiDropdown = document.getElementById('lantai');
            lantaiDropdown.innerHTML = "";

        floor.forEach(function(floorNumber) {
            var option = document.createElement('option');
            option.value = floorNumber;
            option.text = floorNumber;
            lantaiDropdown.add(option);
        });

    }

        // Upload Foto
        function updateFileDetails() {
        const fileInput = document.getElementById('upload');
        const fileChosen = document.getElementById('file-chosen');
        
        if (fileInput.files.length > 0) {
            // Menampilkan nama file di samping Add File
            fileChosen.textContent = fileInput.files[0].name;

            // Menampilkan gambar pratinjau di Documentation Results
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(fileInput.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src); // free memory
            };
        } else {
            fileChosen.textContent = 'No file selected';
        }
    }
    </script>

</main>
<?= $this->endSection(); ?>