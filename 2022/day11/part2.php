<?php
$fullString = file_get_contents('./input.txt');
$monkeysInfo = explode("\n\n", $fullString);
//(?<=:)(.*)  za cifre po dvopicju

$monkeyData = [
  0 => [
    'starting_items' => [64, 89, 65, 95],
    'operation' => '* 7',
    'test' => 3,
    'true' => 4,
    'false' => 1,
    'noOfInspects' => 0,
  ],
  1 => [
    'starting_items' => [76, 66, 74, 87, 70, 56, 51, 66],
    'operation' => '+ 5',
    'test' => 13,
    'true' => 7,
    'false' => 3,
    'noOfInspects' => 0,
  ],
  2 => [
    'starting_items' => [91, 60, 63],
    'operation' => 'sq uared',
    'test' => 2,
    'true' => 6,
    'false' => 5,
    'noOfInspects' => 0,
  ],
  3 => [
    'starting_items' => [92, 61, 79, 97, 79],
    'operation' => '+ 6',
    'test' => 11,
    'true' => 2,
    'false' => 6,
    'noOfInspects' => 0,
  ],
  4 => [
    'starting_items' => [93, 54],
    'operation' => '* 11',
    'test' => 5,
    'true' => 1,
    'false' => 7,
    'noOfInspects' => 0,
  ],
  5 => [
    'starting_items' => [60, 79, 92, 69, 88, 82, 70],
    'operation' => '+ 8',
    'test' => 17,
    'true' => 4,
    'false' => 0,
    'noOfInspects' => 0,
  ],
  6 => [
    'starting_items' => [64, 57, 73, 89, 55, 53],
    'operation' => '+ 1',
    'test' => 19,
    'true' => 0,
    'false' => 5,
    'noOfInspects' => 0,
  ],
  7 => [
    'starting_items' => [62],
    'operation' => '+ 4',
    'test' => 7,
    'true' => 3,
    'false' => 2,
    'noOfInspects' => 0,
  ],
];

$superModulo = 1;

foreach ($monkeyData as $monkee) {
  $superModulo = $superModulo * $monkee['test'];
}

echo $superModulo;

for ($i = 0; $i < 10000; $i++) {
  foreach ($monkeyData as $monkeyIndex => $monkeyDatum) {
    foreach ($monkeyData[$monkeyIndex]['starting_items'] as $startingItem) {
      if (count($monkeyData[$monkeyIndex]['starting_items']) > 0) {
        // inspect, +1 on no of inspects and change worry level
        $operationOnInspect = $monkeyData[$monkeyIndex]['operation'];
        if (explode(' ', $operationOnInspect)[0] === '+') {
          $monkeyData[$monkeyIndex]['starting_items'][0] =
            ($monkeyData[$monkeyIndex]['starting_items'][0] +
              explode(' ', $operationOnInspect)[1]) %
            $superModulo;
        } elseif (explode(' ', $operationOnInspect)[0] === '*') {
          $monkeyData[$monkeyIndex]['starting_items'][0] =
            ($monkeyData[$monkeyIndex]['starting_items'][0] *
              explode(' ', $operationOnInspect)[1]) %
            $superModulo;
        } else {
          $monkeyData[$monkeyIndex]['starting_items'][0] =
            $monkeyData[$monkeyIndex]['starting_items'][0] ** 2 % $superModulo;
        }
        // increase no of inspects
        $monkeyData[$monkeyIndex]['noOfInspects']++;

        //test for pass
        if (
          $monkeyData[$monkeyIndex]['starting_items'][0] %
            $monkeyData[$monkeyIndex]['test'] ===
          0
        ) {
          // true
          $trueMonkeyIndex = $monkeyData[$monkeyIndex]['true'];
          array_push(
            $monkeyData[$trueMonkeyIndex]['starting_items'],
            array_splice($monkeyData[$monkeyIndex]['starting_items'], 0, 1)[0]
          );
        } else {
          // false
          $falseMonkeyIndex = $monkeyData[$monkeyIndex]['false'];
          array_push(
            $monkeyData[$falseMonkeyIndex]['starting_items'],
            array_splice($monkeyData[$monkeyIndex]['starting_items'], 0, 1)[0]
          );
        }
      }
    }
  }
}

print_r($monkeyData);

?>
