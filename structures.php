<?php
  require('helpers/page.php');
  $title = "Structures";
  $text = "Large structures including formwork, composite slabs, steel decking, roadside safety barrier railing and posts can be tested in our 500kN servo-hydraulic testing frame for structural integrity and ultimate load capacity.";
  $images = array(
    array("Structural Test 1", "struct_1.gif"),
    array("Structural Test 2", "struct_2.gif"),
    array("Structural Test 3", "struct_4.gif"),
    array("Structural Test 4", "struct_5.gif"),
    array("Structural Test 5", "struct_6.gif"),
    array("Structural Test 6", "struct_7.gif"),
    array("Structural Test 7", "struct_8.gif"),
    array("Structural Test 8", "struct_9.gif"),
    array("Structural Test 9", "struct_10.gif"),
    array("Structural Test 10", "struct_11.gif"),
    array("Structural Test 11", "struct_12.gif"),
  );
  echo service_page($title, $text, $images);
?>

