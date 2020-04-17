<?php
  Header ("Content-type: image/gif");

  &TitleString = "Institute for Earth Science Research and Education";

  $x_max = 600;
  $y_max = 400;

  $x0 = 40;
  $y0 = 40;

  $im = ImageCreate($x_max, $y_max) or die ("Cannot Initialize new GD image stream");
  $background_color = ImageCollorAllocate($im, 200, 200, 200);

  // Define text color
  $navy = ImageColorAllocate($im, 0, 0, 150);
  $src = ImageCreateFromJPEG("IESRElogo.jpg");

  ImageCopy($im, $src, $x0, $y0, 0, 0, 126, 153);
  $y0 = 200;

  ImageCopy($im, $src, $x0, $y0, 50, 50, 126, 153);
  $y0 = 25;

  ImageTTFText($im, 18, 0, $x0, $y0, $navy, "timesbi.ttf", $TitleString);

  ImageGIF($im);
  ImagePNG($im, "displayImage.png");
  ImageDestroy($im);
?>
