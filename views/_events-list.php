<!-- Events -->
<div class="container grid grid--4-cols">
  <?php if (count($events) == 0) : ?>
  <div class="empty-event-list">Aramanıza uygun bir sonuç bulunamadı.</div>
  <?php else : ?>
  <?php foreach ($events as $event) : ?>

  <div class="card">
    <a class="link" href="event-details.php?id=<?php echo $event["id"]; ?>">
      <img src="img/events/<?php echo $event["images"][0] ?>" class="img-card"
        alt="" />
    </a>
    <div class="card-content">
      <p class="card-title">
        <a class="link"
          href="event-details.php?id=<?php echo $event["id"]; ?>"><?php echo $event["title"]; ?></a>
      </p>
      <p class="hidden" id="createdAt"><?php echo $event["createdAt"]; ?></p>
      <div class="info-box">
        <img src="img/icons/time.svg" class="card-icon" alt="" />
        <p class="card-text"><?php echo $event["date"]; ?></p>
      </div>
      <div class="info-box">
        <img src="img/icons/location-marker.svg" class="card-icon" alt="" />
        <p class="card-text"><?php echo $event["location"]; ?></p>
      </div>
      <div class="info-box">
        <?php foreach ($event["tags"] as $tag) : ?>
        <div class="event-tag"><?php echo $tag; ?></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <?php endforeach; ?>
  <?php endif; ?>
</div>