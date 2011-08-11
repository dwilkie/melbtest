<?php
  require("helpers/page.php");

  $title = "About Us";

  $content = "<p>";
    $content .= "Melbourne Testing Services Pty Ltd was established in 1999. The Managing Director of the company, Rod Wilkie, was previously employed for 16 years by a Melbourne based research and development laboratory, gaining considerable first-hand experience in mechanical testing, structural testing and laboratory management.";
  $content .= "</p>";
  $content .= "<p>";
    $content .= "It was the ever increasing need for manufacturers of materials and components to ensure that their products conformed to design specifications, that motivated Rod to establish Melbourne Testing Services, a public testing company that specialises in destructive testing, proof load testing and R and D services.";
  $content .= "</p>";
  $content .= "<p>";
    $content .= "Melbourne Testing Services is accredited with the National Association of Testing Authorities (NATA) and complies with the requirements of ISO/IEC 17025 (2005) ensuring that all testing is carried out in accordance with strict quality control initiatives and all relevant Australian and International Standards are adhered to.";
  $content .= "</p>";
  $content .= "<p>";
    $content .= "Our accredited laboratory is equipped with a wide range of mechanical and structural testing equipment including the following:";
    $content .= "<ul>";
      $content .= "<li>";
        $content .= "A 500kN servo hydraulic testing frame with the latest software suitable for testing large structures.";
      $content .= "</li>";
      $content .= "<li>";
        $content .= "Two 300kN servo-electromechanical, universal testing machines that operate using a closed loop computer control system enabling accurate test results for a large range of tension, shear and compression tests.";
      $content .= "</li>";
      $content .= "<li>";
        $content .= "An Instron 500kN fatigue testing machine operating with the latest software provides static and dynamic test methods for the determination of strength and fatigue life.";
      $content .= "</li>";
      $content .= "<li>";
        $content .= "A 300kN tension and compression testing machine suitable for testing reinforcing material for concrete.";
      $content .= "</li>";
    $content .= "</ul>";
  $content .= "</p>";
  $content .= "<p>";
    $content .= "Apart from mechanical and structural testing services, MTS also provides consultancy services for failure analysis, structural integrity and site inspection.";
  $content .= "</p>";
  $content .= "<p>";
    $content .= "Confidence in knowing the performance attributes and strength of products is an important consideration for manufacturers, retailers and end-users. We specialise in compression, tension and bend testing of materials and products. Testing can be conducted to destruction or proof loaded to ensure that products have adequate strength to perform as intended.";
  $content .= "</p>";

  echo page($title, $content);
?>

