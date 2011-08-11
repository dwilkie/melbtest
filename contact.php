<?php
  require("helpers/page.php");

  $title = "Contact";

  $content = "<p>";
    $content.= "<strong>";
      $content.= "Telephone:";
    $content.= "</strong>";
    $content.= "<br />";
    $content.= "+61 (3) 9560 2759";
  $content.= "</p>";

  $content.= "<p>";
    $content.= "<strong>";
      $content.= "Fax:";
    $content.= "</strong>";
    $content.= "<br />";
    $content.= "+61 (3) 9560 2769";
  $content.= "</p>";

  $content.= "<p>";
    $content.= "<strong>";
      $content.= "Visiting Address:";
    $content.= "</strong>";
    $content.= "<br />";
    $content.= "Unit 1/15 Pickering Rd";
    $content.= "<br />";
    $content.= "Mulgrave";
    $content.= "<br />";
    $content.= "Victoria 3170";
  $content.= "</p>";

  $content.= "<p>";
    $content.= "<strong>";
      $content.= "Postal Address:";
    $content.= "</strong>";
    $content.= "<br />";
    $content.= "PO Box 5111";
    $content.= "<br />";
    $content.= "Brandon Park";
    $content.= "<br />";
    $content.= "Victoria 3150";
  $content.= "</p>";

  $content.= "<p>";
    $content.= "<strong>";
      $content.= "Email:";
    $content.= "</strong>";
    $content.= "<br />";
    $content.= "<a href=\"mailto:info@melbtest.com.au\">";
      $content.= "info@melbtest.com.au";
    $content.= "</a>";
  $content.= "</p>";

  echo page($title, $content);
?>

