<?php
$fullString = file_get_contents('./input.txt');
$moves = explode("\n", $fullString);

$allKnots = [];

for ($i = 0; $i < 10; $i++) {
  array_push($allKnots, [0, 0]);
}

$visitedPos = ['0,0'];

$mapOfMoves = [
  'R' => [1, 0],
  'U' => [0, 1],
  'L' => [-1, 0],
  'D' => [0, -1],
];

function areTouching($x1, $y1, $x2, $y2)
{
  if (abs($x1 - $x2) <= 1 && abs($y1 - $y2) <= 1) {
    return true;
  } else {
    return false;
  }
}

function updateLocation($x, $y)
{
  global $allKnots;

  $allKnots[0][0] += $x;
  $allKnots[0][1] += $y;

  for ($i = 1; $i < 10; $i++) {
    list($hx, $hy) = $allKnots[$i - 1];
    list($tx, $ty) = $allKnots[$i];

    if (!areTouching($hx, $hy, $tx, $ty)) {
      $tx += $hx === $tx ? 0 : ($hx - $tx) / abs($hx - $tx);
      $ty += $hy === $ty ? 0 : ($hy - $ty) / abs($hy - $ty);
    }

    $allKnots[$i] = [$tx, $ty];
  }
}

foreach ($moves as $move) {
  list($direction, $distance) = explode(' ', $move);
  list($dx, $dy) = $mapOfMoves[$direction];
  for ($i = 0; $i < $distance; $i++) {
    updateLocation($dx, $dy);
    array_push($visitedPos, $allKnots[9][0] . ',' . $allKnots[9][1]);
  }
}

echo count(array_unique($visitedPos));
?>
