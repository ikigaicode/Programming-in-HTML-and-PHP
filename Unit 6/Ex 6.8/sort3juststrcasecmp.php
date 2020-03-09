<?php
//function compare ($x, $y) {
//  return strcasecmp ($x, $y);
//}

// Create and sort an array...

$a = array('Xena', 'Sue', 'david', 'apple');

echo "Original array: <br />";

for ($i=0; $i<sizeof($a); $i++) {
  echo $a[$i] . "<br />";
}

echo "Sorted array with user-defined comparisions of elements: <br />";

usort($a, "strcasecmp");

for ($i=0; $i<sizeof($a); $i++) {
  echo $a[$i] . "<br />";
}
 ?>
