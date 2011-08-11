<?php require("helpers/page.php"); ?>
<?php page("Concrete"); ?>
    <p>
      Flexural toughness testing of Steel Fibre Reinforced Concrete (SFRC) is conducted as a laboratory service.
    </p>
<?php
  $images = array(
    array("Concrete Test 1", "concrete_1.gif"),
    array("Concrete Test 2", "concrete_2.gif"),
    array("Concrete Test 3", "concrete_3.gif")
  );
  image_gallery($images);
  footer();
?>

