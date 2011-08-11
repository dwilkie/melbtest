<?php require("helpers/page.php"); ?>
<?php page("Rubber Products"); ?>
    <p>
      Stiffness in compression tests in the range 90kN to 20000kN at ambient temperature. Stiffness in shear tests in the range of 6kN to 1.78MN at ambient temperature.
    </p>
<?php
  $images = array(
    array("Rubber Mounts", "rubber_mounts.jpg")
  );
  image_gallery($images);
  footer();
?>

