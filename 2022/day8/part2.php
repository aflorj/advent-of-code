<?php
$fullString = file_get_contents('./input.txt');
$horizontalTreeLines = preg_split("/\n/", $fullString);
$mappedOutTrees = [];

foreach ($horizontalTreeLines as $horizontalTreeLine) {
  array_push($mappedOutTrees, str_split($horizontalTreeLine));
}

$highestVisibilityScore = 0;

function findVisibilityScore($x, $y)
{
  global $mappedOutTrees;
  global $highestVisibilityScore;
  $treeToCheckHeight = $mappedOutTrees[$x][$y];

  $visibilityScore =
    checkNorth($x, $y, $treeToCheckHeight) *
    checkEast($x, $y, $treeToCheckHeight) *
    checkSouth($x, $y, $treeToCheckHeight) *
    checkWest($x, $y, $treeToCheckHeight);
  if ($visibilityScore > $highestVisibilityScore) {
    $highestVisibilityScore = $visibilityScore;
  }
}

function checkNorth($x, $y, $treeToCheckHeight)
{
  global $mappedOutTrees;
  $viewingDistance = 0;
  for ($i = $x - 1; $i >= 0; $i--) {
    if ($mappedOutTrees[$i][$y] < $treeToCheckHeight) {
      $viewingDistance++;
    } elseif ($mappedOutTrees[$i][$y] >= $treeToCheckHeight) {
      $viewingDistance++;
      return $viewingDistance;
    }
  }
  return $viewingDistance;
}

function checkEast($x, $y, $treeToCheckHeight)
{
  global $mappedOutTrees;
  $viewingDistance = 0;
  for ($i = $y + 1; $i < count($mappedOutTrees[$x]); $i++) {
    if ($mappedOutTrees[$x][$i] < $treeToCheckHeight) {
      $viewingDistance++;
    } elseif ($mappedOutTrees[$x][$i] >= $treeToCheckHeight) {
      $viewingDistance++;
      return $viewingDistance;
    }
  }
  return $viewingDistance;
}

function checkSouth($x, $y, $treeToCheckHeight)
{
  global $mappedOutTrees;
  $viewingDistance = 0;
  for ($i = $x + 1; $i <= count($mappedOutTrees) - 1; $i++) {
    if ($mappedOutTrees[$i][$y] < $treeToCheckHeight) {
      $viewingDistance++;
    } elseif ($mappedOutTrees[$i][$y] >= $treeToCheckHeight) {
      $viewingDistance++;
      return $viewingDistance;
    }
  }
  return $viewingDistance;
}

function checkWest($x, $y, $treeToCheckHeight)
{
  global $mappedOutTrees;
  $viewingDistance = 0;
  for ($i = $y - 1; $i >= 0; $i--) {
    if ($mappedOutTrees[$x][$i] < $treeToCheckHeight) {
      $viewingDistance++;
    } elseif ($mappedOutTrees[$x][$i] >= $treeToCheckHeight) {
      $viewingDistance++;
      return $viewingDistance;
    }
  }
  return $viewingDistance;
}

foreach ($horizontalTreeLines as $horizontalIndex => $horizontalTreeLine) {
  $verticalTreeLines = str_split($horizontalTreeLine);
  foreach ($verticalTreeLines as $verticalIndex => $veritalTreeLine) {
    if (
      $horizontalIndex === 0 ||
      $horizontalIndex === count($horizontalTreeLines) - 1 ||
      $verticalIndex === 0 ||
      $verticalIndex === count($verticalTreeLines) - 1
    ) {
      // echo 'begone, thot! ';
    } else {
      findVisibilityScore($horizontalIndex, $verticalIndex);
    }
  }
}

echo $highestVisibilityScore;

?>
