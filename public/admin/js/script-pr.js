// dropdown
const menu = document.querySelector(".wrapper-icon i");
const nav = document.querySelector("nav");

const img = document.querySelector(".user-profile img");
const dropdown = document.querySelector("header.first .dropdownMenu");

menu.addEventListener("click", () => {
  nav.classList.toggle("close");
});
img.addEventListener("click", () => {
  dropdown.classList.toggle("active");
});
