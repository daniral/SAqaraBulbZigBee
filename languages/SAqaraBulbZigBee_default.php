<?php

$dictionary = array(

 'SAqaraBulbZigBee_PATTERN_BRIGHTNESS' => 'brighness',
 'SAqaraBulbZigBee_PATTERN_COLORTEMPERATURE' => 'color temperature'

);

foreach ($dictionary as $k => $v) {
 if (!defined('LANG_' . $k)) {
  @define('LANG_' . $k, $v);
 }
}
