<?php
  function barGraph($chartTitle, $xLabels, $yLabels, $x_max, $y_max, $x_MinValues,
    $x_MaxValues, $xvalue_min, $xvalue_max, $dx, $dy, $bar_height, $pR, $pG, $pB,
    $nR, $nG, $nB, $uR, $uG, $uB, $bkg, $xlabel_Xoffset){

  Header ("Content-type: image/gif");

  $n_x = count($xLabels); //number of x labels.
  $n_y = count($yLabels); //number of y labels.

  $max_YlabelLength = 0;

  for ($i=0; $i<$n_y; $i++){
    if (strlen($yLabels[$i]) > $max_YlabelLength)
    $max_YlabelLength = strlen($yLabels[$i]);
  }

  // starting coordinates for graph
  $x0 = 100;
  $y0 = 60;

  // Title offsets from upper left hand corner.
  $x0_titleOffset = 0;
  $y0_titleOffset = 50;

  // X label offsets. x-, y+
  $xlabel_Yoffset = 20;
  // Y label offsets. x-, y+
  $ylabel_Yoffset = 5;

  // Calculate X offset based on length of 1st label,
  // 9 pix/character
  $ylabel_Xoffset = $max_YlabelLength * 9 + 5;
  //-----------------------------------------------
  // define bar size and vertical position.
  $bar_Yoffset = floor(($dy - $bar_height) / 2); // center bar in $dy space

  // create image space.
  $im = imageCreate($x_max, $y_max) or die ("Cannot create new GD image.");

  $background_color = ImageColorAllocate($im, $bkg[0], $bkg[1], $bkg[2]);

  // define color
  $text_color = ImageColorAllocate($im, 0, 0, 0); //text_color.
  $text_color = ImageColorAllocate($im, 0, 0, 0); //line color.
  $horizontal_line_color = ImageColorAllocate($im, 200, 200, 200);
  ImageSetThickness($im, 1);

  // bar colors
  $negative = ImageColorAllocate($im, $pR, $pG, $pB);
  $positive = ImageColorAllocate($im, $nR, $nG, $nB);
  $neutral = ImageColorAllocate($im, $uR, $uG, $uB); // - to +

  $title_font_size = 5; // large font for title
  $title_color = ImageColorAllocate($im, 0, 0, 0);

  // Outline graphing space: top, left, right, bottom
  ImageLine($im, $x0, $y0, $x0 + $dx * ($n_x - 1), $y0, $line_color);
  ImageLine($im, $x0, $y0, $x0, $y0 + $dy * ($n_y), $line_color);
  ImageLine($im, $x0 + $dx * ($n_x - 1), $y0, $x0 + $dx * ($n_x - 1),
            $y0 + $dy * ($n_y), $line_color);
  ImageLine($im, $x0, $y0 + $dy * ($n_y), $x0 + $dx * ($n_x - 1),
            $y0 + $dy * ($n_y), $line_color);

  // Draw chart title.
  ImageString($im, $title_font_size, $x0 + $x0_titleOffset, $y0 - $y0_titleOffset,
              $chartTitle, $title_color);

  // Draw Y labels and horizontal lines.
  for ($i=0; $i<$n_y; $i++){
    ImageString($im, $title_font_size, $x0 - $ylabel_Xoffset,
                $y0 + $dy * $i + $ylabel_Yoffset, $yLabels[$i], $text_color);
    if ($i>0) ImageLine($im, $x0, $y0 + $dy * $i, $x0 + ($n_x - 1) * $dx,
      $y0 + $dy * $i, $horizontal_line_color);
  }

  // Draw bars
  $xRange = $xvalue_max - $xvalue_min;
  for ($i=0; $i<$n_y; $i++){
    $x1 = $x0 + $dx * ($n_x - 1) * ($x_MinValues[$i] - $xvalue_min) / $xRange;
    $x2 = $x0 + $dx * ($n_x - 1) * (1 - ($xvalue_max - $x_MaxValues[$i]) / $xRange);
    if (($x_MinValues[$i] <= 0) && ($x_MaxValues[$i] <= 0)) $color = $negative;
    elseif (($x_MinValues[$i] >= 0) && ($x_MaxValues[$i] >= 0)) $color = $positive;
    else $color = $neutral;
    ImageFilledRectangle($im, $x1, $y0 + $bar_Yoffset + $i * $dy, $x2,
      $y0 + $bar_Yoffset + $i * $dy + $bar_height, $color);
  }

  // Draw X labels and vertical lines
  for ($i=0; $i<$n_x; $i++){
      ImageString($im, $title_font_size, $x0 - $xlabel_Xoffset + $i * $dx,
        $y0 - $xlabel_Yoffset, trim($xLabels[$i]), $text_color);
      ImageLine($im, $x0 + $i * $dx, $y0, $x0 + $i * $dx, $y0 + $dy * ($n_y),
        $line_color);
  }

  // Create GIF image and release allocated resources.
  ImageGIF($im);
  ImageDestroy($im);
  }

  // --------------MAIN PROGRAM-------------------------
  $inFile = $_POST["fileName"];
  //read data file
  $in = fopen($inFile, 'r');
  $chartTitle = trim(fgets($in));
  $s = fgets($in);
  $xLabels = explode(',', $s);
  for ($i=0; $i<count($xLabels); $i++) trim($xLabels[$i]);
  fscanf($in, "%f %f", $xvalue_min, $xvalue_max);
  $ny = -1;
  while (!feof($in)){
    $s = fgets($in);
    if (strlen($s) > 3){
      $ny++;
      sscanf($s, "%s %f %f", $yLabels[$ny], $x_MinValues[$ny], $x_MaxValues[$ny]);
    }
  }
  fclose($in);
  //get data from HTML document.
  $positiveColor = $_POST["positiveColor"];
  $negativeColor = $_POST["negativeColor"];
  $neutralColor = $_POST["neutralColor"];
  $colorStrings = $_POST["colorString"];
  $bkg = explode(',', $colorString);
  switch($positiveColor){
    case "black": $pR=0; $pG=0; $pB=0; break;
    case "blue": $pR=0; $pG=0; $pB=255; break;
    case "green": $pR=0; $pG=255; $pB=0; break;
    case "grey": $pR=100; $pG=100; $pB=100; break;
    case "red": $pR=255; $pG=0; $pB=0; break;
  }

  switch($negativeColor){
    case "black": $pR=0; $pG=0; $pB=0; break;
    case "blue": $pR=0; $pG=0; $pB=255; break;
    case "green": $pR=0; $pG=255; $pB=0; break;
    case "grey": $pR=100; $pG=100; $pB=100; break;
    case "red": $pR=255; $pG=0; $pB=0; break;
  }

  switch($neutraleColor){
    case "black": $pR=0; $pG=0; $pB=0; break;
    case "blue": $pR=0; $pG=0; $pB=255; break;
    case "green": $pR=0; $pG=255; $pB=0; break;
    case "grey": $pR=100; $pG=100; $pB=100; break;
    case "red": $pR=255; $pG=0; $pB=0; break;
  }

  $x_max = $_POST["xSize"];
  $y_max = $_POST["ySize"];
  $bar_height = $_POST["BarHeight"];
  $dx = $_POST["dx"];
  $dy = $_POST["dy"];
  $xLabelOffset = $_POST["xLabelOffset"];
  barGraph($chartTitle, $xLabels, $yLabels, $x_max, $y_max, $x_MinValues,
    $x_MaxValues, $xvalue_min, $xvalue_max, $dx, $dy, $bar_height, $pR, $pG, $pB,
    $nR, $nG, $nB, $uR, $uG, $uB, $bkg, $xLabelOffset);

?>
