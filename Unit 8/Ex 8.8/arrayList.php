<?php
  $stuff = array('I', 'Love', 'PHP.');
  list ($who, $do_what, $to_what) = $stuff;
  echo "$who $do_what $to_what". "<br />";
  list ($who,,$to_what) = $stuff;
  echo "$who $to_what <br />";
  $a = array('david', 'apple', 'Xena', 'Sue');
  $b = array();
  list ($b[0], $b[1], $b[2], $b[3]) = $a;
  var_dump ($b);
  echo "<br /> Access with for...loop.<br />";
  for ($i=0; $i<count($b); $i++) echo $b[ $i] . "<br />";
  echo "Access with foreach...loop.<br />";
  foreach ($b as $key => $x) echo "a[" .$key. "]=" .$x. "<br />";
?>
