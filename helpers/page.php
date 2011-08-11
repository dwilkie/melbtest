<?php
    require('helpers/head.php');
    require('helpers/body.php');

  function wrap_page($head, $body)
  {

    $html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";
    $html.= "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">";
      $html.= $head;
      $html.= $body;
    $html.= "</html>";

    return $html;
  }

  function service_page($title, $text, $images = NULL)
  {
    return wrap_page(head($title), service_page_body($title, $text, $images));
  }

  function page($title, $text, $options = array())
  {
    return wrap_page(head($title, $options), body($title, $text, NULL, $options));
  }
?>

