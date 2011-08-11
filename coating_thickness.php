<?php require("helpers/page.php"); ?>
<?php page("Coating Thickness"); ?>
    <p>
      Coating thickness tests of ferrous and non-ferrous materials in accordance with AS 2331.1.3-2001 and Coating Mass in accordance with AS 2331.2.1-2001.
    </p>
<?php
  $images = array(
    array("Coating Thickness Test", "coating_thickness.gif")
  );
  image_gallery($images);
  footer();
?>

