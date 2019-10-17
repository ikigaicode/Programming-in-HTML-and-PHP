<html>
  <head>
    <title>Calculate Compound Interest</title>
  </head>

  <body>
    <h3>Calculate Compound Interest</h3>

    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      Initial amount (no commas), $: <input type="text" name="initial" value="10000" size="6" /><br />
      Annual interest rate, %: <input type="text" name="rate" size="4" value="4.5" /><br />
      How many years?: <input type="text" name="years" value="10" size="3" /><br />

      <input type="submit" name="submit" value="Generate compound interest table." />

    </form>

    <?php
    if (! empty($_POST)){
      $initial = $_POST["initial"];
      $rate = $_POST["rate"];
      $years = $_POST["years"];

      echo $initial . " " . $rate . " " . $years . "<br />";

      for ($i = 1; $i <= $years; $i++) {
        $amount = $initial * pow(1 + $rate / 100, $i);
        echo $i . "$" . number_format($amount, 2) . "<br />";
      }
    }


    ?>
  </body>
</html>
