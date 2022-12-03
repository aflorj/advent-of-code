<?php
$fullString = file_get_contents('./input2.txt');
$elfCals = preg_split("#\n\s*\n#Uis", $fullString);
$allTotals = [];

foreach ($elfCals as $singleElfCals) {
  $elfTotal = 0;
  $foodCals = preg_split('/\R/', $singleElfCals);
  foreach ($foodCals as $food) {
    $elfTotal += intval($food);
  }
  array_push($allTotals, $elfTotal);
}
rsort($allTotals);
$top3 = $allTotals[0] + $allTotals[1] + $allTotals[2];
echo $top3;

?>
