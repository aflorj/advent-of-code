<?php

$alphabet = range('a', 'z');

$total = 0;
$fullString = file_get_contents('./input.txt');
$rucksacks = preg_split("/\r\n|\n|\r/", $fullString);
for ($i = 0; $i + 2 < count($rucksacks); $i = $i + 3) {
  $commonItems = array_values(
    array_intersect(
      str_split($rucksacks[$i]),
      str_split($rucksacks[$i + 1]),
      str_split($rucksacks[$i + 2])
    )
  );
  $commonItem = $commonItems[0];
  if (in_array($commonItem, $alphabet)) {
    $total += array_search($commonItem, $alphabet) + 1;
  } else {
    $total += array_search(strtolower($commonItem), $alphabet) + 27;
  }
}
echo 'total: ' . $total;
?>
