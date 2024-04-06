const btnMobile = document.querySelector(".btn-mobile-nav");
const header = document.querySelector(".header");

btnMobile.addEventListener("click", () => {
  header.classList.toggle("nav-open");
  document.documentElement.classList.toggle("overflow-y");
});

/* overview page responsive filter functionality */

if (window.location.pathname === "/") {
  const modal = document.querySelector(".modal");
  const overlay = document.querySelector(".overlay");
  const btnMobileFilter = document.querySelector(".btn-mobile-filter");
  const modalCloseIcon = document.querySelector(".modal-icon");

  const closeModal = (e) => {
    e.preventDefault();
    modal.classList.add("hidden");
  };

  const openModal = (e) => {
    e.preventDefault();
    modal.classList.remove("hidden");
  };

  btnMobileFilter.addEventListener("click", openModal);
  overlay.addEventListener("click", closeModal);
  modalCloseIcon.addEventListener("click", closeModal);
}

/* Account page tabs functionality */

if (window.location.pathname === "/account.html") {
  const linkSec1 = document.querySelectorAll(".sec-1");
  const linkSec2 = document.querySelectorAll(".sec-2");
  const linkSec3 = document.querySelectorAll(".sec-3");
  const linkSec4 = document.querySelectorAll(".sec-4");
  const accountSec = document.querySelector(".account-section");
  const addEventSec = document.querySelector(".add-event-section");
  const eventsSec = document.querySelector(".events-section");
  const applicationsSec = document.querySelector(".applications-section");

  const activateAccountSec = () => {
    console.log("sec-1 clicked");
    addEventSec.classList.remove("display-flex");
    eventsSec.classList.remove("display-flex");
    applicationsSec.classList.remove("display-flex");
    accountSec.classList.add("display-flex");
  };

  const activateAddEventSec = () => {
    console.log("sec-2 clicked");
    eventsSec.classList.remove("display-flex");
    applicationsSec.classList.remove("display-flex");
    accountSec.classList.remove("display-flex");
    addEventSec.classList.add("display-flex");
  };

  const activateEventsSec = () => {
    console.log("sec-3 clicked");
    addEventSec.classList.remove("display-flex");
    applicationsSec.classList.remove("display-flex");
    accountSec.classList.remove("display-flex");
    eventsSec.classList.add("display-flex");
  };

  const activateApplicationsSec = () => {
    console.log("sec-4 clicked");
    addEventSec.classList.remove("display-flex");
    eventsSec.classList.remove("display-flex");
    accountSec.classList.remove("display-flex");
    applicationsSec.classList.add("display-flex");
  };

  console.log(linkSec1);
  console.log(linkSec2);
  console.log(linkSec3);
  console.log(linkSec4);

  linkSec1[0].addEventListener("click", activateAccountSec);
  linkSec1[1].addEventListener("click", activateAccountSec);
  linkSec2[0].addEventListener("click", activateAddEventSec);
  linkSec2[1].addEventListener("click", activateAddEventSec);
  linkSec3[0].addEventListener("click", activateEventsSec);
  linkSec3[1].addEventListener("click", activateEventsSec);
  linkSec4[0].addEventListener("click", activateApplicationsSec);
  linkSec4[1].addEventListener("click", activateApplicationsSec);
}
