<?php
$fullString = file_get_contents('./test_input.txt');
$grid = [];
$start = [];
$end = [];
// $alreadyVisited = [];
$alphabet = range('a', 'z');
// $numberOfMoves = 0;

$lines = explode("\n", $fullString);
foreach ($lines as $line) {
  array_push($grid, str_split($line));
}

// get the position of the Start and End
for ($i = 0; $i < count($grid); $i++) {
  if (array_search('S', $grid[$i]) !== false) {
    array_push($start, $i);
    array_push($start, array_search('S', $grid[$i]));
  }
  if (array_search('E', $grid[$i]) !== false) {
    array_push($end, $i);
    array_push($end, array_search('E', $grid[$i]));
  }
}

// print_r($start);
// print_r($end);

function move($from, $numberOfMoves, $alreadyVisited, $history)
{
  global $grid;
  global $alphabet;
  // global $alreadyVisited;
  // array_push($alreadyVisited, $from);
  // echo 'move! ';
  $newAlreadyVisited = [
    ...$alreadyVisited,
    '[' . $from[0] . ',' . $from[1] . ']',
  ];
  $candidates = [];
  $newNumberOfMoves = $numberOfMoves + 1;
  $currentLetter = $grid[$from[0]][$from[1]];
  $newHistory = $history . '[' . $from[0] . ',' . $from[1] . '], ';
  // print_r($newAlreadyVisited);
  // echo every move fire
  // echo 'Moving to ' . $from[0] . ' ' . $from[1] . "\n";
  // check north if we are not on the northeren edge of the grid
  if ($from[0] !== 0) {
    // we are not on the northeren edge
    if (
      // check if the End is on the north
      ($currentLetter === 'y' || $currentLetter === 'z') &&
      $grid[$from[0] - 1][$from[1]] === 'E'
    ) {
      // echo 'found the End on the north after ' . $newNumberOfMoves . '  moves.';
      echo $newNumberOfMoves . ' ';
      fwrite(fopen('solutions.txt', 'a'), $newNumberOfMoves . "\n");
    } elseif (
      (array_search($grid[$from[0] - 1][$from[1]], $alphabet) - 1 <=
        array_search($grid[$from[0]][$from[1]], $alphabet) &&
        $grid[$from[0] - 1][$from[1]] !== 'S' &&
        array_search(
          '[' . $from[0] - 1 . ',' . $from[1] . ']',
          $newAlreadyVisited
        ) === false) ||
      $grid[$from[0]][$from[1]] === 'S'
    ) {
      //  we have found  a suitable north candidate
      // add it to candidates
      array_push($candidates, [$from[0] - 1, $from[1]]);
    }
  }

  // check east if we are  not on the eastern edge of the grid
  if ($from[1] !== count($grid[$from[0]]) - 1) {
    //  we  are not on the eastern edge of the grid
    // echo "we are not on the eastern edge of the grid \n";
    if (
      // check if End is on the east
      ($currentLetter === 'y' || $currentLetter === 'z') &&
      $grid[$from[0]][$from[1] + 1] === 'E'
    ) {
      // echo 'found the End on the east after ' . $newNumberOfMoves . '  moves.';
      echo $newNumberOfMoves . ' ';
      fwrite(fopen('solutions.txt', 'a'), $newNumberOfMoves . "\n");
    } elseif (
      (array_search($grid[$from[0]][$from[1] + 1], $alphabet) - 1 <=
        array_search($grid[$from[0]][$from[1]], $alphabet) &&
        $grid[$from[0]][$from[1] + 1] !== 'S' &&
        array_search(
          '[' . $from[0] . ',' . $from[1] + 1 . ']',
          $newAlreadyVisited
        ) === false) ||
      $grid[$from[0]][$from[1]] === 'S'
    ) {
      // echo "end is not on the east \n";
      // suitable  candidate on the east, add tot he array of candidates
      array_push($candidates, [$from[0], $from[1] + 1]);
    }
  }

  // check south to make sure we are not on the southern edge of the grid
  if ($from[0] !== count($grid) - 1) {
    // we are not on the southern edge of the grid
    if (
      // check if End is on the south
      ($currentLetter === 'y' || $currentLetter === 'z') &&
      $grid[$from[0] + 1][$from[1]] === 'E'
    ) {
      // echo 'found the End on the south after ' . $newNumberOfMoves . '  moves.';
      echo $newNumberOfMoves . ' ';
      fwrite(fopen('solutions.txt', 'a'), $newNumberOfMoves . "\n");
    } elseif (
      (array_search($grid[$from[0] + 1][$from[1]], $alphabet) - 1 <=
        array_search($grid[$from[0]][$from[1]], $alphabet) &&
        $grid[$from[0] + 1][$from[1]] !== 'S' &&
        array_search(
          '[' . $from[0] + 1 . ',' . $from[1] . ']',
          $newAlreadyVisited
        ) === false) ||
      $grid[$from[0]][$from[1]] === 'S'
    ) {
      // suitable candidate on the south, add to the array of candidates
      array_push($candidates, [$from[0] + 1, $from[1]]);
    }
  }

  // check west to make sure we are not on the western edge of the grid
  if ($from[1] !== 0) {
    // we are not on the western edge of the grid
    if (
      // check if End is on the west
      ($currentLetter === 'y' || $currentLetter === 'z') &&
      $grid[$from[0]][$from[1] - 1] === 'E'
    ) {
      // echo 'found the End on the west after ' . $newNumberOfMoves . ' moves.';
      echo $newNumberOfMoves . ' ';
      fwrite(fopen('solutions.txt', 'a'), $newNumberOfMoves . "\n");
    } elseif (
      (array_search($grid[$from[0]][$from[1] - 1], $alphabet) - 1 <=
        array_search($grid[$from[0]][$from[1]], $alphabet) &&
        $grid[$from[0]][$from[1] - 1] !== 'S' &&
        array_search(
          '[' . $from[0] . ',' . $from[1] - 1 . ']',
          $newAlreadyVisited
        ) === false) ||
      $grid[$from[0]][$from[1]] === 'S'
    ) {
      // suitable candidate on the  west, add to the  array of candidates
      array_push($candidates, [$from[0], $from[1] - 1]);
    }
  }
  // echo "All directions checked and the following candidates were found: \n";
  // print_r($candidates);
  if (count($candidates) > 0) {
    foreach ($candidates as $candidate) {
      move($candidate, $newNumberOfMoves, $newAlreadyVisited, $newHistory);
    }
  }
}
move($start, 0, [], '');
?>
