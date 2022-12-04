<?php
$overlaps = 0;
$fullString = file_get_contents('./input.txt');
$elfPairs = preg_split("/\r\n|\n|\r/", $fullString);

foreach ($elfPairs as $elfPair) {
  $sections = explode(',', $elfPair);
  $elfOneEdges = explode('-', $sections[0]);
  $elfTwoEdges = explode('-', $sections[1]);
  $elfOneRange = range($elfOneEdges[0], $elfOneEdges[1]);
  $elfTwoRange = range($elfTwoEdges[0], $elfTwoEdges[1]);

  $commonRange = array_intersect($elfOneRange, $elfTwoRange);
  if ($commonRange) {
    $overlaps++;
  }
}
echo 'no. of overlaping cases: ' . $overlaps;
?>
