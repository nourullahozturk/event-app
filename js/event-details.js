const heroImageBox = document.querySelector(".hero-image");

document.addEventListener("click", (e) => {
  const imgBox = e.target.closest(".other-image");

  if (imgBox) {
    let fileName = imgBox.children[0].dataset.fileName;
    console.log(imgBox.children[0].dataset.fileName);
    heroImageBox.innerHTML = `<img src="img/events/${fileName}" class="img-event" />`;
  }
});
