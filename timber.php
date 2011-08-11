<?php
  require('helpers/page.php');
  $title = "Timber";
  $text = "Testing can be conducted to determine the bending strength and modulus of elasticity of I-beams and other timber products. Three and four point bending tests can be conducted for both bending and shear properties.";
  $images = array(
    array("Timber Test 1", "timber_1.gif"),
    array("Timber Test 2", "timber_2.gif"),
    array("Timber Test 3", "timber_3.gif"),
    array("Timber Test 4", "timber_4.gif"),
    array("Timber Test 5", "timber_5.gif"),
    array("Timber Test 6", "timber_6.gif")
  );
  echo service_page($title, $text, $images);
?>

