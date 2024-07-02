<?= $this->extend('User/Layout/v_template'); ?>

<?= $this->section('content'); ?>

<!-- Template Main Content -->
<style>
    main.kontainer-content {
        margin-left: 18.5%;
        height: 100%;
    }

    main.kontainer-content header.first {
        height: 11.1vh !important;
    }

    main.kontainer-content header.second {
        height: 11vh !important;

    }
</style>
<main class="wrapper-content">
    <div class="wrapper-body">
        <div class="body-satu">
            <div class="date">
                <div class="text">Waktu & Tanggal</div>
                <div class="date-time">
                    <h3 class="current-time" id="current-time"></h3>
                    <h3 class="date-today" id="date-today"></h3>
                </div>
            </div>
        </div>
        <div class="body-dua">
            <form action="<?= route_to('/permission') ?>" method="post" enctype="multipart/form-data">
                <div class="grid-satu">
                    <div class="wrapper-bukti">
                        <div class="wrapper-izin">
                            <select name="menu" id="menu" onchange="updateValue()">
                                <option value="" hidden></option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                            </select>
                        </div>
                        <div class="wrapper-image">
                            <div class="profile-body">
                                <img id="preview" src="#" alt="File yang anda masukan bukan gambar" />
                            </div>
                            <div class="text">
                                <label for="upload" class="uploud-image bg-primary bg-gradient">Pilih Gambar</label>
                            </div>
                            <input name="foto_absen" type="file" id="upload" accept=".png, .jpg, .jpeg" style="display: none; visibility: hidden" value="<?= set_value('foto_absen'); ?>" />
                        </div>
                    </div>
                    <div class="wrapper-maps">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="grid-dua">
                    <div class="wrapper">
                        <div class="textareaWrapper">
                            <h3>Keterangan :</h3>
                            <textarea name="keterangan" id="" cols="30" rows="10" placeholder="Isi Disini..."></textarea>
                        </div>
                        <div class="kbWrapper">
                            <div class="kordinatWrapper">
                                <div class="lat">latitude <span>:</span>
                                    <input name="lat" type="text" id="latitude" readonly /> <br />
                                </div>
                                <div class="long">longitude <span>:</span>
                                    <input name="long" type="text" id="longitude" readonly />
                                </div>
                            </div>
                            <div class="buttonWrapper">
                                <input type="submit" name="submit" value="Submit" class="bg-success bg-gradient">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
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

        const fileInput = document.getElementById("upload");
        const preview = document.getElementById("preview");

        fileInput.addEventListener("change", function() {
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Menampilkan gambar yang dipilih dalam elemen img
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };

                // Membaca file sebagai URL data
                reader.readAsDataURL(file);
            } else {
                // Mengosongkan elemen img jika tidak ada gambar yang dipilih
                preview.src = "#";
                preview.style.display = "none";
            }
        });

        // Tanggal
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
    <script src="<?= base_url('admin') ?>/js/perms.js"></script>
</main>

<?= $this->endSection(); ?>