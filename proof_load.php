<?php require("helpers/page.php"); ?>
<?php page("Proof Load"); ?>
    <p>
      Proof load testing is carried-out on a large range of structures and devices such as tea pot ladles, specialised lifting equipment and support frames. Tests are conducted in accordance with AS4991-2004 to confirm that devices can safely support their specified working load limit (WLL).
    </p>
<?php
  $images = array(
    array("Proof Load Test 1", "proof_1.gif"),
    array("Proof Load Test 2", "proof_2.gif"),
    array("Proof Load Test 3", "proof_3.gif"),
    array("Proof Load Test 4", "proof_4.gif"),
    array("Proof Load Test 5", "proof_5.gif"),
    array("Proof Load Test 6", "proof_6.gif"),
    array("Proof Load Test 7", "proof_7.gif"),
    array("Proof Load Test 8", "proof_8.gif")
  );
  image_gallery($images);
  footer();
?>

