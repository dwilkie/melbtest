<?php
  require('helpers/page.php');
  $title = "Coating Thickness";
  $text = "Coating thickness tests of ferrous and non-ferrous materials in accordance with AS 2331.1.3-2001 and Coating Mass in accordance with AS 2331.2.1-2001.";
  $images = array(
    array("Coating Thickness Test", "coating_thickness.gif")
  );
  echo service_page($title, $text, $images);
?>

