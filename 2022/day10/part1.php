<?php
$fullString = file_get_contents('./input.txt');
$instructions = explode("\n", $fullString);

$x = 1;
$specialCycles = [20, 60, 100, 140, 180, 220];
$signalStrengthsAtSpecialCycles = [];
$cycle = 1;

function checkIfSpecial()
{
  global $x;
  global $specialCycles;
  global $signalStrengthsAtSpecialCycles;
  global $cycle;

  if (in_array($cycle, $specialCycles)) {
    array_push($signalStrengthsAtSpecialCycles, $x * $cycle);
  }
}

foreach ($instructions as $instruction) {
  if (str_starts_with('noop', $instruction)) {
    checkIfSpecial();
    $cycle++;
  } else {
    checkIfSpecial();
    $cycle++;
    checkIfSpecial();
    $cycle++;
    $x = $x + explode(' ', $instruction)[1];
  }
}

echo array_sum($signalStrengthsAtSpecialCycles);
?>
