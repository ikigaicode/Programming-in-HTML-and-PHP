<?php
  $A = array(17.7, 3, 'z', "PHP");
  for ($i = 0; $i < sizeof($A); $i++) {
    echo $A[ $i] . "<br />";
  }

  echo "<br />";
  $B = array();
  for ($i=0; $i < 10; $i++) {
    $B[ $i] = rand(0, 100);
    echo $B[ $i] . "<br />";
  }

?>
