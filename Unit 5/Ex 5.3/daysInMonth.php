<?php
  $month = 5; // Try different values.

  switch ($month) {
    case 1:
    case 3:
    case 5:
    case 7:
    case 8:
    case 10:
    case 12:
      echo "There are 31 days in this month. <br />";
      break;
    case 4:
    case 6:
    case 9:
    case 11:
      echo "There are 30 days in this month. <br />";
      break;
    case 2:
      echo "There are 28 or 29 days in this month. <br />";
      break;
    default:
      echo "I do not understand your month entry.";
  }
 ?>
