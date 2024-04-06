<?php
include "libs/vars.php";
include "libs/functions.php";

$events = getData()["events"];

// SIRALA
foreach ($events as &$event) {
  // Etkinliklerin createdAt değerini string bir date'ten timestampe'e çevir
  $dateTimeStr = $event["createdAt"];
  $dateStr = explode(" ", $event["createdAt"])[0];
  $timeStr = explode(" ", $event["createdAt"])[1];
  list($day, $month, $year) = explode(".", $dateStr);
  list($hour, $minutes) = explode(":", $timeStr);
  $timestamp = mktime((int)$hour, (int)$minutes, 0, (int)$month, (int)$day, (int)$year);
  $event["createdAt"] = $timestamp;
}
// Etkinlikleri en yeni eklenenden en eskiye sirala:
$dateCol = array_column($events, 'createdAt');
array_multisort($dateCol, SORT_DESC, $events);


// FILTRELE
if (isset($_GET["btnFilter"]) or isset($_GET["btnMobileFilter"])) {

  $tag = $_GET["tag"];

  if (!empty($_GET["is-active"])) {
    $isActive = $_GET["is-active"] == "false" ? false : true;
  }


  if (!empty($tag)) {
    $events = array_filter($events, function ($event) use ($tag) {
      return in_array($tag, $event["tags"]);
    });
  }

  if (isset($isActive) && !is_null($isActive)) {
    $events = array_filter($events, function ($event) use ($isActive) {
      return $event["is-active"] == $isActive;
    });
  }
}

// ARAMA
if (isset($_GET["btnSearch"])) {
  if (!empty($_GET["q"])) {
    $keyword = $_GET["q"];

    $events = array_filter($events, function ($event) use ($keyword) {
      return stristr($event["title"], $keyword) or stristr($event["description"], $keyword);
    });
  }
}

?>


<!DOCTYPE html>
<html id="html" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tüm Etkinlikler | EventApp</title>
  <link rel="stylesheet" href="css/general.css" />
  <link rel="stylesheet" href="css/overview.css" />
</head>

<body>
  <?php include "views/_message.php" ?>
  <?php include "views/_header.php" ?>

  <!-- CONTENT -->
  <section class="section-main">
    <?php include "views/_controls-bar.php" ?>
    <?php include "views/_events-list.php" ?>
  </section>

  <?php include "views/_footer.php" ?>
  <script src="js/index.js"></script>
</body>

</html>