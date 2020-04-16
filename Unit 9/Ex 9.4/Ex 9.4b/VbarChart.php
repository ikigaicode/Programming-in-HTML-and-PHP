<?php
  function drawVbar($Y_lo, $Y_hi, $yMin, $yMax,$barWidth,$barColor, $xTitle,
                    $yTitle, $xLabels, $yLabels, $ChartTitle,$xCanvas, $yCanvas,
                    $bgcolor, $n_x, $n_y, $xGap, $yGap, $x0){

  Header ("Content-type: image/gif");

  // some constant values
  $y0 = 50; // (x0,y0) from lower left of canvas
  $ChartTitleYoffset = 25;
  $xTitleYoffset = 25;

  // some calculated values
  $xTitleXoffset= $n_x * $xGap / 2 - strlen($xTitle) / 2 * 9;
  $im = imageCreate ($xCanvas, $yCanvas) or die ("Cannot Initialize new GD image stream");
  $background_color = ImageColorAllocate($im, $bgcolor [0], $bgcolor [1], $bgcolor [2]);
  $black = ImageColorAllocate($im, 0, 0, 0);
  $red = ImageColorAllocate($im, 255, 0, 0);
  $green = ImageColorAllocate($im, 0, 255, 0);
  $blue = ImageColorAllocate($im, 0, 0, 255);
  $grey = ImageColorAllocate($im, 150, 150, 150);

  // define a black and transparent dashed line for grid lines
  $style = array($black, $black, $black, $black, $black, IMG_COLOR_TRANSPARENT,
                  IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT,
                  IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
  ImageSetStyle($im, $style);

  // Outline graph space
  ImageSetThickness($im, 2);
  ImageLine($im, $x0, $yCanvas - $y0, $x0 + ($n_x) * $xGap, $yCanvas - $y0, $black);
  ImageLine($im, $x0, $yCanvas - $y0 - ($n_y - 1) * $yGap, $x0 + ($n_x) * $xGap,
            $yCanvas - $y0 - ($n_y-1) * $yGap, $black);
  ImageLine($im, $x0, $yCanvas - $y0, $x0, $yCanvas - $y0 - ($n_y - 1) * $yGap, $black);
  ImageLine($im, $x0 + ($n_x) * $xGap, $yCanvas - $y0, $x0 + ($n_x) * $xGap,
            $yCanvas - $y0 - ($n_y - 1) * $yGap, $black);
  ImageString($im, 5, $x0, $yCanvas - $y0 - ($n_y - 1) * $yGap - $ChartTitleYoffset,
              trim($ChartTitle), $black);

  // draw xTitle
  ImageString($im, 5, $x0 + $xTitleXoffset, $yCanvas - $y0 + $xTitleYoffset,
              trim($xTitle), $black);
  ImageSetThickness($im, 1);

  // draw y labels
  $offset = 5 + strlen($yLabels [0]) * 9;
  for ($i=0; $i<$n_y; $i++) {
    ImageString($im, 5, $x0 - $offset, $yCanvas - $y0 - $i * $yGap - 8,
                $yLabels [$i], $black);
    ImageLine($im, $x0, $yCanvas - $y0 - $i * $yGap, $x0 + $n_x * $xGap,
              $yCanvas - $y0 - $i * $yGap, IMG_COLOR_STYLED);
  }

  // draw yTitle
  $off = ($n_y - 1) * $yGap / 2 - strlen($yTitle) / 2 * 9;
  ImageStringUp($im, 5, $x0 - $offset - 25, $yCanvas - $y0 - $off, trim($yTitle), $black);

  // draw x labels and vertical axes
  for ($i=0; $i<$n_x; $i++) {
    $off = $xGap / 2 - strlen($xLabels [$i]) / 2 * 9;
    ImageString($im, 5, $x0 + $i * $xGap + $off, $yCanvas - $y0 + 5, $xLabels [$i],$black);
    ImageLine($im, $x0 + $i * $xGap, $yCanvas - $y0, $x0 + $i * $xGap,
              $yCanvas - $y0 - ($n_y - 1) * $yGap, $black);
  }

  // draw bars
  $off = $barWidth / 100 * $xGap / 2;
  $yDataRange = $yMax - $yMin;
  $yAxisRange = ($n_y - 1) * $yGap;
  for ($i=0; $i<$n_x; $i++) {
  // scaling Y-values...
    $y1 = ($Y_lo [$i] - $yMin) / $yDataRange * $yAxisRange;
    $y2 = ($yMax - $Y_hi [$i]) / $yDataRange * $yAxisRange;
    ImageFilledRectangle($im, $x0 + $i * $xGap + $xGap / 2 - $off,
                         $yCanvas - $y0 - $y1, $x0 + $i * $xGap + $xGap / 2 + $off,
                         $yCanvas - $y0 + $y2 - ($n_y - 1) * $yGap, $red);
  }

  // Release allocated resources.
  ImageGIF($im);
  ImageDestroy($im);
  }

  //--------- MAIN PROGRAM ----------------
  $fileName = $_POST["fileName"];
  //$fileName="Vbar.dat";
  $in = fopen($fileName, "r");
  $xLabels = array();
  $Y_lo = array();
  $Y_hi = array();
  $ChartTitle = fgets($in);
  $xTitle = fgets($in);
  $yTitle = fgets($in);
  $s = fgets($in);
  $yLabels = explode(',', $s);
  fscanf($in, "%f %f", $xMin, $xMax);
  $i = -1;
  while (!feof($in)) {
    $s = fgets($in);
    if (strlen($s)>3) {
      $i++;
    sscanf($s, "%s %f %f", $xLabels [$i], $Y_lo [$i], $Y_hi [$i]);
    }
  }
  $n_x = $i + 1;
  $n_y = count($yLabels);
  fclose($in);

  // from HTML, values to pass to PHP
  $xCanvas = 700;
  $yCanvas = 400;

  $xRange = 450;
  $yRange = 300;

  $colorString = "225,225,225"; // background color

  $barWidth = 80; // % of xGap
  $barColor = "red";
  $yMin = -3;
  $yMax = 3.5;
  $x0 = 100; // + offset from lower left corner
  // calculated values to pass to PHP

  $maxYlabelLength = 0;
  for ($i=0; $i<$n_y; $i++) {
    $yLabels [$i] = trim($yLabels [$i]);
    if (strlen($yLabels [$i]) > $maxYlabelLength)
  $maxYlabelLength = strlen($yLabels [$i]);
  }

  // left-pad labels with spaces, as needed.
  // Don't trim() them again!
  for ($i=0; $i<$n_y; $i++) {
    while (strlen($yLabels [$i]) < $maxYlabelLength)
  $yLabels [$i] = ' '.$yLabels [$i];
  }

  $xGap = floor($xRange / $n_x);
  $yGap = floor($yRange / $n_y);
  $bkgrdColor = explode(',', $colorString);
  drawVbar($Y_lo, $Y_hi, $yMin, $yMax, $barWidth, $barColor, $xTitle, $yTitle,
           $xLabels, $yLabels, $ChartTitle, $xCanvas, $yCanvas, $bkgrdColor,
           $n_x, $n_y, $xGap, $yGap, $x0);
?>
