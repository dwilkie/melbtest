<?php
  require('helpers/page.php');
  $title = "Flexure";
  $text = "Flexural testing is conducted to determine the bending strength, bending stiffness and load capacity of beams, decks and metallic and timber sections.";
  $images = array(
    array("Flexure Test", "flexure1.jpg"),
    array("Plastic Post", "plastic_post.jpg"),
    array("Timber Post", "timber_posts.jpg")
  );
  echo service_page($title, $text, $images);
?>

