<?php
include "libs/vars.php";
include "libs/functions.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin") {
  header("Location: login.php");
  return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $date = $_POST["date"];
  $location = $_POST["location"];

  $tags = explode(",", $_POST["tags"]);

  $files = $_FILES["images"]["name"];

  $description = $_POST["description"];

  createEvent($files, $name, $date, $tags, $location, $description);

  $_SESSION["message"] = "Etkinlik başarıyla eklendi.";
  $_SESSION["type"] = "success";
  // echo "<pre>";
  // print_r($files);
  // echo "</pre>";
}

?>


<!DOCTYPE html>
<html id="html" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ayarlar | EventApp</title>
  <link rel="stylesheet" href="css/general.css" />
  <link rel="stylesheet" href="css/account.css" />
</head>

<body>
  <?php include "views/_message.php" ?>
  <?php include "views/_header.php"; ?>

  <!-- CONTENT -->
  <section class="section-account">
    <div class="container">
      <div class="container-inner">
        <?php include "views/_sidebar.php"; ?>

        <div class="main">
          <!-- ADD EVENT SECTION -->
          <div class="add-event-section">
            <h2 class="heading-secondary">Etkinlik Ekle</h2>

            <div class="settings-box">
              <h3 class="heading-tertiary">Etkinlik Bilgileri</h3>
              <form class="form-settings" enctype="multipart/form-data"
                method="POST">
                <div class="controls">
                  <div>
                    <label class="label" for="name">Etkinlik Adı</label>
                    <input class="control-text" type="text" name="name"
                      id="name" />
                  </div>

                  <div>
                    <label class="label" for="date">Tarih ve Zaman</label>
                    <input class="control-text" type="text" name="date"
                      id="date" />
                  </div>

                  <div>
                    <label class="label" for="location">Etkinlik Konumu</label>
                    <input class="control-text" type="text" name="location"
                      id="location" />
                  </div>

                  <div>
                    <label class="label">Etkinlik Türü</label>
                    <div class="control-tag-box">
                      <div>
                        <select class="dropdown" id="selectTag">
                          <option value="">Kategoriler</option>
                          <option value="Ücretsiz">Ücretsiz</option>
                          <option value="Stand Up">Stand Up</option>
                          <option value="Söyleşi">Söyleşi</option>
                          <option value="Konser">Konser</option>
                          <option value="Film Gösterimi">Film Gösterimi</option>
                          <option value="Deneyim">Deneyim</option>
                          <option value="Satışta">Satışta</option>
                        </select>
                        <input class="hidden" type="text" name="tags"
                          id="sendTags">
                        <button class="btn-dropdown" name="btnAddTag"
                          id="btnAddTag">Ekle</button>
                      </div>

                      <div class="tag-box" id="eventTagBox">
                        <!-- <div class="tag tag--event">
                          <span>Stand Up</span>
                          <img src="img/icons/cancel.svg" class="tag-icon" alt="" />
                        </div> -->
                      </div>
                    </div>
                  </div>

                  <div>
                    <p class="label">Etkinlik Resimleri</p>
                    <div class="control-tag-box">
                      <div>
                        <label for="imagesToUpload" class="dropdown">
                          Dosya seç...
                        </label>
                        <!-- multiple file secimi icin ayarla:-->
                        <input class="hidden" id="imagesToUpload" type="file"
                          multiple="multiple" name="images[]" />
                      </div>

                      <div class="tag-box" id="imageTagBox">
                        <!-- script ile dinamik olarak eklenecek: -->
                        <!-- <div class="tag">
                          <span>etkinlik1.jpg</span>
                          <img src="img/icons/cancel.svg" class="tag-icon" alt="" />
                        </div> -->
                      </div>
                    </div>
                  </div>

                  <div>
                    <label class="label" for="description">Etkinlik
                      Açıklaması</label>
                    <textarea name="description" class="control-textarea"
                      id="description" cols="30" rows="10"></textarea>
                  </div>
                </div>

                <button class="btn btn--settings" type="submit"
                  name="btnForm">Kaydet</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <?php include "views/_footer.php"; ?>
  <script src="js/add-event.js"></script>
</body>

</html>