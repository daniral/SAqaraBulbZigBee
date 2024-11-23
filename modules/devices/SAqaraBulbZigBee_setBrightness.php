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

if (isset($params['value'])) {
	$new_brightLevel = $params['value'];
	if ($new_brightLevel < $b_min) {
		$new_brightLevel = $b_min;
		$this->setProperty('flag', 0);
		$this->setProperty('illuminanceFlag', 0);
	}
	if ($new_brightLevel > $b_max) {
		$new_brightLevel = $b_max;
	}
} else if ($b_seved) {
	$new_brightLevel = $b_seved;
} else {
	$new_brightLevel = $b_max;
}

if ($new_brightLevel != $b_seved && $new_brightLevel != $b_min) {
	$this->setProperty('brightness_seved', $new_brightLevel);
}
if ($new_brightLevel == $this->getProperty('brightness')) {
	return;
}

if (!$this->getProperty('flag')) {
	$this->setProperty('flag', '1');
}
$this->setProperty('brightness', $new_brightLevel);
