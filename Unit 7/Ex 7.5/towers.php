<?php
  $n = 4;
  echo "Towers of Hanoi moves for  " . $n . "rings. <br />";
  move ($n, 'A', 'C', 'B');
  function move($n, $start, $end, $intermediate){
    if ($n > 0) {
      move ($n-1, $start, $intermediate, $end);
      echo "Move ring " . $n . " from " . $start . " to " . $end . "<br />";
      move ($n-1, $intermediate, $end, $start);

    }
  }

?>
