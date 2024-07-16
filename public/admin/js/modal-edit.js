/**UNTUK MODAL EDIT */
function refresh() {
  window.location.reload(true);
}

function bersihkanEdit() {
  $("#inputId").val("");
  $("#editNamaLengkap").val("");
  $("#editNimNis").val("");
  $("#editUsername").val("");
  $("#editGender").val("");
  $("#editNoHP").val("");
  $("#editEmail").val("");
  $("#editInstansi").val("");
  $("#editNamaInstansi").val("");
  $("#editNamaPembimbing").val("");
  $("#editNoPembimbing").val("");

  // Hapus validasi
  $("#editNamaLengkap").removeClass("is-invalid");
  $("#editNimNis").removeClass("is-invalid");
  $("#editUsername").removeClass("is-invalid");
  $("#editGender").removeClass("is-invalid");
  $("#editNoHP").removeClass("is-invalid");
  $("#editEmail").removeClass("is-invalid");
  $("#editInstansi").removeClass("is-invalid");
  $("#editNamaInstansi").removeClass("is-invalid");
  $("#editNamaPembimbing").removeClass("is-invalid");
  $("#editNoPembimbing").removeClass("is-invalid");
}

function hapusValidasiEdit() {
  // Hapus validasi
  $("#editNamaLengkap").removeClass("is-invalid");
  $("#editNimNis").removeClass("is-invalid");
  $("#editUsername").removeClass("is-invalid");
  $("#editGender").removeClass("is-invalid");
  $("#editNoHP").removeClass("is-invalid");
  $("#editEmail").removeClass("is-invalid");
  $("#editInstansi").removeClass("is-invalid");
  $("#editNamaInstansi").removeClass("is-invalid");
  $("#editNamaPembimbing").removeClass("is-invalid");
  $("#editNoPembimbing").removeClass("is-invalid");
}

$(".tombol-tutup-edit").on("click", function () {
  bersihkanEdit();
});
