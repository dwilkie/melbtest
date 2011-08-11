<?php
  require('helpers/page.php');
  $title = "Tow Bars and Couplings";
  $text = "Static and dynamic tests can be conducted on tow bars and couplings to AS 4177.2, AS 4177.3 and similar standards.";
  $images = array(
    array("Tow Bar Coupling Test", "tow_bar_coupling_test.jpg"),
    array("Trailer Coupling Test", "trailer_coupling_test.jpg"),
    array("Tow Ball Test", "tow_ball.jpg"),
    array("Towbar Assembly Test", "towbar_assembly.jpg")
  );
  echo service_page($title, $text, $images);
?>

