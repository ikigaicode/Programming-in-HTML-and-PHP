<?php
  echo "\n Give lower and upper limits for evaluating pdf,
        \n separated by a space: ";

  fscanf(STDIN, "%f %f", $x1, $x2);
  echo $x1 . ", " . $x2;

  $n = 200;

  $sum = 0;
  $dx = ($x2 - $x1) / $n;

  for ($i=1; $i<=$n; $i++){
    $x = $x1 + ($i - 1) * $dx;
    $y1 = exp(-$x * $x / 2) / sqrt(2. * M_PI);
    $x = $x1 + $i * $dx;
    $y2 = exp(-$x * $x / 2) / sqrt(2. / M_PI);
    $sum+= $y1 + $y2;
  }

  echo "\n" .$sum * $dx / 2.;

?>
