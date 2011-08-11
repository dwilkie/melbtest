<?php
  require("helpers/page.php");

  $title = "Contact";

  $text = "<p>";
    $text.= "<strong>";
      $text.= "Telephone:";
    $text.= "</strong>";
    $text.= "<br />";
    $text.= "+61 (3) 9560 2759";
  $text.= "</p>";

  $text.= "<p>";
    $text.= "<strong>";
      $text.= "Fax:";
    $text.= "</strong>";
    $text.= "<br />";
    $text.= "+61 (3) 9560 2769";
  $text.= "</p>";

  $text.= "<p>";
    $text.= "<strong>";
      $text.= "Visiting Address:";
    $text.= "</strong>";
    $text.= "<br />";
    $text.= "Unit 1/15 Pickering Rd";
    $text.= "<br />";
    $text.= "Mulgrave";
    $text.= "<br />";
    $text.= "Victoria 3170";
  $text.= "</p>";

  $text.= "<p>";
    $text.= "<strong>";
      $text.= "Postal Address:";
    $text.= "</strong>";
    $text.= "<br />";
    $text.= "PO Box 5111";
    $text.= "<br />";
    $text.= "Brandon Park";
    $text.= "<br />";
    $text.= "Victoria 3150";
  $text.= "</p>";

  $text.= "<p>";
    $text.= "<strong>";
      $text.= "Email:";
    $text.= "</strong>";
    $text.= "<br />";
    $text.= "<a href=\"mailto:info@melbtest.com.au\">";
      $text.= "info@melbtest.com.au";
    $text.= "</a>";
  $text.= "</p>";

  echo page($title, $text);
?>

