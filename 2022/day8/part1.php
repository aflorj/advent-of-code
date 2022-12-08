<?php
$fullString = file_get_contents('./input.txt');
$horizontalTreeLines = preg_split("/\n/", $fullString);
$mappedOutTrees = [];

foreach ($horizontalTreeLines as $horizontalTreeLine) {
  array_push($mappedOutTrees, str_split($horizontalTreeLine));
}

$visibleTrees = 0;

function checkVisibility($x, $y)
{
  global $mappedOutTrees;
  $treeToCheckHeight = $mappedOutTrees[$x][$y];

  if (checkNorth($x, $y, $treeToCheckHeight)) {
    return true;
  } elseif (checkEast($x, $y, $treeToCheckHeight)) {
    return true;
  } elseif (checkSouth($x, $y, $treeToCheckHeight)) {
    return true;
  } elseif (checkWest($x, $y, $treeToCheckHeight)) {
    return true;
  } else {
    return false;
  }
}

function checkNorth($x, $y, $treeToCheckHeight)
{
  global $mappedOutTrees;
  $treesToCompareAgainst = [];
  for ($i = 0; $i < $x; $i++) {
    if ($mappedOutTrees[$i][$y] >= $treeToCheckHeight) {
      return false;
    }
  }
  return true;
}

function checkEast($x, $y, $treeToCheckHeight)
{
  global $mappedOutTrees;

  for ($i = $y + 1; $i < count($mappedOutTrees[$x]); $i++) {
    if ($mappedOutTrees[$x][$i] >= $treeToCheckHeight) {
      return false;
    }
  }
  return true;
}

function checkSouth($x, $y, $treeToCheckHeight)
{
  global $mappedOutTrees;
  for ($i = $x + 1; $i <= count($mappedOutTrees) - 1; $i++) {
    if ($mappedOutTrees[$i][$y] >= $treeToCheckHeight) {
      return false;
    }
  }
  return true;
}

function checkWest($x, $y, $treeToCheckHeight)
{
  global $mappedOutTrees;
  for ($i = 0; $i < $y; $i++) {
    if ($mappedOutTrees[$x][$i] >= $treeToCheckHeight) {
      return false;
    }
  }
  return true;
}

foreach ($horizontalTreeLines as $horizontalIndex => $horizontalTreeLine) {
  $verticalTreeLines = str_split($horizontalTreeLine);
  foreach ($verticalTreeLines as $verticalIndex => $veritalTreeLine) {
    if (
      $horizontalIndex === 0 ||
      $horizontalIndex === count($horizontalTreeLines) - 1 ||
      $verticalIndex === 0 ||
      $verticalIndex === count($verticalTreeLines) - 1 ||
      checkVisibility($horizontalIndex, $verticalIndex)
    ) {
      $visibleTrees++;
    }
  }
}

echo $visibleTrees;

?>
