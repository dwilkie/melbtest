<?php
  function head($title, $options = array())
  {
    $html = "<head>";
      $html.= "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />";
      $html.= "<title>Melbourne Testing Services::$title</title>";
      $html.= "<link rel=\"stylesheet\" type=\"text/css\" href=\"stylesheets/style.css\" />";
      $html.= "<script src=\"javascript/script.js\" type=\"text/javascript\"></script>";
      $script_attrs = $options["script_attrs"];
      if (isset($script_attrs))
        $html.= "<script $script_attrs></script>";
    $html.= "</head>";

    return $html;
  }
?>

