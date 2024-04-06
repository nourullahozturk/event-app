<?php
include "libs/vars.php";
include "libs/functions.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] != "admin") {
  header("Location: login.php");
  return;
}

$db = getData();
$events = $db["events"];
$applications = $db["applications"];
$users = $db["users"];

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
  <!-- <div><?php
            if ($uploadedImg) {
              print_r($uploadedImg);
            }
            ?></div> -->
  <?php include "views/_message.php" ?>
  <?php include "views/_header.php"; ?>

  <!-- CONTENT -->
  <section class="section-account">
    <div class="container">
      <div class="container-inner">
        <?php include "views/_sidebar.php"; ?>

        <div class="main">
          <!-- APPLICATIONS SECTION -->
          <div class="applications-section">
            <h2 class="heading-secondary">Başvurularım</h2>

            <!-- <div class="settings-box">
              <h3 class="heading-tertiary">Etkinlik Seç</h3>
              <form method="POST">
                <select class="dropdown" name="selectEvent">
                  <option value="all">Tümü</option>
                  <?php foreach ($events as $key => $event) : ?>
                  <option value="<?php echo $key; ?>">
                    <?php echo $event["title"]; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
                <button class="btn-dropdown" type="submit"
                  name="btnGetEvents">Bilgileri Getir</button>
              </form>
            </div> -->

            <div class="applications-box">
              <h3 class="heading-tertiary">Başvurular</h3>

              <div class="table">
                <div class="thead">
                  <div class="th">Ad Soyad</div>
                  <div class="th">Email</div>
                  <div class="th">Etkinlik</div>
                  <div class="th">Başvuru Tarihi</div>
                </div>

                <div class="tbody">
                  <?php foreach ($applications as $application) : ?>
                  <?php
                    $userId = $application["applicantId"];
                    $eventId = $application["eventId"];
                    foreach ($users as $key => $user) {
                      if ($user["id"] == $userId) {
                        $name = $users[$key]["name"];
                        $email = $users[$key]["email"];
                      }
                    }
                    foreach ($events as $key => $event) {
                      if ($event["id"] == $eventId) {
                        $title = $events[$key]["title"];
                      }
                    }
                    ?>
                  <p class="td"><?php echo $name; ?></p>
                  <p class="td"><?php echo $email; ?></p>
                  <p class="td"><?php echo $title; ?></p>
                  <p class="td"><?php echo $application["createdAt"]; ?></p>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div>
              <button class="btn btn--settings">Dışarı Aktar (CSV)</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <?php include "views/_footer.php"; ?>
  <script src="js/applications.js"></script>
</body>

</html>