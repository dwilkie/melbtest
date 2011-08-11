<?php require("helpers/page.php"); ?>
<?php page("Bearings"); ?>
    <p>
      Proof load testing of structural bearings in both compression and shear and for the determination of coefficient of friction. Tests may be conducted with combined vertical and horizontal load including rotation and in accordance with AS 5100.4, AS 1523-1981 Appendix A, AusRoads Bridge Design Code 1992, RTA B280 and similar methods.
    </p>
<?php
  $images = array(
    array("Bearing Test", "bearing_1.gif"),
    array("Plate Bearing Test", "bearing_2.gif")
  );
  image_gallery($images);
  footer();
?>

