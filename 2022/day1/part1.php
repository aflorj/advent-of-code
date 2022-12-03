<?php
$fullString = file_get_contents('./input.txt');
$elfCals = preg_split("#\n\s*\n#Uis", $fullString);
$highest = 0;

foreach ($elfCals as $singleElfCals) {
  $elfTotal = 0;
  $foodCals = preg_split('/\R/', $singleElfCals);
  foreach ($foodCals as $food) {
    $elfTotal += intval($food);
  }
  if ($elfTotal > $highest) {
    $highest = $elfTotal;
  }
}
echo $highest;

?>
