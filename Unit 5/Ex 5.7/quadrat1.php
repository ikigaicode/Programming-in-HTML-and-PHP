<html>
  <head>
    <title>Solving the Quadratic Equation</title>
  </head>

  <body>
    <form method="post" action="<?php $_SERVER ['PHP_SELF']; ?>">
      <h3>Solving the Quadratic Equation</h3>
          Enter coefficients for ax<sup>2</sup> + bx + c = 0 :
      <br />

      a = <input type="text" value="1" name="a" /> (must not be 0) <br />

      b = <input type="text" value="2" name="b" /> <br />

      c = <input type="text" value="-8" name="c"/> <br />

      <input type="submit" value="Click to get roots..." />

    </form>
  </body>
</html>

<?php
  if (! empty ($_POST)) {
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];

    $d = $b * $b - 4 * $a * $c;

    if ($d == 0) {
      $r1 = $b / (2 * $a);
      $r2 = "undefined";
    }
    elseif ($d < 0) {
      $r1 = "undefined";
      $r2 = "undefined";
    }
    else {
      $r1 = (-$b + sqrt($b * $b - 4 * $a * $c)) / 2 / $a;
      $r2 = (-$b - sqrt($b * $b - 4 * $a * $c)) / 2 / $a;
    }

    echo "r1 = " .$r1. ", r2 = " .$r2;
  }

?>
