<?php
  $inFile = "turkey.bmp";
  $outFile = "turkey_grayscale.bmp";
  echo filesize($inFile) . "<br />";
  $in = fopen($inFile, 'r');
  $out = fopen($outFile, 'w');
  // Read header.

  $ch = array();
  for ($i=0; $i<14; $i++){
    // $ch[$i] = ord(fgetc($in));
    // echo $ch[$i] . " ";
    // fwrite($out, chr($ch[$i]), 1);
    fwrite ($out, fgetc($in));
  }

  echo "<br />";
  // $offset = $ch[10];
  for ($i=0; $i<40; $i++){
    $ch[$i] = ord(fgetc($in));
    echo $ch[$i] . " ";
    fwrite($out, chr($ch[$i]), 1);
  }

  echo "<br />";
  $cols = $ch[5] * 256 + $ch[4];
  $bytes = 3 * $cols;
  $nPad  = 4 - $bytes%4;
  // Each row padded to contain a multiple of 4 bytes.

  echo "# of pad bytes = " .$nPad. "<br />";
  $rows = $ch[ 9] * 256 + $ch[ 8];

  echo "rows and columns: " .$rows. " " .$cols. "<br />";
  // Read image.

  for ($r=1; $r<=$rows; $r++){
    for ($c=1; $c<=$cols; $c++){
      for ($i=0; $i<=2; $i++){
        $ch[$i] = fgetc($in);
      }
      $avg = (ord($ch[0]) + ord($ch[1]) + ord($ch[2])) / 3;
      fwrite($out, chr($avg), 1);
      fwrite($out, chr($avg), 1);
      fwrite($out, chr($avg), 1);
    }
    // Read pad bytesat end of line.
    for ($p=1; $p<=$nPad; $p++){
      $pad = fgetc($in);
      fwrite($out, $pad);
    }
  }
  fclose($in);
  fclose($out);
  echo "A grayscale file has been created. <br />";
?>
