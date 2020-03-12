<html>
  <head>
    <title>Calculate n!</title>
  </head>
  <body>
    <h3>Calculate n!</h3>

    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      Enter n (integer >= 0) :

      <input type="text" name="n" value="8" size="3"/> <br />

      <input type="submit" name="submit" value="Calculate n!" />

    </form>

    <?php
      $n = $_POST["n"];

      echo "max integer: " . PHP_INT_MAX . "<br />";

      echo "Calculate n! for n = " . $n . "<br />";

      $nfact = nFactorial($n);

      echo $nfact . "<br />";

      function nFactorial($n) {
        if ($n <= 1) return 1;
        else return $n * nFactorial ($n-1);
      }

    ?>
  </body>
</html>
