<?php
  // Openpyranometer.dat files as "read only."
  // $in=fopen("pyranometer.dat", "r") or exit("Can't open file.");

  $inFile = "pyranometer.dat";
  $in = fopen($inFile, 'r') or exit("Can't open file.");

  // Read three header lines.
  $site = fgets($in); // Read the whole line.


  fscanf($in, "%f %f", $Lat, $Lon); //Read these values individually.
  fscanf($in, "%f %f", $C1, $C2);
  $headers=fgets($in);  // Read the whole line.

  echo $site. "<br />";
  echo $Lat. ",". $Lon."<br />";
  echo $headers. "<br />";

  // Open new "write only" output file and write header lines.
  $out = fopen("pyranometer.csv", 'w');

  fprintf($out, "%s", $site);
  fprintf($out, "%f %f\n", $Lat, $Lon);
  fprintf($out, "%f %f\n", $C1, $C2);
  fprintf($out, "%s\n", "mon,day,yr,hr,min,sec,day_frac,PYR-1,PYR-2,");

  // Read data lines to end-of-file.
  while (! feof($in)) { //While is not the end of the file $in, repeat this block.
    fscanf($in, "%u %u %u %u %u %u %f %f %f %f", $mon, $day, $yr, $hr, $min, $sec, $day_frac, $P1, $P2, $T);
    echo $mon . "," . $day . "," . $yr . "," . $hr . "," . $min . "," . $sec . "," . $day_frac . "," . $P1 . "," . $P2 . "," . $T ."<br />";
    fprintf($out, "%u,%u,%u,%u,%u,%u,%f,%f,%f\n", $mon, $day, $yr, $hr, $min, $sec, $day_frac, $P1*$C1, $P2*$C2);
  }

  // Close input and output files.
  fclose($in);
  fclose($out);
?>
