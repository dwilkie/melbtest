<?php
  function logos()
  {
    $html = "<div class=\"logos\">";
      $html.= "<a href=\"index.php\">";
        $html.= "<img class=\"mts_logo\" src=\"images/mts_logo.png\" title=\"Melbourne Testing Services\" alt=\"Melbourne Testing Services\" />";
      $html.= "</a>";
      $html.= "<a href=\"http://www.nata.asn.au/index.php/scopeinfo/?key=1040\" onclick=\"return openWindow('http://www.nata.asn.au/index.php/scopeinfo/?key=1040')\">";
        $html.= "<img class=\"nata_logo\" src=\"images/nata_logo.png\" title=\"NATA\" alt=\"NATA\" />";
      $html.= "</a>";
    $html.= "</div>";

    return $html;
  }
?>

