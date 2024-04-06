const btnAddTag = document.getElementById("btnAddTag");
const selectTag = document.getElementById("selectTag");
// hidden input element:
const sendTags = document.getElementById("sendTags");
const eventTagBox = document.getElementById("eventTagBox");
const imageTagBox = document.getElementById("imageTagBox");
const imagesToUpload = document.getElementById("imagesToUpload");
const dt = new DataTransfer();

/*******************************************************/
/* Event tagleri için */
/*******************************************************/

/* Event tag input değerleri ilk değer atama: */

let html = "";

let tags = eventTagBox.dataset.tags.split(",");

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
html = "";

/* Event tag fonkisyonları: */

/*
Tekli seçim elementini birden fazla seçimi sunucuya göndermek için
kullanıyoruz. Bunun için seçimleri bir dizide toplayıp gizli bir
input elementine değer olarak verdik.
*/
// bu fonksiyon seçilen tagleri bir dizide
// toplar ve input elementine değer olarak verir.
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

/* Image tagleri ilk değer atama: */

let imagesArr = imageTagBox.dataset.images.split(",");

imagesArr.forEach((image) => {
  html += `
  <div class="tag tag--image tag--disabled">
    <span>${image}</span>
    <img src="img/icons/cancel.svg" class="tag-icon" alt="" />
  </div>
  `;
});

imageTagBox.innerHTML = html;
html = "";

/*
Dosyaları önceden upload etmeye gerek yok eger user yeni bir dosya
eklemeye kalkarsa zaten eskisi dosyaların yerine eklenecek
önceki dosyaları tutmanın bir anlamı yok. Eğer user bir dosya
yüklemesi yapmazsa veritabanına hiç bir dosya eklenmeyecek.
*/

/* Image tag fonkisyonları: */

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
  if (
    e.target.closest(".tag--image") &&
    !e.target.closest(".tag--image").classList.contains("tag--disabled")
  ) {
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
