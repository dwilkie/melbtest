<?php require("helpers/page.php"); ?>
<?php page("Tow Bars and Couplings"); ?>
    <p>
      Static and dynamic tests can be conducted on tow bars and couplings to AS 4177.2, AS 4177.3 and similar standards.
    </p>
<?php
  $images = array(
    array("Tow Bar Coupling Test", "tow_bar_coupling_test.jpg"),
    array("Trailer Coupling Test", "trailer_coupling_test.jpg"),
    array("Tow Ball Test", "tow_ball.jpg"),
    array("Towbar Assembly Test", "towbar_assembly.jpg")
  );
  image_gallery($images);
  footer();
?>

