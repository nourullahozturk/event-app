<?php
include "libs/vars.php";
include "libs/functions.php";

if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $user = getUser($email);

  if (empty($email) or empty($password)) {
    $_SESSION["message"] = "Zorunlu alanları doldurunuz";
    $_SESSION["type"] = "error";
    header("Location: login.php");
    return;
  }

  if (!is_null($user) and $email == $user["email"] and $password == $user["password"]) {
    $_SESSION["user"] = $user;
    header("Location: index.php");
    return;
  } else {
    $_SESSION["message"] = "Girdiğiniz kullanıcı adı veya şifre hatalı";
    $_SESSION["type"] = "error";
    header("Location: login.php");
    return;
  }
}

?>

<!DOCTYPE html>
<html id="html" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Giriş | EventApp</title>
  <link rel="stylesheet" href="css/general.css" />
  <link rel="stylesheet" href="css/login.css" />
</head>

<body>
  <?php include "views/_message.php" ?>
  <?php include "views/_header.php" ?>

  <!-- CONTENT -->
  <section class="section-login">
    <form class="login-box" action="login.php" method="POST">
      <h2 class="heading-secondary">Giriş Yap</h2>

      <div class="controls">
        <div>
          <label class="label" for="email">Email</label>
          <input class="control-text" name="email" type="text" id="email" />
        </div>
        <div>
          <label class="label" for="password">Şifre</label>
          <input class="control-text" name="password" type="password"
            id="password" />
        </div>
      </div>

      <div class="buttons">
        <button class="btn-auth btn-auth--login" type="submit"
          name="login">Giriş
          yap</button>
        <a href="register.php" class="btn-auth btn-auth--register">Kayıt ol</a>
      </div>
    </form>
  </section>

  <?php include "views/_footer.php" ?>
</body>

</html>