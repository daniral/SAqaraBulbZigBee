<?php

if (SETTINGS_SITE_LANGUAGE && file_exists(ROOT . 'languages/SAqaraBulbZigBee_' . SETTINGS_SITE_LANGUAGE . '.php')) {
 include_once(ROOT . 'languages/SAqaraBulbZigBee_' . SETTINGS_SITE_LANGUAGE . '.php');
} else {
 include_once(ROOT . 'languages/SAqaraBulbZigBee_default.php');//
}

$this->device_types['SAqaraBulb'] = array(
		'TITLE'=>'Освещение (Яркость,Температура)',
		'PARENT_CLASS' => 'SControllers',
        'CLASS' => 'SAqaraBulbZigBee',
        'PROPERTIES' => array(
			'addTimeSunrise' => array('DESCRIPTION' => 'Плюс\Минус к восходу солнца в формате(00:00)'),
			'addTimeSunset' => array('DESCRIPTION' => 'Плюс\Минус к закату солнца  в формате(00:00)'),
			'auto_ON/OFF' => array('DESCRIPTION' => 'Автовключение:<br/>0-не включать<br/>1-включать'),
			'brightness' => array('DESCRIPTION' => 'Яркость (0-254)', 'DATA_KEY' => 1),
			'byManually' => array('DESCRIPTION' => 'Включать по заданному времени:<br/>0-Выключить.<br/>1-Включить.', 'ONCHANGE' => 'switchByManually'),
			'bySensor' => array('DESCRIPTION' => 'Включать свет по датчику света<br/>0-Отключить.<br/>1-Включить.', 'ONCHANGE' => 'switchBySensor'),
			'bySunTime' => array('DESCRIPTION' => 'Включать свет по солнцу:<br/>0-Выключить.<br/>1-Включить.', 'ONCHANGE' => 'switchBySunTime'),
            'color_temp' => array('DESCRIPTION' => 'Цветовая температура (153-370)', 'DATA_KEY' => 1),
            'day_begin' => array('DESCRIPTION' => 'Начало режима день (hh:mm)'),
			'day_brightness' => array('DESCRIPTION' => 'Яркость днем(0-254)'),
			'day_color' => array('DESCRIPTION' => 'Температура днем (153-370)'),
			'flag' => array('DESCRIPTION' => 'Стопер'),
			'illuminance' => array('DESCRIPTION' => 'Данные с датчика освещения.', 'DATA_KEY' => 1),
			'illuminanceFlag' => array('DESCRIPTION' => 'Стопер датчика освещения'),
            'illuminanceMax' => array('DESCRIPTION' => 'Максимальное освещение.Если меньше включается свет.'),
			'night_begin' => array('DESCRIPTION' => 'Начало режима ночь (hh:mm)'),
			'night_brightness' => array('DESCRIPTION' => 'Яркость ночью(0-254)'),
			'night_color' => array('DESCRIPTION' => 'Температура днем (153-370)'),
			'presence' => array('DESCRIPTION' => 'Данные с датчика присутствия', 'ONCHANGE' => 'presenceUpdated', 'DATA_KEY' => 1),
			'signSunrise' => array('DESCRIPTION' => 'Прибавить или отнять от восхода солнца <br/>1-прибавить,<br/>0-отнять'),
			'signSunset' => array('DESCRIPTION' => 'Прибавить или отнять от заката солнца<br/>1-прибавить,<br/>0-отнять'),
			'timerOFF' => array('DESCRIPTION' => 'Задержка перед выключением(секунды).<br/>0-не выключать.'),
			'work_in_dai' => array('DESCRIPTION' => 'работать:<br/>0-24 часа.<br/>1-Днем.<br/>2-Ночью.'),
			'brightness_seved' => array('DESCRIPTION' => 'Сохраненная(предыдущая) яркость.'),
			'color_seved' => array('DESCRIPTION' => 'Сохраненная(предыдущая) теплота.'),
			'sunriseTime' => array('DESCRIPTION' => 'Время восхода солнца.'),
			'sunsetTime' => array('DESCRIPTION' => 'Время захода солнца.'),
			'brightnessMax' => array('DESCRIPTION' => 'Максимальная яркость.'),
			'brightnessMin' => array('DESCRIPTION' => 'Минимальная яркость.'),
			'color_tempMax' => array('DESCRIPTION' => 'Максимальная теплота.'),
			'color_tempMin' => array('DESCRIPTION' => 'Минимальная теплота.'),
			
        ),
        'METHODS' => array(
			'AutoOFF' => array('DESCRIPTION' => 'Авто выключение через свойство timerOFF секунд если 0 не включает.'),
			'brightnessDown' => array('DESCRIPTION' => 'Уменьшить яркость.(array(\'value\'=>10-254))<br/>Без параметров -10.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
			'brightnessUp' => array('DESCRIPTION' => 'Увеличить яркость.(array(\'value\'=>0-254))<br/>Без параметров +10.', '_CONFIG_SHOW' => 1,'_CONFIG_REQ_VALUE' => 1),
			'colorDown' => array('DESCRIPTION' => 'Уменьшить температуру.(array(\'value\'=>153-370))<br/>Без параметров -10.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
			'colorUp' => array('DESCRIPTION' => 'Увеличить температуру.(array(\'value\'=>153-370))<br/>Без параметров +10.', '_CONFIG_SHOW' => 1,'_CONFIG_REQ_VALUE' => 1),
            'byDefault' => array('DESCRIPTION' => 'Установить свойства по умолчанию.'),
			'colorPreset' => array('DESCRIPTION' => 'Изменить температуру.(array(\'value\'=>\'C\'-cold,\'N\'-neutral,\'W\'-warmest))<br/>Без параметров (<210=cold=0),(>210<280=neutral=250),(>280=warmest=370).', '_CONFIG_SHOW' => 1,'_CONFIG_REQ_VALUE' => 1),
            'CommandsMenu' => array('DESCRIPTION' => 'Создает меню управления.(Запускать 1 раз для каждого объекта).'),
            'presenceUpdated' => array('DESCRIPTION' => 'Запускается при изменении свойства presence'),
			'setBrightness' => array('DESCRIPTION' => 'Установить яркость света.(array(\'value\'=>0<=254))<br/>Без  параметров то что в day_brightness.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
			'setColor' => array('DESCRIPTION' => 'Установить температуру.(array(\'value\'=>153<=370))<br/>Без параметров то что в day_color.', '_CONFIG_SHOW' => 1, '_CONFIG_REQ_VALUE' => 1),
			'switch' => array('DESCRIPTION' => 'Включение/Выключение', '_CONFIG_SHOW' => 1),
			'switchByManually' => array('DESCRIPTION' => 'При включении вручную отключить по солнцу и по датчику.'),
			'switchBySensor' => array('DESCRIPTION' => 'При включении сенсора света отключить по солнцу и вручную.'),   
			'switchBySunTime' => array('DESCRIPTION' => 'При включении по солнцу отключить по датчику счета и вручную.'),   
            'turnOn' => array('DESCRIPTION' => 'Включить ночной режим - callMethod(\'имя объекта \'.\'turnOn\', array(\'dayNight\'=>1));<br/>Без параметров установит то что в night_brightness и night_color. ( flag=0. Auto_OFF запустится.)<br/>Включить ночной режим с параметрами - callMethod(\'имя объекта.turnOn\', array(\'brightness\'=>50,\'color\'=>10,\'dayNight\'=>1)); (flag=0. Auto_OFF запустится.)<br/>Включить - callMethod(\'имя объекта \'.\'turnOn\');<br/>Без параметров установит то что в day_color и day_brightness.( flag=1. Auto_OFF не запустится.)<br/>Включить  с параметрами - callMethod(\'имя объекта.turnOn\', array(\'brightness\'=>50,\'color\'=>10));  (flag=1. Auto_OFF не запустится.)', '_CONFIG_SHOW' => 1),
            'turnOff' => array('DESCRIPTION' => 'Выключить', '_CONFIG_SHOW' => 1),
			
    ),
);