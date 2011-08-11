<?php
  function navex()
  {
    $html = "<div class=\"navex\">";
      $html.= "<ul>";
        $html.= "<li><a href=\"index.php\">Home</a></li>";
        $html.= "<li><a href=\"about.php\">About Us</a></li>";
        $html.= "<li><a href=\"services.php\">Services</a></li>";
        $html.= "<li><a href=\"contact.php\">Contact</a></li>";
        $html.= "<li><a href=\"feedback.php\">Feedback</a></li>";
      $html.= "</ul>";
    $html.= "</div>";

    return $html;
  }
?>

