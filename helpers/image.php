<?php
  function service_image($title, $filename)
  {
    $filename_parts = pathinfo($filename);
    $thumbnail_file = basename($filename, $filename_parts['extension']) . "png";
    $service = basename($_SERVER["REQUEST_URI"], ".php");
    $service_path = "images/services/$service";
    $image_path = "$service_path/$filename";
    $thumbnail_path = "$service_path/thumbs/$thumbnail_file";

    $html = "<div class=\"thumbnail\">";
      $html.= "<a href=\"$image_path\" title=\"See the image full size\">";
        $html.= "<img src=\"$thumbnail_path\" alt=\"$title\"/>";
      $html.= "</a>";
      $html.= $title;
    $html.=  "</div>";

    return $html;
  }

  function service_images($images)
  {
    $html = "";
    foreach ($images as $image)
    {
      $html.= service_image($image[0], $image[1]);
    }

    return $html;
  }
?>

