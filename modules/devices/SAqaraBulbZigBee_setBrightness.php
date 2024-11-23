<?php
/*
Установить яркость света.(array("value"=>brightnessMin <--> brightnessMax))
Без  параметров то что в brightness_seved.
Если brightness_seved пусто то brightnessMax.
*/
$b_min = $this->getProperty('brightnessMin');
$b_max = $this->getProperty('brightnessMax');
$b_seved = $this->getProperty('brightness_seved');
$new_brightLevel;

$this->setProperty('flag', '1');

if (isset($params['value'])) {
	$new_brightLevel = $params['value'];
	if ($new_brightLevel <= $b_min) {
		$new_brightLevel = $b_min;
		$this->setProperty('flag', 0);
		$this->setProperty('illuminanceFlag', 0);
	} else if ($new_brightLevel > $b_max) {
		$new_brightLevel = $b_max;
	}
} else if ($b_seved) {
	$new_brightLevel = $b_seved;
} else {
	$new_brightLevel = $b_max;
}

$this->setProperty('brightness', $new_brightLevel);
