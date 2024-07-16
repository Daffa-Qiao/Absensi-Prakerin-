/**UNTUK MODAL TAMBAH */
function refresh() {
  window.location.reload(true);
}

function bersihkan() {
  $("#inputNamaLengkap").val("");
  $("#inputNimNis").val("");
  $("#inputUsername").val("");
  $("#inputGender").val("");
  $("#inputNoHP").val("");
  $("#inputEmail").val("");
  $("#inputInstansi").val("");
  $("#inputNamaInstansi").val("");
  $("#inputPembimbing").val("");
  $("#inputNoPembimbing").val("");
  // Hapus validasi
  $("#inputNamaLengkap").removeClass("is-invalid");
  $("#inputNimNis").removeClass("is-invalid");
  $("#inputUsername").removeClass("is-invalid");
  $("#inputGender").removeClass("is-invalid");
  $("#inputNoHP").removeClass("is-invalid");
  $("#inputEmail").removeClass("is-invalid");
  $("#inputInstansi").removeClass("is-invalid");
  $("#inputNamaInstansi").removeClass("is-invalid");
  $("#inputNamaPembimbing").removeClass("is-invalid");
  $("#inputNoPembimbing").removeClass("is-invalid");
}

function hapusValidasi() {
  // Hapus validasi
  $("#inputNamaLengkap").removeClass("is-invalid");
  $("#inputNimNis").removeClass("is-invalid");
  $("#inputUsername").removeClass("is-invalid");
  $("#inputGender").removeClass("is-invalid");
  $("#inputNoHP").removeClass("is-invalid");
  $("#inputEmail").removeClass("is-invalid");
  $("#inputInstansi").removeClass("is-invalid");
  $("#inputNamaInstansi").removeClass("is-invalid");
  $("#inputNamaPembimbing").removeClass("is-invalid");
  $("#inputNoPembimbing").removeClass("is-invalid");
}

$(".tombol-tutup").on("click", function () {
  bersihkan();
});
