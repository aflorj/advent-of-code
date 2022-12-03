<?php

$alphabet = range('a', 'z');

$total = 0;
$fullString = file_get_contents('./input.txt');
$rucksacks = preg_split("/\r\n|\n|\r/", $fullString);
foreach ($rucksacks as $rucksack) {
  $itemsInRucksack = str_split($rucksack);
  $length = count($itemsInRucksack);
  $left = array_slice($itemsInRucksack, 0, $length / 2);
  $right = array_slice($itemsInRucksack, $length / 2);
  $commonItems = array_values(array_intersect($left, $right));
  $commonItem = $commonItems[0];

  if (in_array($commonItem, $alphabet)) {
    $total += array_search($commonItem, $alphabet) + 1;
  } else {
    $total += array_search(strtolower($commonItem), $alphabet) + 27;
  }
}
echo 'total: ' . $total;
?>
