<?php require("helpers/page.php"); ?>
<?php page("Ladders"); ?>
<?php
  $images = array(
    array("Ladder Test 1", "picture_002.jpg"),
    array("Ladder Test 2", "picture_010.jpg"),
    array("Ladder Test 3", "picture_015.jpg"),
    array("Ladder Test 4", "picture_036.jpg")
  );
  image_gallery($images);
  footer();
?>

