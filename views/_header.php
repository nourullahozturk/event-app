    <!-- HEADER -->
    <header class="header">
      <nav class="left-nav">
        <ul class="left-nav-list">
          <a href="index.php" class="nav-link">Tüm Etkinlikler</a>
        </ul>
      </nav>

      <a href="index.php">
        <img src="img/logo.svg" class="logo" alt="" />
      </a>

      <nav class="right-nav">
        <?php if (isset($_SESSION["user"])) : ?>
        <a href="logout.php" class="nav-link">Çıkış</a>
        <div class="profile">
          <a href="settings.php" class="profile-img-box">
            <img src="img/users/<?php echo $_SESSION["user"]["image-url"]; ?>"
              class="img-profile" alt="" />
          </a>
          <a href="settings.php"
            class="nav-link"><?php echo explode(" ", $_SESSION["user"]["name"])[0]; ?></a>
        </div>

        <?php else : ?>

        <ul class="right-nav-list">
          <li>
            <a href="login.php" class="nav-link">Giriş</a>
          </li>
          <li>
            <a href="register.php" class="nav-link">Kayıt ol</a>
          </li>
        </ul>

        <?php endif; ?>
      </nav>

      <nav class="mobile-nav">
        <ul class="mobile-nav-list">
          <li><a href="#" class="nav-link">Tüm Etkinlikler</a></li>
          <?php if (isset($_SESSION["user"])) : ?>
          <li><a href="#" class="nav-link">Hesabım</a></li>
          <?php else : ?>
          <li><a href="#" class="nav-link">Giriş</a></li>
          <li><a href="#" class="nav-link">Kayıt ol</a></li>
          <?php endif; ?>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <img src="img/icons/menu.svg" class="icon-mobile-nav icon-menu"
          alt="" />
        <img src="img/icons/cancel.svg" class="icon-mobile-nav icon-cancel"
          alt="" />
      </button>
    </header>