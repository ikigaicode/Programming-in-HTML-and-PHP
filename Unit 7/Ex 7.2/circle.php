<html>
  <head>
    <title></title>
  </head>
  <body>
    <h3>Calculate the area and circumference of a circle.</h3>

    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      radius: <input type="text" size="4" name="r" value="25" />
      <br />

      <input type="submit" value="Calculate area and circumference" />
    </form>
  </body>
</html>

<?php
$r =  $_POST["r"];
$a = []; // [0] is circumference, [1] is area
$a = circleStuff($r);
echo "circumference: " . $a[0] . "area: " . $a[1] . "<br />";
function circleStuff($r) {
  $a = [];
  $a = [0] = round(2.0 * pi () * $r, 2); // circumference in [0]
  $a = [1] = round(pi() * $r * $r, 2); // area in [1]
  return $a;
}


 ?>
