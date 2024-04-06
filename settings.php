<?php
include "libs/vars.php";
include "libs/functions.php";

// User login olmamış mı?
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // PROFIL RESMI ve İSİM GUNCELLEME
  if (isset($_POST["btnForm1"])) {
    // İsim girilmiş mi?
    if (empty($_POST["name"])) {
      $_SESSION["message"] = "İsim alanı boş bırakılamaz";
      $_SESSION["type"] = "error";
      header("Location: settings.php");
      return;
    }

    // Dosya seçilmiş mi
    if (!empty($_FILES["profile-img"]["name"])) {
      $fileName = $_FILES["profile-img"]["name"];
      $fileTmpPath = $_FILES["profile-img"]["tmp_name"];
      $uploadFolder = "./img/users/";
      $dest_path = $uploadFolder . $fileName;

      // Dosyayı klasöre kaydet
      if (move_uploaded_file($fileTmpPath, $dest_path)) {
        // echo "dosya yüklendi";
        $_SESSION["user"]["image-url"] = $fileName;
      } else {
        $_SESSION["message"] = "Dosya yüklenemedi";
        $_SESSION["type"] = "error";
        header("Location: settings.php");
        return;
      }
    }

    $_SESSION["user"]["name"] = $_POST["name"];
    updateUser($_SESSION["user"]);
    $_SESSION["message"] = "Profil bilgileri başarıyla güncellendi";
    $_SESSION["type"] = "success";
  }

  // EMAIL GUNCELLEME
  if (isset($_POST["btnForm2"])) {
    // Alanlar boş mu?
    if (empty($_POST["email"]) or empty($_POST["password"])) {
      $_SESSION["message"] = "Zorunlu alanları doldurunuz";
      $_SESSION["type"] = "error";
      header("Location: settings.php");
      return;
    }
    // Şifre yanlış mı?
    if ($_POST["password"] != $_SESSION["user"]["password"]) {
      $_SESSION["message"] = "Girdiğiniz şifre hatalı";
      $_SESSION["type"] = "error";
      header("Location: settings.php");
      return;
    }
    // Kullanıcı emailini güncelle
    $_SESSION["user"]["email"] = $_POST["email"];
    updateUser($_SESSION["user"]);
    $_SESSION["message"] = "Email başarıyla güncellendi";
    $_SESSION["type"] = "success";
  }

  // SIFRE GUNCELLEME
  if (isset($_POST["btnForm3"])) {
    // Alanlar boş mu?
    if (empty($_POST["oldpassword"]) or empty($_POST["newpassword"]) or empty($_POST["newpassword2"])) {
      $_SESSION["message"] = "Zorunlu alanları doldurunuz";
      $_SESSION["type"] = "error";
      header("Location: settings.php");
      return;
    }
    // Şifreler eşleşiyor mu?
    if ($_POST["newpassword"] != $_POST["newpassword2"]) {
      $_SESSION["message"] = "Girdiğiniz şifreler eşleşmiyor";
      $_SESSION["type"] = "error";
      header("Location: settings.php");
      return;
    }
    // Kullanıcı şifresini güncelle
    $_SESSION["user"]["password"] = $_POST["newpassword"];
    updateUser($_SESSION["user"]);
    $_SESSION["message"] = "Şifre başarıyla güncellendi";
    $_SESSION["type"] = "success";
  }
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
          <!-- MY ACCOUNT SECTION -->
          <div class="account-section">
            <h2 class="heading-secondary">Hesabım</h2>

            <div class="settings-box">
              <h3 class="heading-tertiary">Profil Bilgileri</h3>
              <form class="form-settings" method="POST" enctype="multipart/form-data">
                <div class="controls">
                  <div>
                    <label class="label" for="name">Ad Soyad</label>
                    <input class="control-text" type="text" name="name" value="<?php echo $_SESSION["user"]["name"] ?>" id="name" />
                  </div>

                  <div>
                    <p class="label">Profil Resmi</p>
                    <div class="control-tag-box">
                      <div>
                        <label for="profileImg" class="control-file">
                          Dosya seç...
                        </label>
                        <input class="hidden" id="profileImg" type="file" name="profile-img" />
                      </div>

                      <div class="tag-box" id="profileTagBox">
                        <!-- script ile dinamik olarak eklenecek: -->
                        <!-- <div class="tag">
                          <span>default.jpg</span>
                          <img src="img/users/cancel.svg" class="tag-icon" alt="" />
                        </div> -->
                      </div>
                    </div>
                  </div>
                </div>

                <button type="submit" name="btnForm1" class="btn btn--settings">Kaydet</button>
              </form>
            </div>

            <div class="divider"></div>

            <div class="settings-box">
              <h3 class="heading-tertiary">Email Güncelle</h3>
              <form class="form-settings" method="POST">
                <div class="controls">
                  <div>
                    <label class="label" for="email">Email</label>
                    <input class="control-text" type="text" name="email" id="email" value="<?php echo $_SESSION["user"]["email"]; ?>" />
                  </div>

                  <div>
                    <label class="label" for="password">Şifre</label>
                    <input class="control-text" type="password" name="password" id="password" />
                  </div>
                </div>
                <button class="btn btn--settings" type="submit" name="btnForm2">Kaydet</button>
              </form>
            </div>

            <div class="divider"></div>

            <div class="settings-box">
              <h3 class="heading-tertiary">Şifre Güncelle</h3>
              <form class="form-settings" method="POST">
                <div class="controls">
                  <div>
                    <label class="label" for="oldpassword">Eski Şifre</label>
                    <input class="control-text" type="password" name="oldpassword" id="oldpassword" />
                  </div>

                  <div>
                    <label class="label" for="newpassword">Yeni Şifre</label>
                    <input class="control-text" type="password" name="newpassword" id="newpassword" />
                  </div>

                  <div>
                    <label class="label" for="newpassword2">Tekrar Yeni
                      Şifre</label>
                    <input class="control-text" type="password" name="newpassword2" id="newpassword2" />
                  </div>
                </div>
                <button class="btn btn--settings" type="submit" name="btnForm3">Kaydet</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <?php include "views/_footer.php"; ?>
  <script src="js/settings.js"></script>
</body>

</html>