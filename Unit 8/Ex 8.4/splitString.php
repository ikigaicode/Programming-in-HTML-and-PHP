<?php
  $str ="x x Mississippi x x";
  echo ltrim($str, "x ")."<br />";
  echo rtrim($str, "x ")."<br />";
  echo trim($str, "x ")."<br />";
  $A = array();
  $A = explode(' ', $str);
  var_dump ($A);
?>
