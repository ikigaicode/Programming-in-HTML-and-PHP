<?php
  echo strcasecmp("Dave", "David")."<br />";
  echo strcasecmp("DAVID", "david")."<br />";
  echo strcmp("david", "DAVID")."<br />";
  echo strcmp("Dave", "David")."<br />";
  echo strcmp("DAVID", "david")."<br />";
  echo strcmp("david", "DAVID")."<br />";
  $len = min(strlen("Dave"), strlen("David"));
  echo strcasecmp ("Dave", "David", $len)."<br />";
  echo strcmp ("Dave", "David", 3). "<br />";
  echo stristr("David", 'v')."<br />";
  echo strpos("David", 'i')."<br />";
  echo strtolower("David")."<br />";
  echo strtoupper("David")."<br />";
  echo substr("David", 3)."<br />";
  echo substr_compare("Mississippi", "Missouri", 0, 5)."<br />";
  echo substr_count("Mississippi", "ss")."<br />";
?>
