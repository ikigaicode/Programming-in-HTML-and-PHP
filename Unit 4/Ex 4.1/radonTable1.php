<?php
//Transfer the values.
$site1=$_POST["site1"] ;
$site2=$_POST["site2"] ;
$site3=$_POST["site3"] ;
$site4=$_POST["site4"] ;

$site1_name=$_POST["site1_name"];
$site2_name=$_POST["site2_name"];
$site3_name=$_POST["site3_name"];
$site4_name=$_POST["site4_name"];

//Select colors for a color-coded table.

$bg1=pickColor($site1);
$bg2=pickColor($site2);
$bg3=pickColor($site3);
$bg4=pickColor($site4);

echo "<h1>Results of Radon testing</h1><p>";
echo "The table below shows some Radon levels measured in residences. <br />";
echo "For values greater than or equal to 4pCi/L, action should be taken <br />";
echo "to reduce the concentration of Radon gas. For values greater than or <br />";
echo "equal to 3pCi/L, retesting is recommended. </p>";

//Create the color-coded table.

echo "<table border><tr><th> Site name </th></tr>";
echo "<tr bgcolor=$bg1><td>$site1_name</td><td>$site1</td></tr>";
echo "<tr bgcolor=$bg2><td>$site2_name</td><td>$site2</td></tr>";
echo "<tr bgcolor=$bg3><td>$site3_name</td><td>$site3</td></tr>";
echo "<tr bgcolor=$bg3><td>$site4_name</td><td>$site4</td></tr>""</table>";

function pickColor($value) {
  if ($value>=4) $bg="pink";
  elseif ($value>=3) $bg="yellow";
  else $bg="lightgreen";
  return $bg;
}



 ?>
