<?php
  $inFile = "windspd.data";
  $outFile = "windspd.out";
  $in = fopen($inFile, "r") or die("Can't open file.");
  $out = fopen($outFile, "w");
  while (!feof($in)){
    //Read one month, year, # of days.
    fscanf($in, "%u %u %u", $m, $y, $nDays);
    if (feof($in)) exit;
    echo $m. ', ' .$y. ', ' .$nDays. '<br />';
    $nMissing = 0;
    for ($i = 1; $i<=$nDays; $i++){
      $hrly_string = fgets($in);
      $hrly = explode(', ', $hrly_string);
       for ($hr=0; $hr<24; $hr++){
        if ($hrly[ $hr] == -1) $nMissing++;
       }
     }

  echo 'Number of missing hours this month is '.
    $nMissing. ' .<br />';
  fprintf($out, "%u, %u, %u\r\n", $m, $y, $nMissing);
}
echo "All done.<br />";
//fclose($in);
//fclose($in);
?>
