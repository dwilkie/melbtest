<?php
  require('helpers/page.php');
  $title = "Compression";
  $text = "Compression testing is conducted to determine the compressive strength of materials including metals, composites, polymers and rock in accordance with AS/NZS, ASTM or ISO Standards. Crush testing to determine the degree of permanent compression in components is also conducted.";
  $images = array(
    array("Aluminium Beam Test", "al_beam_1.gif"),
    array("Boge Test", "boge.gif"),
    array("Ceramic Tile Test", "ceramic_tile_1.gif"),
    array("Packer Test", "packer_1.gif"),
    array("Packers", "packers_2.gif"),
    array("Rock Core Test", "rock_core_1.gif"),
    array("Rubber Fender Test", "rubber_fenders.gif"),
    array("Screw Jack Test", "screw_jack_1.gif"),
    array("Grout Cube", "grout_cube.jpg"),
    array("Fender Test", "fender_1.gif"),
    array("Leaf Spring", "leaf_spring.jpg"),
    array("Steel and Aluminium Cans", "steel_&_aluminium_cans.jpg")
  );
  echo service_page($title, $text, $images);
?>

