<?php
  require('helpers/page.php');
  $title = "Rubber Products";
  $text = "Stiffness in compression tests in the range 90kN to 20000kN at ambient temperature. Stiffness in shear tests in the range of 6kN to 1.78MN at ambient temperature.";
  $images = array(
    array("Rubber Mounts", "rubber_mounts.jpg")
  );
  echo service_page($title, $text, $images);
?>

