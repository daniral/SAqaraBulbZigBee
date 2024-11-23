<?php

/*
Установить температуру.(array("value"=>color_tempMin <--> color_tempMax))
Без  параметров то что в color_seved.
Если color_seved пуст то холодный color_tempMin.
*/

$new_color_temp;
$c_min = $this->getProperty('color_tempMin');
$c_max = $this->getProperty('color_tempMax');
$c_seved = $this->getProperty('color_seved');

$this->setProperty('flag', '1');

if (isset($params['value'])) {
	$new_color_temp = $params['value'];
	if ($new_color_temp < $c_min) {
		$new_color_temp = $c_min;
	} else if ($new_color_temp > $c_max) {
		$new_color_temp = $c_max;
	}
} else if ($c_seved) {
	$new_color_temp = $c_seved;
} else {
	$new_color_temp = $c_min;
}

$this->setProperty('color_temp', $new_color_temp);

if(!$this->getProperty('brightness')){
	$this->setProperty('brightness',$this->getProperty('brightness_seved'));
}