<!-- Controls Bar -->
<div class="controls-container">
  <!-- SORT -->
  <div class="sort">
    <div class="label">Şuna göre sırala:</div>
    <div class="control-box">
      <select id="sort">
        <option value="1">En yeniden en eskiye</option>
        <option value="2">En eskiden en yeniye</option>
      </select>
    </div>
  </div>

  <!-- FILTERS -->
  <form class="form-filter" action="index.php" method="GET">
    <div class="label">Filtreleme kriteri:</div>

    <div class="filter">
      <div class="control-box">
        <select name="tag" id="filter1">
          <option value="">Kategoriler</option>
          <option value="Ücretsiz"
            <?php if (isset($tag) && $tag == "Ücretsiz") echo "selected"; ?>>
            Ücretsiz</option>
          <option value="Stand Up"
            <?php if (isset($tag) && $tag == "Stand Up") echo "selected"; ?>>
            Stand Up</option>
          <option value="Söyleşi"
            <?php if (isset($tag) && $tag == "Söyleşi") echo "selected"; ?>>
            Söyleşi</option>
          <option value="Konser"
            <?php if (isset($tag) && $tag == "Konser") echo "selected"; ?>>
            Konser</option>
          <option value="Film Gösterimi"
            <?php if (isset($tag) && $tag == "Film Gösterimi") echo "selected"; ?>>
            Film
            Gösterimi</option>
          <option value="Deneyim"
            <?php if (isset($tag) && $tag == "Deneyim") echo "selected"; ?>>
            Deneyim</option>
          <option value="Satışta"
            <?php if (isset($tag) && $tag == "Satışta") echo "selected"; ?>>
            Satışta</option>
        </select>
      </div>
      <div class="control-box">
        <select name="is-active" id="filter2">
          <option value="">Aktiflik durumu</option>
          <option value="true"
            <?php if (isset($isActive) && $isActive == true) echo "selected"; ?>>
            Aktif
          </option>
          <option value="false"
            <?php if (isset($isActive) && $isActive == false) echo "selected"; ?>>
            Sonlanmış
          </option>
        </select>
      </div>
      <button class="btn-filter" type="submit" name="btnFilter"
        value="1">Filtrele</button>
    </div>
    <button class="btn-mobile-filter">Filtrele</button>
  </form>

  <!-- Filter Modal -->
  <div class="modal hidden">
    <form class="filter-modal">
      <p class="modal-title">Filtreler</p>
      <img src="img/icons/cancel.svg" class="modal-icon" alt="" />
      <div class="control-box margin-bottom-xsm">
        <select name="tag" id="mobileFilter1">
          <option value="">Kategoriler</option>
          <option value="Ücretsiz">Ücretsiz</option>
          <option value="Stand Up">Stand Up</option>
          <option value="Söyleşi">Söyleşi</option>
          <option value="Konser">Konser</option>
          <option value="Film Gösterimi">Film Gösterimi</option>
          <option value="Deneyim">Deneyim</option>
          <option value="Satışta">Satışta</option>
        </select>
      </div>
      <div class="control-box margin-bottom-md">
        <select name="is-active" id="mobileFilter2">
          <option value="">Aktiflik durumu</option>
          <option value="true">Aktif</option>
          <option value="false">Sonlanmış</option>
        </select>
      </div>
      <div class="align-right-h">
        <button class="btn-modal" type="submit" name="btnMobileFilter"
          value="1">Uygula</button>
      </div>
    </form>
    <div class="overlay"></div>
  </div>

  <!-- SEARCH -->
  <form class="form-search" role="search" method="GET">
    <input type="search" id="query" name="q" placeholder="Etkinlik Ara..."
      aria-label="Etkinlikler içinde bir arama yapın." />
    <button class="btn-search" type="submit" name="btnSearch" value="1">
      <img src="img/icons/search-white.svg" class="search-icon" alt="" />
    </button>
  </form>
</div>