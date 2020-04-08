<?php
  $out = fopen("formatTest.txt", 'w');
  $a = 67;
  $b = .000717;
  $c = -67;
  $d = 83.17;
  fprintf ($out, "right justified, with sign and precision specifier \r\n");
  fprintf ($out, "%+12.6f\r\n", $a);
  fprintf ($out, "%+12.6f\r\n", $b);
  fprintf ($out, "%+12.6f\r\n", $c);
  fprintf ($out, "%+12.6f\r\n", $d);
  fprintf ($out, "display integer %d as character \r\n", $a);
  fprintf ($out, "%c\r\n", $a);
  fprintf ($out, "display number as a string\r\n");
  fprintf ($out, "%s \r\n", $b);
  $line1 = "1/14/2013 17:3:1";
  $formatString = "%'02d/ %'02d/ %4d%'02d:%'02d:%'02d";
  sscanf ($line1, "%i/%i/%i %d:%d:%d", $mon, $day, $yr, $hr, $min, $sec);
  fprintf ($out, "Display %s padded with 0's: ", $line1);
  fprintf ($out, $formatString, $mon, $day, $yr, $hr, $min, $sec);
  echo "Created Output File.";
  fclose ($out);

?>
