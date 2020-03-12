<html>
  <head>
    <title>
      Loan Calculator
    </title>
  </head>

  <body>
    <h3>Loan Calculator</h3>

    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      Principal Amount: $:
      <input type="text" name="amount" size="9" maxlenght="9" value="10000" />
      <br />

      Annual rate: %
      <input type="text" name="rate" size="6" maxlenght="6" value="4.5" />
      <br />

      Number of Months:
      <input type="text" name="n" size="3" maxlenght="3" value="24" />
      <br />

      <input type="submit" value="Click here to get monthly payment." />
    </form>
  </body>
</html>

<?php
  $P = $_POST["amount"];
  $r = $_POST["rate"];
  $n = $_POST["n"];

  $monthlyPayment = getPayment($P, $r, $n);
  echo "Your monthly payment is $ " . round($monthlyPayment, 2) . "<br />";

  echo "The total cost of your loan is $ " . round($monthlyPayment * $n, 2) .
    "<br />";

  function getPayment($P, $r, $n){
    $r = $r/100/12;
    $M = $P * $r/(1-1/pow(1+$r, $n));
    return $M;
  }
?>
