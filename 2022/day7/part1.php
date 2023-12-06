<?php
$fullString = file_get_contents('./input.txt');
$input = explode("\n", $fullString);

$filesystem = [];
$currentPath = ['root'];

foreach ($input as $line) {
  list($start, $mid, $end) = array_pad(explode(' ', $line), 3, null);
  if ($start === '$') {
    if ($mid === 'cd') {
      if ($end === '/') {
        $currentPath = ['root'];
      } elseif ($end === '..') {
        array_pop($currentPath);
      } else {
        array_push($currentPath, $end);
      }
    }
  } else {
    if ($start !== 'dir') {
      array_push($filesystem, implode('/', $currentPath) . '/' . $start);
    }
  }
}

$totals = [];

foreach ($filesystem as $path) {
  $savePath = '';
  $path = explode('/', $path);
  foreach ($path as $segment) {
    $savePath = $savePath . '/' . $segment;
    if (!is_numeric($segment)) {
      if (array_key_exists($savePath, $totals)) {
        $totals[$savePath] += end($path);
      } else {
        $totals[$savePath] = end($path);
      }
    }
  }
}

$totalsLessThan100000 = array_filter($totals, function ($total) {
  return $total <= 100000;
});

$answer = array_sum($totalsLessThan100000);

echo $answer . "\n";
