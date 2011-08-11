<?php require("helpers/page.php"); ?>
<?php page("Formwork"); ?>
    <p>
      Load testing of telescopic, adjustable formwork props used to support concrete formwork is conducted as a laboratory service. Tests are conducted to determine the Working Load Limit (WLL) of props in accordance with AS 3610-1995.
    </p>
<?php
  $images = array(
    array("Formwork Test 1", "form_1.gif"),
    array("Formwork Test 2", "form_2.gif"),
    array("Formwork Test 2 Bending", "form_3.gif"),
    array("Formwork Test 2 Specimens", "form_4.gif"),
    array("Adjustable Caster", "adjustable_castor.jpg"),
    array("Couplers", "couplers.jpg")
  );
  image_gallery($images);
  footer();
?>

