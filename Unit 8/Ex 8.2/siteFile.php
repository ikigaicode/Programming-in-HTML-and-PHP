<?php
  $in = fopen("siteFile.txt", 'r');
  $out = fopen("siteFile.csv",'w');
  $header = fgets($in);
  $h = array();
  $h = explode('', $header);
  echo $header. "<br />";
  fprintf ($out, "%s, %s, %s", $h[ 0], $h[ 1], $h[ 2]);
  while (!feof($in)){
    $line = fgets($in);
    if (strlen($line)>3){
      sscanf ($line, "%s %f %f", $site, $lon, $lat);
      echo $site. ",".$lon.",".$lat."<br />":
      fprintf ($out, "%s, %f, %f/n", $site, $lon, $lat);
    }
  }
  fclose ($in);
  fclose ($out);

?>
