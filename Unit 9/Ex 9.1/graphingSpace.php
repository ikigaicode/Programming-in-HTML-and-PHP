<?php
  Header ("Content-type: image/gif");

  //define title.
  $TitleString = "Chart Title";
  // dimensions of plotting space.
  $x_max = 300;
  $y_max = 200;
  // starting point for title.
  $x_title = 10;
  $y_title = 30;
  //  (0, 0) for axes.
  $x0 = 40;
  $y0 = 170;
  // axis lengths.
  $x_length = 180;
  $y_length = 120;

  // create image space.
  $im = ImageCreate($x_max, $y_max) or die ("Cannot Initialize new GD image stream");
  // define colors -- first call fills background.
  $background_color = ImageColorAllocate ($im, 200, 200, 200);
  // define text color.
  $black = ImageColorAllocate($im, 0, 0, 0);

  // display text
  ImageString($im, 5, 0, 0, "(0, 0)", $black);
  ImageString($im, 5, $x_title, $y_title, $TitleString, $black);
  ImageString($im, 5, $x_max-90, $y_max-16, "(300, 200)", $black);

  // draw x-y axis.
  ImageSetThickness($im, 2);
  ImageLine($im, $x0, $y0, $x0 + $x_length, $y0, $black);
  ImageLine($im, $x0, $y0, $x0, $y0 - $y_length, $black);

  // display image.
  ImageGIF($im);
  // release resources.
  ImageDestroy($im);
?>
