<?php
  function drawLine($symbol, $line, $X, $Y1, $Y2, $Y3, $c1, $c2, $c3, $n_Ydata,
                    $xMin, $xMax, $yMin, $yMax, $xLabels, $yLabels, $ChartTitle,
                    $xPixelRange, $yPixelRange, $xTitle, $yTitle, $bkgrd,
                    $xCanvas, $yCanvas, $x0) {

  Header ("Content-type: image/gif");

  $y0 = 50; // (x0,y0) from lower left of canvas

  $ChartTitleYoffset = 25;
  $xTitleYoffset = 25;

  $im = imageCreate ($xCanvas, $yCanvas) or die ("Cannot Initialize new GD image stream");
  $background_color = ImageColorAllocate($im, $bkgrd [0], $bkgrd [1], $bkgrd [2]);
  $black = ImageColorAllocate($im, 0, 0, 0);
  $color1 = ImageColorAllocate($im, $c1 [0], $c1 [1], $c1 [2]);
  $color2 = ImageColorAllocate($im, $c2 [0], $c2 [1], $c2 [2]);
  $color3 = ImageColorAllocate($im, $c3 [0], $c3 [1], $c3 [2]);

  // define a black and transparent dashed line for grid lines
  $style = array($black, $black, $black, $black, $black,
            IMG_COLOR_TRANSPARENT,IMG_COLOR_TRANSPARENT,
            IMG_COLOR_TRANSPARENT,IMG_COLOR_TRANSPARENT,
            IMG_COLOR_TRANSPARENT);
  ImageSetStyle($im, $style);
  ImageSetThickness($im, 1);

  // draw xTitle
  $xTitleXoffset = 0;
  $xTitleXoffset = $xPixelRange / 2 - strlen(trim($xTitle)) / 2 * 9;
  ImageString($im, 5, $x0 + $xTitleXoffset, $yCanvas - $y0 + $xTitleYoffset,
              trim($xTitle), $black);

  // draw x labels and vertical axes
  $n_x = count($xLabels);
  $xGap = $xPixelRange / ($n_x - 1);
  for ($i=0; $i<$n_x; $i++) {
    ImageString($im, 5, $x0 + $i * $xGap, $yCanvas - $y0 + 5, trim($xLabels [$i]), $black);
    ImageLine($im, $x0 + $i * $xGap, $yCanvas - $y0, $x0 + $i * $xGap,
              $yCanvas - $y0 - $yPixelRange, $black);
  }

  // draw y labels
  $offset = 5 + strlen(trim($yLabels [0])) * 9;
  $n_y = count($yLabels);
  $yGap = $yPixelRange / ($n_y - 1);
  for ($i=0; $i<$n_y; $i++) {
    ImageString($im, 5, $x0 - $offset, $yCanvas - $y0 - $i * $yGap - 8,
                trim($yLabels[$i]), $black);
    ImageLine($im, $x0, $yCanvas - $y0 - $i * $yGap, $x0 + $xPixelRange,
              $yCanvas - $y0 - $i * $yGap, IMG_COLOR_STYLED);
  }

  // draw yTitle
  $off = ($n_y - 1) * $yGap / 2 - strlen(trim($yTitle)) / 2 * 9;
  ImageStringUp($im, 5, $x0 - $offset - 25, $yCanvas - $y0 - $off,
                trim($yTitle), $black);

  // draw data
  $x1 = ($X [0] - $xMin) / ($xMax - $xMin) * $xPixelRange;
  $y1_1 = ($Y1 [0] - $yMin) / ($yMax - $yMin) * $yPixelRange;
  $y1_2 = ($Y2 [0] - $yMin) / ($yMax - $yMin) * $yPixelRange;
  $y1_3 = ($Y3 [0] - $yMin) / ($yMax - $yMin) * $yPixelRange;

  for ($i=1; $i<count($X); $i++) {
    $x2 = ($X [$i] - $xMin) / ($xMax - $xMin) * $xPixelRange;
    $y2_1 = ($Y1 [$i] - $yMin) / ($yMax - $yMin) * $yPixelRange;
    if ($line == 'Y') ImageLine($im, $x0 + $x1, $yCanvas - $y0 - $y1_1, $x0 + $x2,
        $yCanvas - $y0 - $y2_1, $color1);
    if ($symbol == 'Y') {
      drawSymbol($im, $x0 + $x1, $yCanvas - $y0 - $y1_1, $color1);
      drawSymbol($im, $x0 + $x2, $yCanvas - $y0 - $y2_1, $color1);
    } $y1_1 = $y2_1;
    if ($n_Ydata >= 2) {
      $y2_2 = ($Y2 [$i] - $yMin) / ($yMax - $yMin) * $yPixelRange;
      if ($line == 'Y') ImageLine($im, $x0 + $x1, $yCanvas- $y0 - $y1_2, $x0 + $x2,
                                  $yCanvas - $y0 - $y2_2, $color2);
      if ($symbol == 'Y') {
        drawSymbol($im, $x0 + $x1, $yCanvas - $y0 - $y1_2, $color2);
        drawSymbol($im, $x0 + $x2, $yCanvas - $y0 - $y2_2, $color2);
      } $y1_2 = $y2_2;
    }
      if ($n_Ydata == 3) {
        $y2_3 = ($Y3 [$i] - $yMin) / ($yMax - $yMin) * $yPixelRange;
        if ($line == 'Y') ImageLine($im, $x0 + $x1, $yCanvas - $y0 - $y1_3,
                                    $x0 + $x2, $yCanvas - $y0 - $y2_3, $color3);
        if ($symbol == 'Y') {
          drawSymbol($im, $x0 + $x1, $yCanvas - $y0 - $y1_3, $color3);
          drawSymbol($im, $x0 + $x2, $yCanvas - $y0 - $y2_3, $color3);
        } $y1_3 = $y2_3;
      } $x1 = $x2;
  }

  // draw graph space boundaries
  ImageSetThickness($im, 2);
  ImageLine($im, $x0, $yCanvas - $y0, $x0 + $xPixelRange, $yCanvas-$y0,$black);
  ImageLine($im, $x0, $yCanvas - $y0 - $yPixelRange, $x0 + $xPixelRange,
            $yCanvas - $y0 - $yPixelRange, $black);
  ImageLine($im, $x0 + $xPixelRange, $yCanvas - $y0, $x0 + $xPixelRange,
            $yCanvas - $y0 - $yPixelRange, $black);
  ImageLine($im, $x0, $yCanvas - $y0, $x0, $yCanvas - $y0 - $yPixelRange, $black);
  ImageString($im, 5, $x0, $yCanvas - $y0 - $yPixelRange - $ChartTitleYoffset,
              trim($ChartTitle), $black);
  ImageGIF($im);
  ImageDestroy($im); // draw image and release resources
}

  function drawSymbol($im, $x, $y, $color) {
    Imageline($im, $x - 5, $y - 5, $x + 5, $y + 5, $color);
    ImageLine($im, $x + 5, $y - 5, $x - 5, $y + 5, $color);
  }

//--------- MAIN PROGRAM ----------------

$fileName = $_POST["fileName"];
$in = fopen($fileName, "r");

$xLabels = array();
$yLabels = array();

$X = array();
$Y1 = array();
$Y2 = array();

$ChartTitle = fgets($in); // title
$xTitle = fgets($in); // x-axis label
$yTitle = fgets($in); // y-axis label

$s = fgets($in); // x value labels
$xLabels = explode(',', $s);
$s = fgets($in); // y value labels
$yLabels = explode(',', $s);

fscanf($in, "%f %f %f %f", $xMin, $xMax, $yMin, $yMax);
fscanf($in, "%u", $n_Ydata);
$i = -1;

while (!feof($in)) {
  $s = fgets($in);
  if (strlen($s) > 3) {
    $i++;
    if ($n_Ydata == 1) sscanf($s, "%f %f", $X [$i], $Y1 [$i]);
    elseif ($n_Ydata == 2) sscanf($s, "%f %f %f", $X [$i], $Y1 [$i], $Y2 [$i]);
    else sscanf($s, "%f %f %f %f", $X [$i], $Y1 [$i], $Y2 [$i], $Y3 [$i]);
  }
}
fclose($in);
$colorString = "225,225,225";
$bgcolor = explode(',', $colorString);

$xCanvas = 800;
$yCanvas = 500;

$x0 = 100;
$xPixelRange = $_POST ["xPixelRange"];
$yPixelRange = $_POST ["yPixelRange"];

$Y1Color = $_POST ["Y1Color"];
$Y2Color = $_POST ["Y2Color"];
$Y3Color = $_POST ["Y3Color"];

$color1 = chooseColor($Y1Color);
$color2 = chooseColor($Y2Color);
$color3 = chooseColor($Y3Color);

$symbols = $_POST ["symbols"];
$line = $_POST ["line"];
drawLine($symbols, $line, $X, $Y1, $Y2, $Y3, $color1, $color3, $color2, $n_Ydata,
        $xMin, $xMax, $yMin, $yMax, $xLabels, $yLabels, $ChartTitle, $xPixelRange,
        $yPixelRange, $xTitle, $yTitle, $bgcolor, $xCanvas, $yCanvas, $x0);

function chooseColor($c) {
  $color = array();
  switch ($c) {
    case "red":
      $color [0]=255; $color [1]=0; $color [2]=0; break;
    case "blue":
      $color [0]=0; $color [1]=0; $color [2]=255; break;
    case "green":
      $color[0]=0; $color[1]=255; $color [2]=0; break;
    case "black":
      $color [0]=0; $color [1]=0; $color [2]=0; break;
    case "grey":
      $color [0]=150; $color [1]=150; $color [2]=150; break;
    }
    return $color;
}
?>
