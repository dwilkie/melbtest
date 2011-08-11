<?php
  require('helpers/page.php');
  $title = "Concrete";
  $text = "Flexural toughness testing of Steel Fibre Reinforced Concrete (SFRC) is conducted as a laboratory service.";
  $images = array(
    array("Concrete Test 1", "concrete_1.gif"),
    array("Concrete Test 2", "concrete_2.gif"),
    array("Concrete Test 3", "concrete_3.gif")
  );
  echo service_page($title, $text, $images);
?>

