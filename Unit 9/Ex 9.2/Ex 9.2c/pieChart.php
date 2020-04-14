<?php
  function
  generatePie($Title, $A, $legends, $x_max, $y_max, $x0, $y0, $legend_size,
              $dia, $xo_legend, $y0_legend){
                Header ("Content-type: image/gif");

                //$TitleString = "Pie Chart";

                //$A = array(60, 50, 40, 100, 50, 50, 75, 5, 10, 15, 20, 35);

                //$legends = array("Item1", "Item2", "Item3", "Item4", "Item5", "Item6", "Item7",
                //                 "Item8", "Item9", "Item10", "Item11", "Item12");

                // Dimensions of plotting space.
                //$x_max = 800;
                //$y_max = 500;

                // Center poiint for pie chart.
                //$x0 = 200;
                //$y0 = 250;

                // Diameter of pie.
                // $dia = 360;

                // Locates plot title.
                $x_title = 10;
                $y_title = 20;

                // Upper left hand corner of legend space.
                //$x0_legend = 400;
                //$y0_legend = 75;

                // Size of legend color boxes.
                //$legend_size = 25;

                // Vertical spac between legend color boxes.
                $dy_legend = $legend_size+5;

                // Create image space.
                $im = ImageCreate($x_max, $y_max) or die ("Cannot Initialize new GD image stream");

                // Define some colors.
                // $background_color creates background.
                $background_color = ImageColorAllocate ($im, 200, 200, 200);

                // First call fills background.
                $black = ImageColorAllocate($im, 0, 0, 0);

                // For drawing colors for up 12 sections.
                // Pie section colors for up to $n_max sections.
                $ColorCode = array("255, 0, 0", "51, 0, 255", "51, 255, 51", "255, 153, 0",
                                   "0, 204, 153", "204, 255, 102", "255, 102, 102",
                                   "102, 204, 255", "204, 153, 255", "255, 51, 153",
                                   "204, 0, 255", "255, 255, 51");

                //$n_max = count($ColorCode);
                $PieColor = array();
                for ($i=0; $i<12; $i++){
                  $ColorCodeSplit = explode(',', $ColorCode[ $i]);
                  $PieColor[ $i] = ImageColorAllocate($im,
                                    $ColorCodeSplit[0], $ColorCodeSplit[1],
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
                ImageString($im, 5, $x_title, $y_title, $Title, $black);

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
                  $legends[$i] = $legends[$i] ." (".number_format($A[$i], 1, ".", ",").")";
                  ImageString($im, 5, $x0_legend + $legend_size + 5, $y0_legend + $dy_legend * $i + 5,
                            $legends[$i], $black);
                }

                // Display and release allocated resources.
                ImageGIF($im);
                ImageDestroy($im);
              }

  // MAIN PROGRAM ------------------------------------
  $inFile = $_POST["fileName"];
  $x_max = $_POST["x_max"];
  $y_max = $_POST["y_max"];

  $x0 = $_POST["x0"];
  $y0 = $_POST["y0"];

  $dia = $_POST["dia"];

  $legend_size = $_POST["legend_size"];

  $x0_legend = $_POST["x0_legend"];
  $y0_legend = $_POST["y0_legend"];

  $in = fopen($inFile, "r") or exit ("Can't open this file.");

  $A = array();

  $legends = array();

  $Title = trim(fgets($in));

  $i = -1;

  while (!feof($in)){
    $line = fgets($in);
    if (strlen($line)>3){
      $i++;
      sscanf ($line, "%f %s", $A[$i], $legends[$i]);
      $A[$i] = round ($A[$i], 0);
    }
  }

  fclose($in);
  generatePie($Title, $A, $legends, $x_max, $y_max, $x0, $y0, $legend_size,
              $dia, $x0_legend, $y_legend);
?>
