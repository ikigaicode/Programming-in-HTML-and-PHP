<?php
  echo "The elevator problem... <br />";

  $limit = 500;

  echo "maximum weight = " .$limit. " pounds <br />";
    $totalWeight = 0;
    $maxWeight = 500;

  do {
    $newWeight = rand (0, $maxWeight);
    if (($totalWeight + $newWeight) <= $limit) {
      $totalWeight += $newWeight;
      //$totalWeight += $newWeight;
      //$totalWeight = $totalWeight + $newWeight;
      echo "New weight = " .$newWeight. ",
            Total weight = " .$totalWeight. "<br />";
      $newWeight = 0;
    }
      else {
        echo "You weigh " .$newWeight. " pounds.
            I'm sorry, but you can't get on. <br />";
      }
  } while (($totalWeight + $newWeight) <= $limit);
 ?>
