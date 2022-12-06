<?php
$fullString = file_get_contents('./input.txt');
$stringAsArrayOfChars = str_split($fullString);
$uniqueLen = 14;

for ($i = $uniqueLen - 1; $i < count($stringAsArrayOfChars); $i++) {
  $arrayToCheckForUnique = array_slice($stringAsArrayOfChars, $i, $uniqueLen);
  $uniqueElements = array_unique($arrayToCheckForUnique);
  if (count($uniqueElements) === $uniqueLen) {
    echo $i + $uniqueLen;
    break;
  }
}
?>
