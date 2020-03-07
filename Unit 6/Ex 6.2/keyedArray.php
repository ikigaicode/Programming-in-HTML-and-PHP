<?php
  // Create an array with user-specified keys...
  echo ´<br />A keyed array:<br />´;

  $stuff = array(´mine´ => ´BMW´, ´yours´ => ´Lexus´, ´ours´ => ´house´);
  foreach ($stuff as $key => $val) {
    echo ´$stuff[´ . $key . ´]=´ .$val . ´<br />´;// code...
  }

 ?>
