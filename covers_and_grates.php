<?php
  require('helpers/page.php');
  $title = "Covers and Grates";
  $text = "Load testing on access covers and grates can be conducted in our 500kN servo-hydraulic testing frame for structural integrity and ultimate load capacity to AS 3996 and similar standards.";
  $images = array(
    array("Tree Grate Test", "1.2m_x_1.2m_tree_grate_test.jpg"),
    array("Class E Cover Test", "1m_x_1m_class_e_cover_test.jpg"),
    array("Polyconcrete Cover Testing", "polyconcrete_cover_testing.jpg")
  );
  echo service_page($title, $text, $images);
?>

