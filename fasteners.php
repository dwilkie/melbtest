<?php
  require('helpers/page.php');
  $title = "Fasteners";
  $text = "Ultimate tensile, withdrawal and proof loading of mechanical fasteners is provide as a laboratory or on-site service.";
  $images = array(
    array("Fastner Test 1", "fast_1.gif"),
    array("Fastner Test 2", "fast_2.gif"),
    array("Fastner Test 3", "fast_3.gif"),
    array("Fastner Test 4", "fast_4.gif"),
    array("Fastner Test 5", "fast_5.gif"),
    array("Fastner Test 6", "fast_6.gif")
  );
  echo service_page($title, $text, $images);
?>

