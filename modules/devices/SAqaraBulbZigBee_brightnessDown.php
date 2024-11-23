<?php
/*
Уменьшить яркость на (array("value"=>1-50))
уменьшает минимум до brightnessMin+5.
Без  параметров 10.
*/

$inc;
$brightness = $this->getProperty('brightness');

if (isset($params[value]) && $params[value] > 0 && $params[value] <= 50) {
  $inc = $params[value];
  if ($inc > 0) {
    $inc = $inc * -1;
  }
} else {
  $inc = '-10';
}

$brightness += $inc;

if ($brightness < $this->getProperty('brightnessMin') + 5) {
  $brightness = $this->getProperty('brightnessMin') + 5;
}

if ($brightness == $this->getProperty('brightness')) {
  return;
}

$this->callMethod('setBrightness', array('value' => $brightness));
