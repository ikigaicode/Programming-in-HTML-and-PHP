<?php
  $a = file("LatLon.dat");
  var_dump($a);
  echo "<br />";
  for ($i=1; $i<sizeof($a); $i++){
    list ($s, $la, $lo) = explode(" ", $a[ $i]);
    echo $s. ", ".$la.", ".$lo."<br />";
  }
  foreach ($a as $s){
    list ($site, $Lat, $Lon) = explode (" ", $s);
    echo $site. ", ".$Lat.", ".$Lon."<br />";
  }
?>
