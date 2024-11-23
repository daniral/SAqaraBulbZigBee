<?php

$dictionary = array(

 'SAqaraBulbZigBee_PATTERN_BRIGHTNESS' => 'ярк|ярч|яркость',
 'SAqaraBulbZigBee_PATTERN_COLORTEMPERATURE' => 'температур|температура|цвет|теплота'

);

foreach ($dictionary as $k => $v) {
 if (!defined('LANG_' . $k)) {
  @define('LANG_' . $k, $v);
 }
}
