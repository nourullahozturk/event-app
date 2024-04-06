const profileTagBox = document.getElementById("profileTagBox");
const profileImg = document.getElementById("profileImg");

profileImg.addEventListener("change", () => {
  // console.log(profileImg.value);
  // console.log(profileImg.files[0].name);
  console.log("input changed");
  const filename = profileImg.files[0].name;

  let html = `
  <div class="tag">
    <span>${filename}</span>
    <img src="img/icons/cancel.svg" class="tag-icon" alt="" />
  </div>  
  `;
  profileTagBox.innerHTML = html;
});

document.addEventListener("click", (e) => {
  if (e.target.closest(".tag")) {
    profileImg.value = "";
    // imageTagBox1.innerHTML = "";
    e.target.closest(".tag").remove();
  }
});
