<nav class="sidebar">
  <ul class="account-nav-list">
    <li class="account-nav-link"><a href="settings.php" class="account-nav-link">Hesabım</a></li>

    <!-- If User is Admin: -->
    <?php if ($_SESSION["user"]["role"] == "admin") : ?>
      <li class="divider"></li>
      <li class="account-nav-link"><a href="add-event.php" class="account-nav-link">Etkinlik Ekle</a></li>
      <li class="account-nav-link"><a href="edit-event.php" class="account-nav-link">Etkinliklerim</a></li>
      <li class="account-nav-link"><a href="applications.php" class="account-nav-link">Başvurularım</a></li>
    <?php endif; ?>
  </ul>
</nav>