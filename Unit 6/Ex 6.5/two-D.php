<?php
echo "<br /> A 2-D array <br />";

$a = array (
  0 => array(1, 2, 3, 4),
  1 => array(5, 6, 7, 8),
  2 => array(9, 10, 11, 12),
  3 => array(13, 14, 15, 16),
  4 => array(17, 18, 19 , 20)
);

$n_r=count ($a); echo "# rows = " . $n_r . "<br />";
$n_c=count ($a[0]); echo "# columns = " . $n_c . "<br />";
  for ($r=0; $r<$n_r; $r++) {
    for ($c=0; $c<$n_c; $c++)
      echo $a [$r] [$c] . ' ';
    echo '<br / >';
  }

 ?>
