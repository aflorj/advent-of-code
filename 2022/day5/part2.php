<?php
// $overlaps = 0;
$fullString = file_get_contents('./input.txt');
[$stacksString, $commandsString] = preg_split("/\n\n/", $fullString);
$commands = preg_split("/\r\n|\n|\r/", $commandsString);
$stacks = [
  ['G', 'D', 'V', 'Z', 'J', 'S', 'B'],
  ['Z', 'S', 'M', 'G', 'V', 'P'],
  ['C', 'L', 'B', 'S', 'W', 'T', 'Q', 'F'],
  ['H', 'J', 'G', 'W', 'M', 'R', 'V', 'Q'],
  ['C', 'L', 'S', 'N', 'F', 'M', 'D'],
  ['R', 'G', 'C', 'D'],
  ['H', 'G', 'T', 'R', 'J', 'D', 'S', 'Q'],
  ['P', 'F', 'V'],
  ['D', 'R', 'S', 'T', 'J'],
];

foreach ($commands as $command) {
  $numbers = preg_match_all('!\d+!', $command, $matches);
  $actualCommands = $matches[0];
  $spliced = array_splice(
    $stacks[$actualCommands[1] - 1],
    -1 * $actualCommands[0],
    $actualCommands[0]
  );
  $stacks[$actualCommands[2] - 1] = array_merge(
    $stacks[$actualCommands[2] - 1],
    $spliced
  );
}

foreach ($stacks as $stack) {
  echo array_pop($stack);
}
?>
