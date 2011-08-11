<?php require("helpers/page.php"); ?>
<?php page("Flexure"); ?>
    <p>
      Flexural testing is conducted to determine the bending strength, bending stiffness and load capacity of beams, decks and metallic and timber sections.
    </p>
<?php
  $images = array(
    array("Flexure Test", "flexure1.jpg"),
    array("Plastic Post", "plastic_post.jpg"),
    array("Timber Post", "timber_posts.jpg")
  );
  image_gallery($images);
  footer();
?>

