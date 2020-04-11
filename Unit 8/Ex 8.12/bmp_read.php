<?php
  $inFile = "turkey.bmp";
  echo filesize($inFile) . "<br />";
  $in = fopen($inFile, 'r');
  // Read header.

  $ch = array();
  for ($i=0; $i<14; $i++){
    $ch[$i] = ord(fgetc($in));
    echo $ch[$i] . " ";
  }

  echo "<br />";
  // $offset = $ch[10];
  for ($i=0; $i<40; $i++){
    $ch[$i] = ord(fgetc($in));
    echo $ch[$i] . " ";
  }

  echo "<br />";
  $cols = $ch[5] * 256 + $ch[4];
  $bytes = 3 * $cols;
  // Each row is padded to contain a multiple of 4 bytes.
  $nPad = 4 - $bytes%4;

  echo "# of pad bytes = " .$nPad. "<br />";
  $rows = $ch[9] * 256 + $ch[8];

  echo "rows and columns: " .$rows. " " .$cols. "<br />";
  // Read image.

  for ($r=1; $r<=$rows; $r++) {
    for ($c=1; $c<=$cols; $c++){
      for ($i=0; $i<=2; $i++) {
        $ch[$i] = fgetc($in);
        echo ord($ch[$i]);
      }
      echo " ";
    }
    // Read pad bytes at end of line.
    for ($p=1; $p<=$nPad; $p++){
      $pad = fgetc($in);
      echo "pad";
    }
    echo "<br />";
  }
  fclose($in);
?>
