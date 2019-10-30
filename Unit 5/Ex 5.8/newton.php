<html>
  <head>
    <title></title>
  </head>

  <body>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <h3>Newton's Square Root Algorithm</h3>

      Enter a positive number:

      <input type="text" value="9" size="4" name="n" />
      <br />
      <input type="submit" value="Click to calculate square root" />

    </form>
  </body>
</html>

<?php
  if (! empty ($_POST)) {
    $n = $_POST["n"];
    $g = $n / 2;

    do {
      $g = ($g + $n / $g) / 2.;
    } while (abs ($g * $g - $n) > 1e-5);

    echo "Square Root = " .$g. "<br />";
  }

?>
