<?php
    // Generate data array for testing.
    $a=[]; $n = 10; $n_boxes=10;
    $low=-100; $high=100; $range=$high-$low;
    for ($i=0; $i<$n; $i++) $a[$i]=rand($low, $high);
    // for ($i=0; $i<$n; $i++) $a[$i]=rand($low, $high);
    // Test some data values to make sure they're
    // boxed properly.
    $a[0]=110;

    // Create histogramarray.
    $h=[]; $h[0]=$n; // Use $h[0] to hold # of data points.
    for ($i=1; $i<=$n_boxes; $i++){
       $h[$i]=0;
     }
    $dn=$range / $n_boxes;
    $out=0; // # of boxes outside of histogram range.

    //Fill histogram boxes.
    for ($i=0; $i<sizeof($a); $i++){
      if (($a[$i]>$high) || $a[$i]<$low) {
        $out++
      }
      else {
        if ($a[$i] == $high) {
          $box_num=$n_boxes;
        }
        else {
          $box_num=floor (($a[$i] - $low) / $dn) + 1;
          $h[$box_num]++;
          echo $a[$i] . " " . $box_num . "<br />";
        }
      }
    }

    echo "Total # of data points: " . $h[0] . "<br />";
    echo "Total # of points outside of range: " . $out . "<br />";
    echo "Histogram counts: <br />" ;

    for ($i=1; $i<=$n_boxes; $i++) {
      echo $i . " " . $h[$i] .  "<br />";
    }



?>
