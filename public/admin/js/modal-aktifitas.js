/**UNTUK MODAL AKTIFITAS */
function refresh() {
    window.location.reload(true);
  }
  
  function bersihkanAktifitas() {
    $("#laporanNimNis").val("");
    $("#laporanStatus").val("");
    $("#inputLokasi").val("");
    $("#inputMulai").val("");
    $("#inputSelesai").val("");
    $("#laporanFoto").val("");
    $("#laporanKeterangan").val("");
    $("#inputTanggal").val("");
  
    // Hapus validasi
    $("#laporanNimNis").removeClass("is-invalid");
    $("#laporanStatus").removeClass("is-invalid");
    $("#inputLokasi").removeClass("is-invalid");
    $("#inputMulai").removeClass("is-invalid");
    $("#inputSelesai").removeClass("is-invalid");
    $("#laporanFoto").removeClass("is-invalid");
    $("#laporanKeterangan").removeClass("is-invalid");
    $("#inputTanggal").removeClass("is-invalid");
  }
  
  function hapusValidasiAktifitas() {
    // Hapus validasi
    $("#laporanNimNis").removeClass("is-invalid");
    $("#laporanStatus").removeClass("is-invalid");
    $("#inputLokasi").removeClass("is-invalid");
    $("#inputMulai").removeClass("is-invalid");
    $("#inputSelesai").removeClass("is-invalid");
    $("#laporanFoto").removeClass("is-invalid");
    $("#laporanKeterangan").removeClass("is-invalid");
    $("#inputTanggal").removeClass("is-invalid");
  }
  
  $(".tombol-tutup-aktifitas").on("click", function () {
    bersihkanAktifitas();
  });
  