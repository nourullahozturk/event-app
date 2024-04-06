<?php
include "libs/vars.php";
include "libs/functions.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin") {
  header("Location: login.php");
  return;
}

$events = getData()["events"];

if (isset($_SESSION["event"]["id"])) {
  foreach ($events as $key => $event) {
    if ($event["id"] == $_SESSION["event"]["id"]) {
      $currentKey = $key;
    }
  }
} else {
  $currentKey = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // 0.Etkinlikten farkli bir etkinlik seçilmişse currentEvent bilgisini güncelle
  if (isset($_POST["btnGetEvents"])) {
    $currentKey = (int)$_POST["selectEvent"];
    $_SESSION["event"] = [
      "id" => $events[$currentKey]["id"]
    ];
  }

  if (isset($_POST["btnForm"])) {

    $id = $events[$currentKey]["id"];

    if (isset($_FILES["images"])) {
      $images = $_FILES["images"]["name"];
    } else {
      $images = $events[$currentKey]["images"];
    }

    $name = $_POST["name"];
    $date = $_POST["date"];
    $tags = explode(",", $_POST["tags"]);
    $location = $_POST["location"];
    $description = $_POST["description"];
    $isActive = $_POST["radio"] == "true" ? true : false;

    $updatedEvent = [
      "id" => $id,
      "images" => $images,
      "title" => $name,
      "date" => $date,
      "tags" => $tags,
      "location" => $location,
      "description" => $description,
      "is-active" => $isActive
    ];

    updateEvent($updatedEvent);
    $_SESSION["message"] = "Etkinlik başarıyla güncellendi";
    $_SESSION["type"] = "success";
  }

  if (isset($_POST["btnForm2"])) {
    deleteEvent($events[$currentKey]["id"]);
    unset($_SESSION["event"]);
    $currentKey = 0;
    $_SESSION["message"] = "Etkinlik başarıyla silindi";
    $_SESSION["type"] = "success";
  }
}
// Güncellenmiş verileri al
$events = getData()["events"];
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
          <!-- EVENTS SECTION -->
          <div class="events-section">
            <h2 class="heading-secondary">Etkinliklerim</h2>

            <div class="settings-box">
              <h3 class="heading-tertiary">Etkinlik Seç</h3>
              <form method="POST">
                <select class="dropdown" name="selectEvent">
                  <?php foreach ($events as $key => $event) : ?>
                    <option value="<?php echo $key; ?>" <?php if ($currentKey == $key) echo "selected"; ?>>
                      <?php echo $event["title"]; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <button class="btn-dropdown" type="submit" name="btnGetEvents">Bilgileri Getir</button>
              </form>
            </div>

            <div class="settings-box">
              <h3 class="heading-tertiary">Etkinlik Bilgileri Düzenle</h3>
              <form class="form-settings" method="POST" enctype="multipart/form-data">
                <div class="controls">
                  <div>
                    <label class="label" for="name">Etkinlik Adı</label>
                    <input class="control-text" type="text" name="name" id="name" value="<?php echo $events[$currentKey]["title"]; ?>" />
                  </div>

                  <div>
                    <label class="label" for="date">Tarih ve Zaman</label>
                    <input class="control-text" type="text" name="date" id="date" value="<?php echo $events[$currentKey]["date"]; ?>" />
                  </div>

                  <div>
                    <label class="label" for="location">Etkinlik Konumu</label>
                    <input class="control-text" type="text" name="location" id="location" value="<?php echo $events[$currentKey]["location"]; ?>" />
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
                        <input class="hidden" type="text" name="tags" id="sendTags">
                        <button class="btn-dropdown" name="btnAddTag" id="btnAddTag">Ekle</button>
                      </div>
                      <div class="tag-box" data-tags="<?php echo implode(",", $events[$currentKey]["tags"]); ?>" id="eventTagBox">
                        <!-- <div class="tag tag--event">
                          <span>Söyleşi</span>
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
                        <input class="hidden" id="imagesToUpload" type="file" name="images[]" multiple="multiple" />
                      </div>

                      <div class="tag-box" data-images="<?php echo implode(",", $events[$currentKey]["images"]); ?>" id="imageTagBox">
                        <!-- <div class="tag tag--image">
                          <span>etkinlik1.jpg</span>
                          <img src="img/icons/cancel.svg" class="tag-icon" alt="" />
                        </div> -->
                      </div>
                    </div>
                  </div>

                  <div>
                    <label class="label" for="description">Etkinlik
                      Açıklaması</label>
                    <textarea name="description" class="control-textarea" id="description"><?php echo $events[$currentKey]["description"]; ?></textarea>
                  </div>

                  <div>
                    <p class="label">Aktiflik Durumu</p>
                    <div class="radio-box">
                      <label class="radio-label">
                        <input class="radio-input hidden" type="radio" name="radio" value="true" <?php if ($events[$currentKey]["is-active"]) echo "checked"; ?> />
                        <span class="radio-btn"></span>
                        Aktif
                      </label>
                      <label class="radio-label">
                        <input class="radio-input hidden" type="radio" name="radio" value="false" <?php if (!$events[$currentKey]["is-active"]) echo "checked"; ?> />
                        <span class="radio-btn"></span>
                        Sonlanmış
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-buttons">
                  <button class="btn btn--settings" type="submit" name="btnForm">Kaydet</button>
                  <button class="btn btn--delete" type="submit" name="btnForm2">Etkinliği Sil</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <?php include "views/_footer.php"; ?>
  <script src="js/edit-event.js"></script>
</body>

</html>