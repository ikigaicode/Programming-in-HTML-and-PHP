<html>
<!--  <head>
  <title></title>
</head> -->
  <body>
    <h3>Calculate Dew Point Temperature</h3>

    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

      Air temperature, &deg;C (0<= T <= 60) :
      <input type="text" size="4" name="T" value="25" /><br />

      Relative humidity, %:
      <input type="text" size="4" name="RH" value="60" /><br />

      <input type="submit" value="Calculate dew point temperature" />
    </form>
  </body>
</html>

<?php
  $T = $_POST["T"];
  $RH = $_POST["RH"] / 100.0 ; //convert from % to fraction
  $Td = getDewpoint($T, $RH);
  echo "dew point temperature (deg C): " . $Td . "<br />";
  function getDewpoint ($T, $RH) {
    $a = 17.27; $b = 237.7;
    $beta = $a * $T / ($b + $T) + log ($RH); // log() is base e-log
    $Td = $b * $beta / ($a - $beta);
    return round($Td, 1);
  }

 ?>
