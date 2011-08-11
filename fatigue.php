<?php
  require('helpers/page.php');
  $title = "Fatigue";
  $text = "Fatigue testings is carried out in accordance with Australian and International Standards.";
  $images = array(
    array("Instron Testing Machine", "instron_machine.jpg"),
    array("Instron Test", "instron_test_1.jpg"),
    array("Fatigue Test", "fatigue1.jpg")
  );
  echo service_page($title, $text, $images);
?>

