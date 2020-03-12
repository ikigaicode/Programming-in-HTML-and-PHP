<?php
  $n = 8;
  echo "Calculate the first  " . $n . "  Fibonacci numbers. <br />";

  for ($i=1; $i<=$n; $i++) {
    echo $i . " " . Fib($i) . "<br />";
  }

  function Fib($n) {
    if ($n<=2) return 1;
    else return Fib($n-1)+Fib($n-2);
  }
?>
