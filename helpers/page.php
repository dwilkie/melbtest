<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php function page($title, $options = array()) { ?>
<?php
  head($title, $options);
  body($title, $options);
?>
<?php } ?>

<?php function head($title, $options = array()) { ?>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <title>Melbourne Testing Services::<?php echo($title); ?></title>
  <link rel="stylesheet" type="text/css" href="stylesheets/style.css" />
  <script src="javascript/script.js" type="text/javascript"></script>
  <?php
    $script_attrs = $options["script_attrs"];
    if (isset($script_attrs))
      echo("<script $script_attrs></script>\r\n");
  ?>
</head>

<?php } ?>

<?php function body($title, $options = array()) { ?>
<!--body -->
<?php
  $body_attrs = $options["body_attrs"];
  if (isset($body_attrs))
    $html = "<body $body_attrs>";
  else
    $html = "<body>";
  echo("$html\r\n");
  logos();
  navex();
?>

  <!--main content -->
  <div class="content">
    <h1><?php echo($title); ?></h1>
<?php } ?>

<?php function logos() { ?>
  <!-- logos -->
  <div class="logos">
    <a href="index.php">
      <img class="mts_logo" src="images/mts_logo.png" title="Melbourne Testing Services" alt="Melbourne Testing Services" />
    </a>

    <a href="http://www.nata.asn.au/index.php/scopeinfo/?key=1040" onclick="return openWindow('http://www.nata.asn.au/index.php/scopeinfo/?key=1040')">
      <img class="nata_logo" src="images/nata_logo.png" title="NATA" alt="NATA" />
    </a>
  </div>
<?php } ?>

<?php function navex() { ?>

  <!-- navigation -->
  <div class="navex">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="feedback.php">Feedback</a></li>
    </ul>
  </div>
<?php } ?>

<?php function footer() { ?>
  </div>
  <!-- end main content-->

  <!-- footer -->
  <div class="footer">
    <p>
      <a class="validate" href="http://validator.w3.org/check?uri=referer" onclick="return openWindow('http://validator.w3.org/check?uri=referer')">
        <img style="border:0;width:88px;height:31px" src="images/valid-xhtml10.png" alt="Valid XHTML 1.0 Strict" />
      </a>

      <a class="validate" href="http://jigsaw.w3.org/css-validator/" onclick="return openWindow('http://jigsaw.w3.org/css-validator/validator?uri=http://www.melbtest.com.au/stylesheets/style.css')">
        <img style="border:0;width:88px;height:31px" src="images/vcss.png" alt="Valid CSS" />
      </a>
      <br />
      Webmaster: <a href="mailto:dwilkie@gmail.com?subject=MTS Website">David Wilkie</a>
    </p>
  </div>
</body>
</html>
<?php } ?>

<?php function image($title, $filename) { ?>
  <?php
    $filename_parts = pathinfo($filename);
    $thumbnail_file = basename($filename, $filename_parts['extension']) . "png";
    $service = basename($_SERVER["REQUEST_URI"], ".php");
    $service_path = "images/services/$service";
    $image_path = "$service_path/$filename";
    $thumbnail_path = "$service_path/thumbs/$thumbnail_file";
  ?>
  <div class="thumbnail">
      <a <?php echo("href=\"$image_path\""); ?> title="See the image full size">
        <img <?php echo("src=\"$thumbnail_path\" alt=\"$title\""); ?>/>
      </a>
      <?php echo("$title\r\n"); ?>
    </div>
<?php } ?>

<?php function image_gallery($images) { ?>

    <!-- images -->
<?php
  foreach ($images as $image) {
    image($image[0], $image[1]);
  }
?>
<?php } ?>

