<?php
  $a = array('david', 'apple', 'Xena', 'Sue');

  echo "Using for...loop <br />";
    for ($i=0; $1<sizeof($a); $i++)
      echo $a[$i] . '<br />';

  echo "Using implied keys with foreach...loop <br />";
    foreach ($a as $i => $x)
      echo 'a[' . $i . ']=' . $x . '<br />';

  echo "An array with keys starting at an integer other than 0 <br />";
    $negKey = array(-1 => 'BMW', 'Lexus', 'house');
    for ($i = -1; $i<2; $i++)
      echo $negKey[$i] . '<br />';

  echo "A keyed array with consecutive character keys... <br />";
    $stuff = array('a' => 'BMW', 'b' => 'Lexus', 'c' => 'house');
      for ($i='a'; $i<='c'; $i++)
        echo $stuff[$i] . '<br />';

 ?>
