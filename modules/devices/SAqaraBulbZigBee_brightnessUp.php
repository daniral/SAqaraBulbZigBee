<?php
/*
Увеличить яркость.(array('value'=>1-50))
Без  параметров +10.
Увеличит максимум до brightnessMax.
*/

$brightness = $this->getProperty('brightness');
$inc;

if ($brightness >= $this->getProperty('brightnessMax')) {
  return;
}

if (isset($params[value]) && $params[value] > 0 && $params[value] <= 50) {
  $inc = $params[value];
  if ($inc < 0) {
    $inc = $inc * -1;
  }
} else {
  $inc = '10';
}

$brightness += $inc;

if ($brightness > $this->getProperty('brightnessMax')) {
  $brightness = $this->getProperty('brightnessMax');
}

$this->cm('setBrightness', array('value' => $brightness));