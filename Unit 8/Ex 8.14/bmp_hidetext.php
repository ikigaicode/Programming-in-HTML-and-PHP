<?php
  $inFile = "turkey.bmp";
  $outFile = "turkey_text.bmp";
  echo filesize($inFile) . "<br />";
  $in = fopen($inFile, 'r');
  $out = fopen($outFile, 'w');
  $hiddenText = "Please don't eat me!";
  $startRow = 9;
  // Read header.
  $ch = array();
  for ($i=0; $i<14; $i++){
    $ch[$i] = ord(fgetc($in));
    echo $ch[$i] . " ";
    // Write starting row for the text here, in unused byte.
    if ($i == 6) fwrite ($out, chr($startRow), 1);
    else fwrite ($out, chr($ch[$i]), 1);
  }

  echo "<br />";
  for ($i=0; $i<40; $i++){
    $ch[$i] = ord(fgetc($in));
    echo $ch[$in]. " ";
    fwrite ($out, chr($ch[$i]), 1);
  }

  echo "<br />";
  $cols = $ch[7] * 16777216 + $ch[6] * 65536 + $ch[5] * 256 + $ch[4];
  $bytes = 3 * $cols;
  $nPad = 4 - $bytes%4;
  // Each row padded to contain a multiple of 4 bytes.

  echo "# of pad bytes = " .$nPad. "<br />";
  $rows = $ch[11] * 16777216 + $ch[10] * 65536 +$ch[9] * 256 + $ch[8];
  echo "rows and columns: " .$rows. " " .$cols. "<br />";
  // Read image.

  $K = strlen($hiddenText);
  $knt = 0;
  for ($r=1; $r<=$rows; $r++){
    for ($c=1; $c<=$cols; $c++){
      for ($i=0; $i<=2; $i++){
        $ch[$i] = fgetc($in);
      }
      $avg = (ord($ch[0]) + ord($ch[1]) + ord($ch[2])) / 3;
      fwrite ($out, chr($avg), 1);
      fwrite ($out, chr($avg), 1);
      fwrite ($out, chr($avg), 1);
    }
    // Read pad bytes at end of line.
    for ($p=1; $p<=$nPad; $p++){
      $pad = fgetc($in);
      if (($r>=$startRow) && ($knt<$K)){
        // Write text into pad bytes.
        fwrite ($out, substr($hiddenText, $knt, 1), 1);
        $knt++;
      }
      else fwrite ($out, $pad, 1);
    }
  }
  fclose($in);
  fclose($out);
  echo "A grayscale file has been created. <br />";
?>
