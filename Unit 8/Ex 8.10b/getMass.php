<?php
  print_r($_POST);
  //exit;
  $material = $_POST["material"];
  $shape = $_POST["shapes"];
  // exit;
  $L = $_POST["L"];
  $W = $_POST["W"];
  $H = $_POST["H"];
  $R = $_POST["R"];
  echo "<br />" .$material. ", " .$shape. "<br />";
  $materialFile = fopen("density.dat", "r");
  $shapeFile = fopen("volume.dat", "r");
  // Read materials file.
  $found = false;
  $line = fgets ($materialFile);
  while ((!feof($materialFile)) && (!$found)){
    $values = fscanf ($materialFile, "%s %f", $m, $d);
    if (strcasecmp($material, $m) == 0){
      echo "density = " .$d. "kg/m^3 <br />";
      $found = true;
    }
  }
  // Read volume file.
  $found = false;
  $line = fgets($shapeFile);
  while ((!feof($shapeFile)) && (!$found)){
    $values = fscanf($shapeFile, "%s %s", $s, $v);
    if (strcasecmp($shape, $s) == 0){
      echo $shape . ", " .$v. "<br />";
      $found = true;
    }
  }
  fclose ($materialFile);
  fclose ($shapeFile);
  $vv = $v . "*$d";
  echo $vv . "<br />";
  echo "Mass = " .eval("return round ($vv, 3);") . "kg <br />";
?>
