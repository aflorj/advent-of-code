<?php
$fullString = file_get_contents('./input.txt');
$moves = explode("\n", $fullString);

list($hx, $hy) = [0, 0];
list($tx, $ty) = [0, 0];
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
  global $hx;
  global $hy;
  global $tx;
  global $ty;

  $hx += $x;
  $hy += $y;

  if (!areTouching($hx, $hy, $tx, $ty)) {
    $tx += $hx === $tx ? 0 : ($hx - $tx) / abs($hx - $tx);
    $ty += $hy === $ty ? 0 : ($hy - $ty) / abs($hy - $ty);
  }
}

foreach ($moves as $move) {
  list($direction, $distance) = explode(' ', $move);
  list($dx, $dy) = $mapOfMoves[$direction];
  for ($i = 0; $i < $distance; $i++) {
    updateLocation($dx, $dy);
    array_push($visitedPos, $tx . ',' . $ty);
  }
}

echo count(array_unique($visitedPos));
?>
