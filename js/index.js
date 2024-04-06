/* index.php responsive filter functionality */
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

/* index.php sorting functionality */

const sortEl = document.getElementById("sort");
const eventCards = [...document.querySelectorAll(".card")];
const cardContainer = eventCards[0].parentNode;
let ascendingOrder = false;

const selector = (element) =>
  Number(element.querySelector("#createdAt").innerText);

function sortCards() {
  console.log("sorting...");
  eventCards.sort((card1, card2) => {
    let dateOfCard1 = selector(card1);
    let dateOfCard2 = selector(card2);
    return ascendingOrder
      ? dateOfCard1 - dateOfCard2
      : dateOfCard2 - dateOfCard1;
  });
  eventCards.forEach((el) => cardContainer.appendChild(el));
}

sortEl.addEventListener("change", function () {
  console.log("You selected: ", this.value);
  if (this.value == "1") {
    ascendingOrder = false;
    sortCards();
  }
  if (this.value == "2") {
    ascendingOrder = true;
    sortCards();
  }
});
