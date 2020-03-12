<html>
  <head>
    <title>Calculate true anomaly of orbiting object</title>
  </head>

  <body>
    <h3>Calculate true anomaly of orbiting object</h3>

    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

      Semimajor axis (Km) :
      <input type="text" name="a" size="5" value="7000" /><br />

      Eccentricity (0 to &lt;1) :
      <input type="text" name="e" size="5" value="0.7" /><br />

      Time steps along orbit path (how many, even #) :
      <input type="text" name="n" size="3" value="10" /><br />

      <input type="submit" value="Click here to generate true anomalies." />

    </form>
  </body>
</html>

<?php

  if (!empty($_POST)){
   $a = $_POST["a"];
   $e = $_POST["e"];
   $n = $_POST["n"];
   $tau = 2.0 * pi() * $a * sqrt($a/398601.2);
   $dt = ($tau/60.0) / $n;

   echo "Period, minutes: " . round($tau/60.0, 3) . "<br />";
   echo "time, mean anomaly, true anomaly (deg) <br />";

    for ($t=0; $t<($tau/60.0); $t+=$dt){
      $M=2.0*pi()*$t*(60.0/$tau);
      echo round($t,4) . " " . round(180/pi()*$M,3);
      if ($e == 0) {
          $f=$M; // for circular orbit
      }
        else {
        $E=getE($e,$M,$M); // E = M as initial value
        $f=acos((cos($E)-$e)/(1-$e*cos($E)));
        }

        $f=180/pi()*$f;

        if ($t/($tau/60) > 0.5) {
            $f=360-$f;
        }
        echo " " .round($f,3). "<br />";
    }

    echo round($tau/60,3) . " " . round(360,3) . " " . round(360,3). "<br />";

    function getE($e,$M,$E) {
      $newE=$M + $e*sin($E);
      if (abs($newE-$E) < 1e-5) {
        return $newE;
      }
      else {
        return getE($e,$M,$newE); // recursive
      }

?>
