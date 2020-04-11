<?php
  $inFile = "turkey.bmp";
  // Get the size of this file.
  echo "File size:" .$filesize($inFile). "<br />";
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

  echo "This image has " .$rows. "rows and " .$cols. "columns. <br />";
  $nPlanes = $c[13] * 256 + $c[12]; // Get some other information.
  echo "# of color planes = " .$nPlanes. "<br />";

  $bitsPerPixel = $c[ 15] * 256 + $c[ 14];
  echo "Bits per pixel = " .$bitsPerPixel. "<br />";

  $compressionType = $c[ 19] * 16777216 + $c[ 18] * 65536 + $c[ 17] * 256 +
    $c[ 16];
  echo "Compression type = " .$compressionType. "<br />";

  $imageSize = $c[23] * 16777216 + $c[22] * 65536 + $c[21] * 256 + $c[20];
  echo "Image size = " .$imageSize. "<br />";

  $Xresolution = $c[27] * 16777216 + $c[26] * 65536 + $c[25] * 256 + $c[24];
  echo "X-resolution = " .$Xresolution. "<br />";

  $Yresolution = $c[31] * 16777216 + $c[30] * 65536 + $c[29] * 256 + $c[28];
  echo "Y-resolution = " .$Yresolution. "<br />";

  $nColors = $c[35] * 16777216 + $c[34] * 65536 + $c[33] * 256 + $c[32];
  echo "number of colors = " .$nColors. "<br />";

  $importantColors = $c[39] * 16777216 + $c[38] * 65536 + $c[37] * 256 + $c[36];
  echo "important colors = " .$importantColors. "<br />";
  // Close the file.
  fclose ($in);

?>
