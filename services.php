<?php
  require("helpers/page.php");

  $title = "Services";

  $content = "<p>";
    $content.= "We offer a wide range of testing solutions. Select a service below or <a href=\"contact.php\">contact us</a> for more information.";
  $content.= "</p>";

  $content.= "<ul>";
     $content.= "<li><a href=\"bearings.php\">Bearings</a></li>";
     $content.= "<li><a href=\"coating_thickness.php\">Coating Thickness</a></li>";
     $content.= "<li><a href=\"compression.php\">Compression</a></li>";
     $content.= "<li><a href=\"concrete.php\">Concrete</a></li>";
     $content.= "<li><a href=\"covers_and_grates.php\">Covers &amp; Grates</a></li>";
     $content.= "<li><a href=\"fasteners.php\">Fasteners</a></li>";
     $content.= "<li><a href=\"fatigue.php\">Fatigue</a></li>";
     $content.= "<li><a href=\"flexure.php\">Flexure</a></li>";
     $content.= "<li><a href=\"formwork.php\">Formwork</a></li>";
     $content.= "<li><a href=\"ladders.php\">Ladders</a></li>";
     $content.= "<li><a href=\"proof_load.php\">Proof Load</a></li>";
     $content.= "<li><a href=\"rubber.php\">Rubber Products</a></li>";
     $content.= "<li><a href=\"scaffolds.php\">Scaffolds</a></li>";
     $content.= " <li><a href=\"steel_reinforcing.php\">Steel Reinforcing</a></li>";
     $content.= "<li><a href=\"structures.php\">Structures</a></li>";
     $content.= "<li><a href=\"tensile.php\">Tensile</a></li>";
     $content.= "<li><a href=\"timber.php\">Timber</a></li>";
     $content.= "<li><a href=\"tow_bars_and_couplings.php\">Tow Bars &amp; Couplings</a></li>";
     $content.= "<li><a href=\"vehicle_jacks_and_stands.php\">Vehicle Jacks &amp; Stands</a></li>";
     $content.= "<li><a href=\"other.php\">Other</a></li>";
  $content.= "</ul>";

  echo page($title, $content);
?>

