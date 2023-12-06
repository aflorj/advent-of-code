<?php
$fullString = file_get_contents('./input.txt');
$input = explode("\n", $fullString);

$filesystem = [];
$currentLocation = ['root'];

foreach ($input as $line) {
  list($start, $mid, $end) = array_pad(explode(' ', $line), 3, null);
  if ($start === '$') {
    if ($mid === 'cd') {
      if ($end === '/') {
        $currentLocation = ['root'];
      } elseif ($end === '..') {
        array_pop($currentLocation);
      } else {
        array_push($currentLocation, $end);
      }
    }
  } else {
    if ($start !== 'dir') {
      array_push($filesystem, implode('/', $currentLocation) . '/' . $start);
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

$totalDiskSpace = 70000000;
$totalNeededSpace = 30000000;

$totalUsedSpace = $totals['/root'];

$unusedSpace = $totalDiskSpace - $totalUsedSpace;

$neededSpace = $totalNeededSpace - $unusedSpace;

$options = array_filter($totals, function ($total) use ($neededSpace) {
  return $total >= $neededSpace;
});

sort($options);

echo $options[0] . "\n";
