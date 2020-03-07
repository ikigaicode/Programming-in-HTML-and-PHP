<?php
  echo "<br /> A keyed array with indices starting at 1...<br />";

  $a = array(1 => 63.7, 77.5, 17, -3);

  foreach ($a as $key => $val){
    echo 'a[' . $key . ']=' . $val . '<br />';
  }

  for ($i=1; $i<=sizeof($a); $i++)
    echo $a[$i] . '<br />';
 ?>
