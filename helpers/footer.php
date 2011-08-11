<?php
  function footer()
  {
    $html = "<div class=\"footer\">";
      $html.= "<p>";
        $html.= "<a class=\"validate\" href=\"http://validator.w3.org/check?uri=referer\" onclick=\"return openWindow('http://validator.w3.org/check?uri=referer')\">";
          $html.= "<img style=\"border:0;width:88px;height:31px\" src=\"images/valid-xhtml10.png\" alt=\"Valid XHTML 1.0 Strict\" />";
        $html.= "</a>";

        $html.= "<a class=\"validate\" href=\"http://jigsaw.w3.org/css-validator/\" onclick=\"return openWindow('http://jigsaw.w3.org/css-validator/validator?uri=http://www.melbtest.com.au/stylesheets/style.css')\">";
          $html.= "<img style=\"border:0;width:88px;height:31px\" src=\"images/vcss.png\" alt=\"Valid CSS\" />";
        $html.= "</a>";
        $html.= "<br />";
        $html.= "Webmaster: <a href=\"mailto:dwilkie@gmail.com?subject=MTS Website\">David Wilkie</a>";
      $html.= "</p>";
    $html.= "</div>";

    return $html;
  }
?>

