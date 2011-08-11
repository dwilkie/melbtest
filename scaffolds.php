<?php
  require('helpers/page.php');
  $title = "Scaffolds";
  $text = "Testing of scaffold systems, roof anchor devices or scaffold components to the applicable Australian Standards is provided.";
  $images = array(
    array("Scaffold Test 1", "scaffold_1.gif"),
    array("Scaffold Test 2", "scaffold_2.gif"),
    array("Scaffold Test 3", "scaffold_3.gif"),
    array("Scaffold Test 4", "scaffold_4.gif"),
    array("Scaffold Test 5", "scaffold_5.gif"),
    array("Scaffold Test 6", "scaffold_6.gif"),
    array("Top Guard Rail Static Inward Test", "top_guardrail_static_inward_test.jpg"),
    array("Top Guard Rail Static Outward Test", "top_guardrail_static_outward_test.jpg"),
    array("Adjustable Screw Jack", "adjustable_screw_jack.jpg"),
    array("Mobile Scaffold Tower", "mobile_scaffold_tower.jpg"),
    array("Scaffold Caster", "scaffold_castor.jpg"),
    array("Scaffold Stair", "scaffold_stair.jpg")
  );
  echo service_page($title, $text, $images);
?>

