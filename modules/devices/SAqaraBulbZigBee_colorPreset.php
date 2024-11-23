<?php

/*
Изменить температуру.(array('value'=>'C'-cold,'N'-neutral,'W'-warmest))
*/

$colorSet;
$pset;

if (isset($params[value])) {
  $pset = $params[value];
  if ($pset == 'C' || $pset == 'c') {
    $colorSet = 153;
  } else if ($pset == 'N' || $pset == 'n') {
    $colorSet = 250;
  } else if ($pset == 'W' || $pset == 'w') {
    $colorSet = 370;
  } else {
    return;
  }
  if ($this->getProperty('color_temp') == $colorSet) {
    return;
  }
  $this->callMethod('setColor', array('value' => $colorSet));
}