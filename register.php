<?php
include "libs/vars.php";
include "libs/functions.php";

if (isset($_POST["register"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $password2 = $_POST["password2"];

  if (empty($name) or empty($email) or empty($password) or empty($password2)) {
    $_SESSION["message"] = "Zorunlu alanları doldurunuz";
    $_SESSION["type"] = "error";
    header("Location: register.php");
    return;
  }

  if ($password !== $password2) {
    $_SESSION["message"] = "Girdiğiniz şifreler eşleşmiyor";
    $_SESSION["type"] = "error";
    header("Location: register.php");
    return;
  }

  if (getUser($email)) {
    $_SESSION["message"] = "Bu email ile daha önce kayıt olunmuş";
    $_SESSION["type"] = "error";
    header("Location: register.php");
    return;
  }

  createUser($name, $email, $password);
  $_SESSION["message"] = "Kullanıcı başarıyla oluşturuldu";
  $_SESSION["type"] = "success";
  header("Location: login.php");
  return;
}

?>
<!DOCTYPE html>
<html id="html" lang="tr-TR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kayıt Ol | EventApp</title>
  <link rel="stylesheet" href="css/general.css" />
  <link rel="stylesheet" href="css/login.css" />
</head>

<body>
  <?php include "views/_message.php" ?>
  <?php include "views/_header.php" ?>

  <!-- CONTENT -->
  <section class="section-login">
    <form class="login-box" action="register.php" method="POST">
      <h2 class="heading-secondary">Kayıt ol</h2>

      <div class="controls">
        <div>
          <label class="label" for="name">Ad Soyad</label>
          <input class="control-text" name="name" type="text" id="name" />
        </div>
        <div>
          <label class="label" for="email">Email</label>
          <input class="control-text" name="email" type="text" id="email" />
        </div>
        <div>
          <label class="label" for="password">Şifre</label>
          <input class="control-text" name="password" type="password"
            id="password" />
        </div>
        <div>
          <label class="label" for="password2">Tekrar Şifre</label>
          <input class="control-text" name="password2" type="password"
            id="password2" />
        </div>
      </div>

      <div class="buttons">
        <button type="submit" name="register"
          class="btn-auth btn-auth--register">Kayıt ol</button>
      </div>
    </form>
  </section>

  <?php include "views/_footer.php" ?>
</body>

</html>