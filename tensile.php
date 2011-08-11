<?php require("helpers/page.php"); ?>
<?php page("Tensile"); ?>
    <p>
      Tensile testing is performed to determine the tensile strength, proof stress and ductility properties of materials. Testing may be carried-out on metals, composites, polymers and timber product in accordance with AS/NZS, ASTM or ISO Standards.
    </p>
<?php
  $images = array(
    array("Tensile Test 1", "compact_tens_1.gif"),
    array("Tensile Test 2", "tens_1.gif"),
    array("Tensile Test 3", "tens_2.gif"),
    array("Tensile Test 4", "tens_3.gif"),
    array("Tensile Test 5", "tens_4.gif"),
    array("Tensile Test 6", "tens_5.gif"),
    array("Tensile Test 7", "tens_6.gif"),
    array("Tensile Test 8", "tens_7.gif"),
    array("Aluminium Strap", "tensile_test_aluminium_strap.jpg"),
    array("Shackle", "tensile_test_shackle.jpg"),
    array("Threaded Rod", "tensile_test_threaded_rod.jpg")
  );
  image_gallery($images);
  footer();
?>

