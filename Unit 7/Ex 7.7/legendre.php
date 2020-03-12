<?php
   $n = 8;
   $x = 1.5;

   echo "Legendre polynomials for x = " . $x . "<br />";
   for ($i=0; $i<=$n; $i++){
     $L = getLegendre($i, $x);
     echo $i . " " . $L . "<br />";
   }
   function getLegendre($n, $x){
     if ($n == 0) return 1;
     else if ($n == 1) return $x;
     else return (2.0 * $n-1) / $n * getLegendre  ($n-1, $x) -
      ($n-1) / $n * getLegendre($n-2, $x);
   }
?>
