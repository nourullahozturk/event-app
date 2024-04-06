<?php
include "libs/vars.php";
include "libs/functions.php";

$eventId = $_GET["id"];
$event = getEvent($eventId);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["apply"])) {;
  // Kullanıcı kayıtlı mı?
  if (!isset($_SESSION["user"])) {
    // error message
    $_SESSION["message"] = "Kullanıcı kayıtlı değil";
    $_SESSION["type"] = "error";
    header("Location: login.php");
    return;
  }

  //Kullanıcı daha önce bu etkinliğe başvurmuş mu?
  if (checkApplication($_SESSION["user"]["id"], $eventId)) {
    // error message
    $_SESSION["message"] = "Kullanıcı daha önce bu etkinliğe başvurmuş";
    $_SESSION["type"] = "error";
    header("Location: event-details.php?id={$eventId}");
    return;
  }

  // Kullanıcı rolü admin mi?
  if ($_SESSION["user"]["role"] == "admin") {
    // error message
    $_SESSION["message"] = "Adminler etkinliklere başvuramaz";
    $_SESSION["type"] = "error";
    header("Location: event-details.php?id={$eventId}");
    return;
  }

  createApplication($_SESSION["user"]["id"], $eventId);
  // success message
  $_SESSION["message"] = "Başvuru başarıyla oluşturuldu";
  $_SESSION["type"] = "success";
  header("Location: event-details.php?id={$eventId}");
  return;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $event["title"]; ?> | EventApp</title>
  <link rel="stylesheet" href="css/general.css" />
  <link rel="stylesheet" href="css/details.css" />
</head>

<body>
  <?php include "views/_message.php" ?>
  <?php include "views/_header.php"; ?>

  <!-- CONTENT -->
  <section class="section-details">
    <div class="container margin-bottom-bg">
      <h2 class="heading-secondary"><?php echo $event["title"]; ?></h2>
      <p class="date-info">Yayım Tarihi:
        <?php echo explode(" ", $event["createdAt"])[0]; ?></p>
    </div>
    <div class="container grid grid--2-cols">
      <div class="event-images">
        <div class="hero-image">
          <img src="img/events/<?php echo $event["images"][0]; ?>"
            class="img-event" />
        </div>
        <div class="other-images">
          <!-- varsa eger -->
          <?php foreach ($event["images"] as $image) : ?>
          <div class="other-image">
            <img src="img/events/<?php echo $image; ?>"
              data-file-name="<?php echo $image; ?>" class="img-thumbnail" />
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="event">
        <div class="event-info">
          <div>
            <p class="info-title">Tarih ve Zaman</p>
            <div class="info-box">
              <img src="img/icons/time.svg" class="info-icon" alt="" />
              <p class="info-text"><?php echo $event["date"]; ?></p>
            </div>
          </div>
          <div>
            <p class="info-title">Etkinlik Konumu</p>
            <div class="info-box">
              <img src="img/icons/location-marker.svg" class="info-icon"
                alt="" />
              <p class="info-text"><?php echo $event["location"]; ?></p>
            </div>
          </div>
          <div>
            <p class="info-title">Etkinlik Türü</p>
            <div class="info-box">
              <?php foreach ($event["tags"] as $tag) : ?>
              <div class="event-tag"><?php echo $tag; ?></div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="event-description">
          <p class="info-title">Etkinlik Açıklaması</p>
          <div class="info-box">
            <p class="description"><?php echo $event["description"]; ?></p>
          </div>
        </div>
        <form method="POST">
          <button type="submit" name="apply" class="btn">Başvur</button>
        </form>
      </div>
    </div>
  </section>

  <?php include "views/_footer.php"; ?>
  <script src="js/event-details.js"></script>
</body>

</html>