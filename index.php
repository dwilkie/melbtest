<?php
  require("helpers/page.php");

  $title = "Home";

  $content = "<p>";
    $content.= "Melbourne Testing Services is a <a href=\"http://www.nata.asn.au/index.php/scopeinfo/?key=1040\" onclick=\"return openWindow('http://www.nata.asn.au/index.php/scopeinfo/?key=1040')\">NATA accredited</a> laboratory operating in the eastern suburbs of Melbourne. We specialise in a number of <a href=\"services.php\">services</a> including:";
  $content.= "</p>";

  $content.= "<ul>";
    $content.= "<li><a href=\"tensile.php\">Tensile tests</a></li>";
    $content.= "<li><a href=\"compression.php\">Compression tests</a></li>";
    $content.= "<li><a href=\"fasteners.php\">Tests on fasteners</a></li>";
    $content.= "<li><a href=\"timber.php\">Tests on timber</a></li>";
    $content.= "<li><a href=\"concrete.php\">Tests on concrete</a></li>";
    $content.= "<li><a href=\"fatigue.php\">Fatigue testing</a></li>";
    $content.= "<li><a href=\"services.php\">More</a></li>";
  $content.= "</ul>";

  $content.= "<p>";
    $content.= "Take a look at some of our testing projects or arrange for a <a href=\"contact.php\">consultation</a>.";
  $content.= "</p>";

  $content.= "<img id = \"factory_front\" src=\"images/factory_front.gif\" alt=\"Melbourne Testing Services Laboratory - Unit 1/15 Pickering Road Mulgrave, Victoria 3170\" title=\"Melbourne Testing Services Laboratory - Unit 1/15 Pickering Road Mulgrave, Victoria 3170\"/>";

  $content.= "<div id=\"map_canvas\"></div>";

  echo page(
    $title, $content,
    array(
      "script_attrs" => "src=\"http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAlZAs_Zr3JY_w5OXy2wYrlRRn4JZpHzRPAWNXvQDdr2X5UjAifhRjn35QbXeYvUgIMhx1iG6NjiR1eA\" type=\"text/javascript\"",
      "body_attrs" => "onload=\"load_map()\" onunload=\"GUnload()\""
    )
  );
?>

