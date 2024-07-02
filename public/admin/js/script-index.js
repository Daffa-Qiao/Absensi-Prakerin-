// Choese image
let display = document.getElementById("display_image");
let display_h = document.getElementById("display_image_h");
let input = document.querySelector("#upload");
let submit = document.getElementsByClassName("submit");
let display_c = document.querySelector("#display_c");
let nav = document.querySelector("nav ul");
let base_img = document.getElementById("base_img");

input.addEventListener("change", () => {
  let reader = new FileReader();
  reader.readAsDataURL(input.files[0]);
  reader.addEventListener("load", () => {
    base_img.remove();
    display.innerHTML = `<img src=${reader.result} alt='' width="200px"" id="display_c"/>`;
  });
});

function updateValueG() {
  // Mendapatkan elemen <select> berdasarkan ID
  var selectElementG = document.getElementById("gender");

  // Mendapatkan nilai terpilih (value) dari elemen <select>
  var selectedValueG = selectElementG.value;

  // Mengisi nilai terpilih ke dalam elemen <input> yang tersembunyi
  document.getElementById("selected_gender").value = selectedValueG;
}

function updateValueI() {
  var selectElementI = document.getElementById("instansi");
  var selectedValueI = selectElementI.value;
  document.getElementById("selected_instansi").value = selectedValueI;
}

const menu = document.querySelector(".wrapper-icon i");
const menuSide = document.querySelector("nav .wrapper-icon i");
const navv = document.querySelector("nav");

menu.addEventListener("click", () => {
  navv.classList.toggle("close");
});
