<?php require("helpers/page.php"); ?>
<?php page("Vehicle Jacks and Stands"); ?>
    <p>
      Tests on car trolley jacks and stands and ramps can be conducted to AS/NZS 2538, 2615, 2640, 2693 and similar standards.
    </p>
<?php
  $images = array(
    array("Bottle Jack Overload Test", "bottle_jack_overload_test.jpg"),
    array("Car Stand Overload Test", "car_stand_overload_test.jpg"),
    array("Garage Jack Eccentric Test", "garage_jack_eccentric_test.jpg"),
    array("Car Stand Test", "car_stand_1.gif")
  );
  image_gallery($images);
  footer();
?>

