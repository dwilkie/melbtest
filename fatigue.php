<?php require("helpers/page.php"); ?>
<?php page("Fatigue"); ?>
    <p>
      Fatigue testings is carried out in accordance with Australian and International Standards.
    </p>
<?php
  $images = array(
    array("Instron Testing Machine", "instron_machine.jpg"),
    array("Instron Test", "instron_test_1.jpg"),
    array("Fatigue Test", "fatigue1.jpg")
  );
  image_gallery($images);
  footer();
?>

