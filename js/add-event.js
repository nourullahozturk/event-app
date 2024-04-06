const btnAddTag = document.getElementById("btnAddTag");
const selectTag = document.getElementById("selectTag");
const sendTags = document.getElementById("sendTags");
const eventTagBox = document.getElementById("eventTagBox");
const imageTagBox = document.getElementById("imageTagBox");
const imagesToUpload = document.getElementById("imagesToUpload");
const dt = new DataTransfer();

/*******************************************************/
/* Event tagleri için */
/*******************************************************/

let tags = [];

console.log(btnAddTag);

btnAddTag.addEventListener("click", (e) => {
  e.preventDefault();

  // Bir tag seçildi mi? ve Aynı tag dizide yok mu?
  if (selectTag.value != "" && !tags.includes(selectTag.value)) {
    let html = ``;
    tags.push(selectTag.value);

    tags.forEach((tag) => {
      html += `
      <div class="tag tag--event">
        <span>${tag}</span>
        <img src="img/icons/cancel.svg" class="tag-icon" alt="" />
      </div>
      `;
    });

    eventTagBox.innerHTML = html;
    sendTags.value = tags;
  }
});

// Event tag silme fonksiyonu:

document.addEventListener("click", (e) => {
  if (e.target.closest(".tag--event")) {
    let spanText = e.target.closest(".tag--event").children[0].innerText;

    // tagı Domdan kaldır
    e.target.closest(".tag--event").remove();

    // Dom'dan kaldırılan tagı diziden de çıkar:
    tags = tags.filter((tag) => tag !== spanText);

    sendTags.value = tags;
  }
});

/*******************************************************/
/* Image tagleri için  */
/*******************************************************/

let imagesArr = [];

imagesToUpload.addEventListener("change", () => {
  // console.log(imagesToUpload.files);

  for (let file of imagesToUpload.files) {
    dt.items.add(file);
  }

  let html = ``;

  const filesArr = [...imagesToUpload.files];
  filesArr.forEach((file) => {
    // console.log(file.name);
    html += `
    <div class="tag tag--image">
      <span>${file.name}</span>
      <img src="img/icons/cancel.svg" class="tag-icon" alt="" />
    </div>
    `;
  });

  imageTagBox.innerHTML = html;
});

// Image tag silme fonksiyonu:

document.addEventListener("click", (e) => {
  if (e.target.closest(".tag--image")) {
    const filename = e.target.closest(".tag--image").children[0].innerText;

    e.target.closest(".tag--image").remove();

    for (let i = 0; i < dt.files.length; i++) {
      if (filename === dt.files[i].name) {
        dt.items.remove(i);
      }
    }

    imagesToUpload.files = dt.files;
  }
});
