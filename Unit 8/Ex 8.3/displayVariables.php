<?php
  $a = array("Monday", "Tuesday");
  $s = "I'm supposed to be in class on %s and %s. <br />";
  echo "Using printf() and sprintf() <br/ >";
  printf ($s, $a[0], $a[1]);
  echo sprintf ($s, $a[0], $a[1]);
  echo "Using print_f() <br />";
  print_r ($a);
  echo "<br /> Using var_dump() <br />";
  var_dump ($a);
  echo "Using vprintf() <br />";
  $b = array('A', 17.7, TRUE);
  vprintf ("Building a string from an array: %s, %s, %u", $b);
?>
