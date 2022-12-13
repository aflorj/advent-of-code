<?php
$fullString = file_get_contents('./input.txt');
$instructions = explode("\n", $fullString);

$x = 1;
$cycle = 0;

$screenState = [];

function checkSpritePosition()
{
  global $x;
  global $cycle;
  global $screenState;

  if (abs($x - ($cycle % 40)) <= 1) {
    array_push($screenState, '$');
  } else {
    array_push($screenState, ' ');
  }
}

foreach ($instructions as $instruction) {
  if (str_starts_with('noop', $instruction)) {
    checkSpritePosition();
    $cycle++;
  } else {
    checkSpritePosition();
    $cycle++;
    checkSpritePosition();
    $cycle++;
    $x = $x + explode(' ', $instruction)[1];
  }
}

$fullOutput = str_split(implode($screenState), 40);
foreach ($fullOutput as $outputLine) {
  echo $outputLine . "\n";
}
?>
