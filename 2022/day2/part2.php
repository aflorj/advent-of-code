<?php

function battle($opponent, $us)
{
  if ($opponent === 'A') {
    if ($us === 'X') {
      return 3;
    } elseif ($us === 'Y') {
      return 4;
    } elseif ($us === 'Z') {
      return 8;
    }
  } elseif ($opponent === 'B') {
    if ($us === 'X') {
      return 1;
    } elseif ($us === 'Y') {
      return 5;
    } elseif ($us === 'Z') {
      return 9;
    }
  } elseif ($opponent === 'C') {
    if ($us === 'X') {
      return 2;
    } elseif ($us === 'Y') {
      return 6;
    } elseif ($us === 'Z') {
      return 7;
    }
  }
}

$totalPts = 0;
$fullString = file_get_contents('./input.txt');
$showdowns = preg_split("/\r\n|\n|\r/", $fullString);
foreach ($showdowns as $showdown) {
  $movesInShowdown = explode(' ', $showdown);
  $totalPts += battle($movesInShowdown[0], $movesInShowdown[1]);
}
echo 'TOTAL: ' . $totalPts;
?>
