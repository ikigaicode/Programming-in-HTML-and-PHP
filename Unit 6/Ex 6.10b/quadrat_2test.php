<?php

print_r ($_POST);
echo "<br />";

var_dump ($_POST["coeff"]);
echo "<br />";

$coefficientArray = array_keys ($_POST["coeff"]);

$a = $_POST["coeff"][$coefficientArray[0]];
$b = $_POST["coeff"][$coefficientArray[1]];
$c = $_POST["coeff"][$coefficientArray[2]];
$d = $b * $b - 4.0 * $a * $c;

if ($d == 0) {
  $r1 = $b/(2.0 * $a);
  $r2 = "undefined";
}
else if ($d < 0) {
  $r1 = "undefined";
  $r2 = "undefined";
}
else {
  $r1 = (-$b + sqrt($b * $b - 4.0 * $a * $c)) / (2.0 * $a);
  $r2 = (-$b - sqrt($b * $b - 4.0 * $a * $c)) / (2.0 * $a);
}

echo "r1 = " . $r1 . ", r2 = " . $r2;
?>
