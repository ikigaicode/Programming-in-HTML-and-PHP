<?php
  Header ("Content-type: image/gif");

  // Define default data
  $chartTitle = "Monthly temperature deviations from climate average";

  $xLabels = array("-2.0", "-1.5", "-1.0", "-0.5", "0.0", "0.5", "1.0", "1.5",
                   "2.0", "2.5", "3.0", "3.5");

  $x_MinValues = array(0, 0, -0.2, -2.0, 0, 0, -1.1, -.5, 0, 0, 0, 0);
  $x_MaxValues = array(1.3, 0.9, 0, 0, 1, 0, 0, 0, 0, .6, 3.2, .7, .3);

  $xvalue_max = 3.5;
  $xvalue_min = -2.0;

  // Agree with $labels.
  $yLabels = array("January", "February", "March", "April", "May", "June", "July",
                    "August", "September", "October", "November", "December");

  // number of x labels.
  $n_x = count($xLabels);
  // number of y labels.
  $n_y = count($yLabels);

  $max_YlabelLength = 0;
  for ($i=0; $i<$n_y; $i++){
    if (strlen($yLabels[ $i]) > $max_YlabelLength)
    $max_YlabelLength = strlen($yLabels[ $i]);
  }

  // Define image space.
  $x_max = 800;
  $y_max = 500;

  //Define graphing space and title /label positioning offsets are from (x0,y0),
  // x+, y-.

  //Start coordinates for graphing space.
  $x0 = 100;
  $y0 = 60;

  // Space between x-axis labels and horizontal bars
  $dx = 50;
  $dy = 30;

  // Title offsets from upper left hand corner.
  $x0_titleOffset = 0;
  $y0_titleOffset = 50;

  // X label offsets.
  $xlabel_Xoffset = 20;
  $xlabel_Yoffset = 20;

  // Y label offsets, x-, y+.
  // x-, y+
  $ylabel_Yoffset;

  // Calculate X offset based on length of 1st label, 9 pix/character.
  $ylabel_Xoffset = $max_YlabelLength * 9 + 5;

  // Define bar size and vertical position.
  // Bar height.
  $bar_height = 20;

  // Center bar in $dy space
  $bar_Yoffset = floor (($dy - $bar_height) / 2);

  // Create image space
  $im = imageCreate($x_max, $y_max) or die ("Cannot create new GD image.");

  $background_color = ImageColorAllocate($im, 225, 225, 225);

  //Define colors.
  $text_color = ImageColorAllocate($im, 0, 0, 0); //text color
  $line_color = ImageColorAllocate($im, 0, 0, 0); //line colors
  $horizontal_line_color = ImageColorAllocate($im, 200, 200, 200);
  $ImageSetThickness ($im, 1);

  // Bar colors.
  $negative = ImageColorAllocate($im, 0, 0, 225);
  $positive = ImageColorAllocate($im, 255, 150, 150);
  $neutral = ImageColorAllocate($im, 100, 100, 100);
  $title_font_size = 5; // large font for title.
  $title_color = ImageColorAllocate($im, 0, 0, 0); // Black title.

  // Outline graphing space top, left, right, bottom.
  ImageLine($im, $x0, $y0, $x0 + $dx * ($n_x - 1), $y0, $line_color);
  ImageLine($im, $x0, $y0, $x0, $y0 + $dy * ($n_y), $line_color);
  ImageLine($im, $x0 + $dx * ($n_x - 1), $y0, $x0 + $dx * ($n_x - 1),
            $y0 + $dy * ($n_y), $line_color);
  ImageLine($im, $x0, $y0 + $dy * ($n_y), $x0 + $dx * ($n_y), $line_color);

  // Draw chart title.
  ImageString($im, $title_font_size, $x0 + $x0_titleOffset, $y0 - $y0_titleOffset,
              $chartTitle, $title_color);

  // Draw Y labels and horizontal lines.
  for ($i=0; $i<$n_y; $i++){
    ImageString($im, $title_font_size, $x0 - $ylabel_Xoffset, $y0 + $dy * $i +
                $ylabel_Yoffset, $yLabels[$i], $text_color);
    if ($i>0) ImageLine($im, $x0, $y0 + $dy * $i, $x0 + ($n_x - 1) * $dy,
        $y0 + $dy * $i, $horizontal_line_color);
  }

  // Draw bars.
  $xRange = $xvalue_max - $xvalue_min;
  for ($i=0; $i<$n_y; $i++){
    $x1 = $x0 + $dx * ($n_x - 1) * ($x_Minvalues[$i] - $xvalue_min) / $xRange;
    $x2 = $x0 + $dx * ($n_x - 1) * (1 - ($xvalue_max - $x_MaxValues[$i]) / $xRange) ;
    
  }
?>
