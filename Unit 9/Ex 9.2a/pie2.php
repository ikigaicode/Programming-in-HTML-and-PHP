<?php
  Header ("Content-type: image/gif");

  $TitleString = "Pie Chart";

  $A = array(60, 50, 40, 100, 50, 50, 75, 5, 10, 15, 20, 35);

  $legends = array("Item1", "Item2", "Item3", "Item4", "Item5", "Item6", "Item7",
                   "Item8", "Item9", "Item10", "Item11", "Item12");

  // Dimensions of plotting space.
  $x_max = 800;
  $y_max = 500;

  // Center poiint for pie chart.
  $x0 = 200;
  $y0 = 250;

  // Diameter of pie.
  $dia = 360;

  // Starting point for title.
  $x_title = 40;
  $y_title = 40.0;

  // Upper left hand corner of legend space.
  $x0_legend = 400;
  $y0_legend = 75;

  // Size of legend color boxes.
  $legend_size = 25;

  // Vertical spac between legend color boxes.
  $dy_legend = $legend_size+5;

  // Create image space.
  $im = ImageCreate($x_max, $y_max) or die ("Cannot Initialize new GD image stream");

  // Define colors.
  $background_color = ImageColorAllocate ($im, 234, 234, 234);

  // First call filss background.
  $black = ImageColorAllocate($im, 0, 0, 0);

  // Pie section colors for up to $n_max sections.
  $ColorCode = array("255, 0, 0", "51, 0, 255", "51, 255, 51", "255, 153, 0",
                     "0, 204, 153", "204, 255, 102", "255, 102, 102",
                     "102, 204, 255", "204, 153, 255", "255, 51, 153",
                     "204, 0, 255", "255, 255, 51");

$n_max = count($ColorCode);
$PieColor = array();
for ($i=0; $i<$n_max; $i++){
  $ColorCodeSplit = explode(', ', $ColorCode[ $i]);
  $PieColor[ $i] = ImageColorAllocate($im, $ColorCodeSplit[0], $ColorCodeSplit[1],
                                      $ColorCodeSplit[2]);
}

// Convert data array into angles, total of 360 deg.
$sum = array_sum($A);
$n = count($A);
$start = array();
$end = array();
$start[ 0] = 0;
for ($i=0; $i<$n; $i++){
  $slice = $A[ $i] / $sum*360;
  if ($i>0) $start[ $i] = $end[ $i-1];
  $end [ $i] = $start[ $i] + $slice;
}

// Display title.
ImageString($im, 5, $x_title, $y_title, $TitleString, $black);

// Draw filled arcs
for ($i=0; $i<$n; $i++){
  ImageFilledArc($im, $x0, $y0, $dia, $dia, $start[ $i], $end[ $i], $PieColor[$i],
                 IMG_ARC_PIE);
}

// Display legend.
for ($i=0; $i<$n; $i++){
  ImageFilledRectangle($im, $x0_legend, $y0_legend + $dy_legend * $i,
                       $x0_legend + $legend_size, $y0_legend + $dy_legend * $i +
                       $legend_size, $PieColor[$i]);
  ImageString($im, 5, $x0_legend + $legend_size + 5, $y0_legend + $dy_legend * $i + 5,
              $legends[$i], $black);
}

// Display and release allocated resources.
ImageGIF($im);
ImageDestroy($im);
?>
