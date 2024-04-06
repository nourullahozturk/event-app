<?php

function getData()
{
  $myfile = fopen("db.json", "r");
  $size = filesize("db.json");

  $result = json_decode(fread($myfile, $size), true);
  fclose($myfile);
  return $result;
}

function getUser($email)
{
  $users = getData()["users"];

  foreach ($users as $user) {
    if ($user["email"] == $email) {
      return $user;
    }
  }
  return null;
}

function getEvent($id)
{
  $events = getData()["events"];

  foreach ($events as $event) {
    if ($event["id"] == $id) {
      return $event;
    }
  }
  return null;
}

function getApplicationByUserId($userId)
{
  $applications = getData()["applications"];

  $applicationArr = [];

  foreach ($applications as $application) {
    if ($application["applicantId"] == $userId) {
      array_push($applicationArr, $application);
    }
  }
  if (count($applicationArr) > 0) {
    // en az 1 basvuru varsa diziyi dondur
    return $applicationArr;
  } else {
    return null;
  }
}

function getApplicationByEventId($eventId)
{
  $applications = getData()["applications"];

  $applicationArr = [];

  foreach ($applications as $application) {
    if ($application["eventId"] == $eventId) {
      array_push($applicationArr, $application);
    }
  }
  if (count($applicationArr) > 0) {
    // en az 1 basvuru varsa diziyi dondur
    return $applicationArr;
  } else {
    return null;
  }
}

function checkApplication($userId, $eventId)
{
  $applications = getData()["applications"];
  // başvuru varsa ideal durumda 1 adet sonuç döndürür, yani türü array(1)
  $applicationArr = array_filter($applications, function ($application) use ($userId, $eventId) {
    if (($application["applicantId"] == $userId) && ($application["eventId"] == $eventId)) {
      return true;
    }
  });

  if (count($applicationArr) > 0) {
    // en az 1 basvuru varsa dizinin ilk (ve tek) elemanini dondur
    return true;
  } else {
    return false;
  }
}


function createUser($name, $email, $password)
{
  $db = getData();

  $id = md5(time() . $email);

  $newUser = [
    "id" => $id,
    "name" => $name,
    "email" => $email,
    "password" => $password,
    "image-url" => "default.jpg",
    "role" => "user"
  ];

  array_push($db["users"], $newUser);

  $myfile = fopen("db.json", "w");

  fwrite($myfile, json_encode($db));

  fclose($myfile);
}

function createEvent(array $images, string  $title, string  $date, array $tags, string  $location, string  $description = "")
{
  $db = getData();

  $id = md5(time() . $title);

  $newEvent = [
    "id" => $id,
    "images" => $images,
    "title" => $title,
    "date" => $date,
    "tags" => $tags,
    "location" => $location,
    "description" => $description,
    "is-active" => true,
    "createdAt" => date("d.m.y H:i")
  ];

  array_push($db["events"], $newEvent);

  $myfile = fopen("db.json", "w");

  fwrite($myfile, json_encode($db));

  fclose($myfile);
}

function createApplication($userId, $eventId)
{
  $db = getData();

  $id = md5(time() . $eventId . $userId);

  $newApplication = [
    "id" => $id,
    "applicantId" => $userId,
    "eventId" => $eventId,
    "createdAt" => date("d.m.y H:i")
  ];

  array_push($db["applications"], $newApplication);

  $myfile = fopen("db.json", "w");

  fwrite($myfile, json_encode($db));

  fclose($myfile);
}

function updateEvent($updatedEvent)
{
  $db = getData();

  foreach ($db["events"] as &$event) {
    if ($event["id"] == $updatedEvent["id"]) {
      $event["title"] = $updatedEvent["title"];
      $event["images"] = $updatedEvent["images"];
      $event["date"] = $updatedEvent["date"];
      $event["tags"] = $updatedEvent["tags"];
      $event["location"] = $updatedEvent["location"];
      $event["description"] = $updatedEvent["description"];
      $event["is-active"] = $updatedEvent["is-active"];
      break;
    }
  }

  $myfile = fopen("db.json", "w");
  $result = json_encode($db);
  fwrite($myfile, $result);
  fclose($myfile);
}

function updateUser($updatedUser)
{
  $db = getData();

  foreach ($db["users"] as &$user) {
    if ($user["id"] == $updatedUser["id"]) {
      $user["name"] = $updatedUser["name"];
      $user["email"] = $updatedUser["email"];
      $user["image-url"] = $updatedUser["image-url"];
      $user["password"] = $updatedUser["password"];
      break;
    }
  }

  $myfile = fopen("db.json", "w");
  $result = json_encode($db);
  fwrite($myfile, $result);
  fclose($myfile);
}

function deleteEvent($id)
{
  $db = getData();

  foreach ($db["events"] as $key => $event) {
    if ($event["id"] == $id) {
      unset($db["events"][$key]);
    }
  }

  $myfile = fopen("db.json", "w");

  fwrite($myfile, json_encode($db));

  fclose($myfile);
}
