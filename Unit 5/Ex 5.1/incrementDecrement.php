<?php
  $x=3;
  $y=($x++)+3;

  echo "post-increment: y = " .$y. "<br />";
  echo "x = " .$x. "<br />";

  $x=3;
  $y=(++$x)+3;

  echo "pre-increment: y=" .$y. "<br />";
  echo "x = " .$x. "<br />";
?>
