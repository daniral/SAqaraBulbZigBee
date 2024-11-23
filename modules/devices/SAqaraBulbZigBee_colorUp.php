<?php
/*
Увеличить температуру.(array("value"=>1-50))
Без  параметров +10.
Увеличивает максимум до color_tempMax
*/

$inc;
$color = $this->getProperty('color_temp');
$c_max = $this->getProperty('color_tempMax');

if (isset($params[value]) && $params[value] > 0 && $params[value] <= 50) {
  $inc = $params[value];
  if ($inc < 0) {
    $inc = $inc * -1;
  }
} else {
  $inc = '10';
}

$color += $inc;

if ($color > $c_max) {
  $color = $c_max;
}

if ($color == $this->getProperty('color_temp')) {
  return;
}

$this->callMethod('setColor', array('value' => $color));
