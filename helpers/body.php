<?php
  function body($title, $text = NULL, $images = NULL, $options = array())
  {
    require("helpers/logos.php");
    require("helpers/navex.php");
    require("helpers/footer.php");
    require("helpers/image.php");

    $html = "<body";
    $body_attrs = $options["body_attrs"];
    if (isset($body_attrs))
      $html.= " $body_attrs>";
    else
      $html.= ">";

      $html.= logos();
      $html.= navex();
      $html.= "<div class =\"content\">";
        $html.= "<h1>$title</h1>";
        if (isset($text))
          $html.= $text;
        if (isset($images))
          $html.= service_images($images);
      $html.= "</div>";
      $html.= footer();
    $html.= "</body>";

    return $html;
  }

  function service_page_body($title, $text = NULL, $images = NULL)
  {
    if (isset($text))
    {
      $html = "<p>";
        $html.= $text;
      $html.= "</p>";
      $text = $html;
    }

    return body($title, $text, $images);
  }
?>

