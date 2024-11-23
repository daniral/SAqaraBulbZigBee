<?php

if (SETTINGS_SITE_LANGUAGE && file_exists(ROOT . 'languages/SAqaraBulbZigBee_' . SETTINGS_SITE_LANGUAGE . '.php')) {
	include_once(ROOT . 'languages/SAqaraBulbZigBee_' . SETTINGS_SITE_LANGUAGE . '.php');
} else {
	include_once(ROOT . 'languages/SAqaraBulbZigBee_default.php'); //
}

$this->device_types['SAqaraBulb'] = array(
	'TITLE' => 'Освещение (Яркость,Температура)',
	'PARENT_CLASS' => 'SControllers',
	'CLASS' => 'SAqaraBulbZigBee',
	'PROPERTIES' => array(
		'addTimeSunrise' => array('DESCRIPTION' => 'Добавить к восходу(00:00)'),
		'addTimeSunset' => array('DESCRIPTION' => 'Добавить к закат(00:00)'),
		'auto_ON/OFF' => array('DESCRIPTION' => 'Автовключение: 0-не включать 1-включать'),
		'brightness' => array('DESCRIPTION' => 'Яркость (brightnessMin<-->brightnessMax)', 'ONCHANGE' => 'brightnessChanged', 'DATA_KEY' => 1),
		'byManually' => array('DESCRIPTION' => 'Включать по заданному времени: 0-Выключить. 1-Включить.', 'ONCHANGE' => 'switchByManually'),
		'bySensor' => array('DESCRIPTION' => 'Включать по датчику света: 0-Отключить. 1-Включить.', 'ONCHANGE' => 'switchBySensor'),
		'bySunTime' => array('DESCRIPTION' => 'Включать по солнцу: 0-Выключить. 1-Включить.', 'ONCHANGE' => 'switchBySunTime'),
		'color_temp' => array('DESCRIPTION' => 'Цветовая температура: (color_tempMin<-->color_tempMax)', 'ONCHANGE' => 'colorChanged', 'DATA_KEY' => 1),
		'day_begin' => array('DESCRIPTION' => 'Начало режима день (hh:mm)'),
		'day_brightness' => array('DESCRIPTION' => 'Яркость днем (1<-->brightnessMax)'),
		'day_color' => array('DESCRIPTION' => 'Температура днем (color_tempMin<-->color_tempMax)'),
		'flag' => array('DESCRIPTION' => 'Стопер'),
		'illuminance' => array('DESCRIPTION' => 'Данные с датчика освещения.', 'DATA_KEY' => 1),
		'illuminanceFlag' => array('DESCRIPTION' => 'Стопер датчика освещения'),
		'illuminanceMax' => array('DESCRIPTION' => 'Максимальное освещение.Если меньше включается свет.'),
		'night_begin' => array('DESCRIPTION' => 'Начало режима ночь (hh:mm)'),
		'night_brightness' => array('DESCRIPTION' => 'Яркость ночью(1<-->brightnessMax)'),
		'night_color' => array('DESCRIPTION' => 'Температура днем (color_tempMin<-->color_tempMax)'),
		'presence' => array('DESCRIPTION' => 'Данные с датчика присутствия', 'ONCHANGE' => 'presenceUpdated', 'DATA_KEY' => 1),
		'signSunrise' => array('DESCRIPTION' => 'Прибавить или отнять к/от восхода солнца  1-прибавить, 0-отнять'),
		'signSunset' => array('DESCRIPTION' => 'Прибавить или отнять к/от заката солнца 1-прибавить, 0-отнять'),
		'timerOFF' => array('DESCRIPTION' => 'Задержка перед выключением(секунды). 0-не выключать.'),
		'work_in_dai' => array('DESCRIPTION' => 'работать: 0-24 часа. 1-Днем. 2-Ночью.'),
		'brightness_seved' => array('DESCRIPTION' => 'Сохраненная(предыдущая) яркость.'),
		'color_seved' => array('DESCRIPTION' => 'Сохраненная(предыдущая) теплота.'),
		'sunriseTime' => array('DESCRIPTION' => 'Время восхода солнца.'),
		'sunsetTime' => array('DESCRIPTION' => 'Время захода солнца.'),
		'brightnessMax' => array('DESCRIPTION' => 'Максимальная яркость.', '_CONFIG_TYPE' => 'num'),
		'brightnessMin' => array('DESCRIPTION' => 'Минимальная яркость.', '_CONFIG_TYPE' => 'num'),
		'color_tempMax' => array('DESCRIPTION' => 'Максимальная теплота.', '_CONFIG_TYPE' => 'num'),
		'color_tempMin' => array('DESCRIPTION' => 'Минимальная теплота.', '_CONFIG_TYPE' => 'num'),

	),
	'METHODS' => array(
		'AutoOFF' => array('DESCRIPTION' => 'Автовыключение (timerOFF) 0 не включает.'),
		'brightnessDown' => array('DESCRIPTION' => 'Уменьшить яркость.(array(\'value\'=>1-50)) Без параметров -10.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
		'brightnessUp' => array('DESCRIPTION' => 'Увеличить яркость.(array(\'value\'=>1-50)) Без параметров +10.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
		'colorDown' => array('DESCRIPTION' => 'Уменьшить температуру.(array(\'value\'=>1-50)) Без параметров -10.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
		'colorUp' => array('DESCRIPTION' => 'Увеличить температуру.(array(\'value\'=>1-50)) Без параметров +10.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
		'byDefault' => array('DESCRIPTION' => 'Установить свойства по умолчанию.'),
		'colorPreset' => array('DESCRIPTION' => 'Цветовые пресеты.(array(\'value\'=>\'C\'-cold,\'N\'-neutral,\'W\'-warmest))', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
		'CommandsMenu' => array('DESCRIPTION' => 'Создает меню управления.(Запускать 1 раз для каждого объекта).', '_CONFIG_SHOW' => 1),
		'presenceUpdated' => array('DESCRIPTION' => 'Запускается при изменении свойства presence'),
		'setBrightness' => array('DESCRIPTION' => 'Установить яркость света.(array(\'value\'=> brightnessMin<-->brightnessMax)) Без  параметров то что в brightness_seved. Если brightness_seved пусто то brightnessMax.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
		'setColor' => array('DESCRIPTION' => 'Установить температуру.(array(\'value\'=>color_tempMin <--> color_tempMax)) Без  параметров то что в color_seved. Если color_seved пуст то холодный color_tempMin.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
		'switch' => array('DESCRIPTION' => 'Переключить', '_CONFIG_SHOW' => 1),
		'switchByManually' => array('DESCRIPTION' => 'При включении вручную отключить по солнцу и по датчику.'),
		'switchBySensor' => array('DESCRIPTION' => 'При включении сенсора света отключить по солнцу и вручную.'),
		'switchBySunTime' => array('DESCRIPTION' => 'При включении по солнцу отключить по датчику счета и вручную.'),
		'turnOn' => array('DESCRIPTION' => 'ВключитЬ', '_CONFIG_SHOW' => 1),
		'turnOff' => array('DESCRIPTION' => 'Выключить', '_CONFIG_SHOW' => 1),
		'brightnessChanged' => array('DESCRIPTION' => 'Запускается при смене яркости'),
		'colorChanged' => array('DESCRIPTION' => 'Запускается при смене цвета температуры'),
	),
);
