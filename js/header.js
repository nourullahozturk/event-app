const btnMobile = document.querySelector(".btn-mobile-nav");
const header = document.querySelector(".header");

btnMobile.addEventListener("click", () => {
  header.classList.toggle("nav-open");
  document.documentElement.classList.toggle("overflow-y");
});
