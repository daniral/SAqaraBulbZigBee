<?php
/*
Уменьшить температуру.(array("value"=>1-50))
Уменьшает минимум до color_tempMin
Без  параметров -10.
*/

$inc;
$color = $this->getProperty('color_temp');
$c_min = $this->getProperty('color_tempMin');

if (isset($params[value]) && $params[value] > 0 && $params[value] <= 50) {
  $inc = $params[value];
  if ($inc > 0) {
    $inc = $inc * -1;
  }
} else {
  $inc = '-10';
}

$color += $inc;

if ($color <= $c_min) {
  $color = $c_min;
}

if ($color == $this->getProperty('color_temp')) {
  return;
}

$this->callMethod('setColor', array('value' => $color));