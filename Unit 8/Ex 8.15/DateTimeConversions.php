<?php
  echo "seconds from 1/1/1970 to now: ";
  # converts time from 1/1/1970 (UNIX time stamp) to current.
  echo strtotime("now")."<br />";
  $date = date_create();
  echo date_format($date, "U = Y-m-d H:i:s"). "UTC <br />";
  $Dec10 = strtotime("10 December 2016");
  echo "December 10, 2016" .$Dec10. "<br />";
  $Dec11 = strtotime("11 December 2016");
  echo "December 11, 2016" .$Dec11. "<br />";
  echo "difference = " . ($Dec11 - $Dec10) . "seconds <br />";
  echo "one day from today: " .strtotime("+1 day"). "<br />";
  echo "one week, 2 days, 12 hours, 52 seconds from today: " .
    strtotime ("+1 week 2 days 4 hours 2 seconds"). "<br />";
  echo "next Monday: " .strtotime("next Thursday"). "<br />";
  echo "last Saturday: " .strtotime("last Monday"). "<br />";
?>
