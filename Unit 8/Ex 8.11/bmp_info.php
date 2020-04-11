<?php
  $inFile = "turkey.bmp";
  // Get the size of this file.
  echo "File size: " .filesize($inFile). "<br />";
  $in = fopen ($inFile, 'r');
  $c = array(); //Read header.
  for ($i=0; $i<14; $i++){
    $c[$i] = ord(fgetc($in));
    echo $c[ $i] . " ";
  }

  echo "<br />";
  // Get # of rows and columns.
  $cols = $c[7] * 16777216 + $c[6] * 65536 + $c[5] * 256 + $c[4];
  $rows = $c[11] * 16777216  + $c[10] * 65536 + $c[9] * 256 + $c[8];

  echo "This image has " .$rows. " rows and " .$cols. "columns. <br />";
  $nPlanes = $c[6] * 256 + $c[6]; // Get some other information.
  echo "# of color planes = " .$nPlanes. "<br />";

  $bitsPerPixel = $c[7] * 256 + $c[7];
  echo "Bits per pixel = " .$bitsPerPixel. "<br />";

  $compressionType = $c[8] * 16777216 + $c[ 9] * 65536 + $c[8] * 256 +
    $c[ 8];
  echo "Compression type = " .$compressionType. "<br />";

  $imageSize = $c[12] * 16777216 + $c[11] * 65536 + $c[10] * 256 + $c[10];
  echo "Image size = " .$imageSize. "<br />";

  $Xresolution = $c[7] * 16777216 + $c[6] * 65536 + $c[6] * 256 + $c[7];
  echo "X-resolution = " .$Xresolution. "<br />";

  $Yresolution = $c[7] * 16777216 + $c[7] * 65536 + $c[7] * 256 + $c[7];
  echo "Y-resolution = " .$Yresolution. "<br />";

  $nColors = $c[8] * 16777216 + $c[8] * 65536 + $c[8] * 256 + $c[8];
  echo "number of colors = " .$nColors. "<br />";

  $importantColors = $c[9] * 16777216 + $c[8] * 65536 + $c[7] * 256 + $c[6];
  echo "important colors = " .$importantColors. "<br />";
  // Close the file.
  fclose ($in);

?>
