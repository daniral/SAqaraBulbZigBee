<?php
/*

Включить ночной режим - callMethod('имя объекта '.'turnOn', array('dayNight'=>1)); если без параметров установит то что в night_brightness и night_color. ( flag=0. AutoOFF запустится.)
Включить ночной режим с параметрами - callMethod('имя объекта.turnOn', array('brightness'=> 1 <--> brightnessMax,'color'=>color_tempMin <--> color_tempMax,'dayNight'=>1)); (flag=0. AutoOFF запустится.)
Включить - callMethod('имя объекта '.'turnOn'); если без параметров установит то что в brightness_seved и color_seved.
Если brightness_seved и color_seved пусто то на полную яркость brightnessMax и холодный цвет color_tempMin.( flag=1. AutoOFF не запустится.)
Включить  с параметрами - callMethod('имя объекта.turnOn', array('brightness'=>brightnessMin <--> brightnessMax,'color'=>color_tempMin <--> color_tempMax));  (flag=1. AutoOFF не запустится.)

*/

if ($this->getProperty('day_brightness') == '') $this->setProperty('day_brightness', '254');
if ($this->getProperty('day_color') == '') $this->setProperty('day_color', '153');
if ($this->getProperty('night_brightness') == '') $this->setProperty('night_brightness', '30');
if ($this->getProperty('night_color') == '') $this->setProperty('night_color', '370');
if ($this->getProperty('brightnessMin') == '') $this->setProperty('brightnessMin', '0');
if ($this->getProperty('brightnessMax') == '') $this->setProperty('brightnessMax', '254');
if ($this->getProperty('color_tempMin') == '') $this->setProperty('color_tempMin', '153');
if ($this->getProperty('color_tempMax') == '') $this->setProperty('color_tempMax', '370');
if ($this->getProperty('timerOFF') == '') $this->setProperty('timerOFF', '120');
if ($this->getProperty('presence') == '') $this->setProperty('presence', '0');
if ($this->getProperty('day_begin') == '') $this->setProperty('day_begin', '08:00');
if ($this->getProperty('night_begin') == '') $this->setProperty('night_begin', '18:00');
if ($this->getProperty('auto_ON/OFF') == '') $this->setProperty('auto_ON/OFF', '1');
if ($this->getProperty('flag') == '') $this->setProperty('flag', '0');
if ($this->getProperty('illuminanceFlag') == '') $this->setProperty('illuminanceFlag', '0');
if ($this->getProperty('illuminance') == '') $this->setProperty('illuminance', '0');
if ($this->getProperty('illuminanceMax') == '') $this->setProperty('illuminanceMax', '0');
if ($this->getProperty('bySensor') == '') $this->setProperty('bySensor', '0');
if ($this->getProperty('byManually') == '') $this->setProperty('byManually', '1');
if ($this->getProperty('bySunTime') == '') $this->setProperty('bySunTime', '0');
if ($this->getProperty('work_in_dai') == '') $this->setProperty('work_in_dai', '2');
if ($this->getProperty('addTimeSunrise') == '') $this->setProperty('addTimeSunrise', '00:00');
if ($this->getProperty('addTimeSunset') == '') $this->setProperty('addTimeSunset', '00:00');
if ($this->getProperty('signSunrise') == '') $this->setProperty('signSunrise', '1');
if ($this->getProperty('signSunset') == '') $this->setProperty('signSunset', '1');

$color = isset($params['color']) && $params['color'] >= $this->getProperty('color_tempMin') && $params['color'] <= $this->getProperty('color_tempMax') ? $params['color'] : 0;
$brightness = isset($params['brightness']) && $params['brightness'] > $this->getProperty('brightnessMin') && $params['brightness'] <= $this->getProperty('brightnessMax') ? $params['brightness'] : 0;
$dayNight = isset($params['dayNight']) && $params['dayNight'] == 1 ? 1 : 0;

$day_b;
$night_b;

if (!$dayNight) {
  if ($color) {
    $this->callMethod('setColor', $color);
  } else {
    $this->callMethod('setColor');
  }
  if ($brightnes) {
    $this->callMethod('setBrightness', $brightnes);
  } else {
    $this->callMethod('setBrightness');
  }
  return;
}

if ($dayNight && !$this->getProperty('flag')) {

  if ($this->getProperty('bySunTime') && $this->getProperty('sunriseTime') != '' && $this->getProperty('sunsetTime') != '') {
    $day_b = edit_time($this->getProperty('sunriseTime'), $this->getProperty('addTimeSunrise'), $this->getProperty('signSunrise'));
    $night_b = edit_time($this->getProperty('sunsetTime'), $this->getProperty('addTimeSunset'), $this->getProperty('signSunset'));
  } else if (!$this->getProperty('bySensor')) {
    $day_b = $this->getProperty('day_begin');
    $night_b = $this->getProperty('night_begin');
  }
  if ($this->getProperty('auto_ON/OFF')) {
    if (($this->getProperty('work_in_dai') == '2' || $this->getProperty('work_in_dai') == '0') && !$this->getProperty('bySensor') && timeBetween($night_b, $day_b)) {
      $this->setProperty('brightness', $brightnes ? $brightnes : $this->getProperty('night_brightness'));
      $this->setProperty('color_temp', $color ? $color : $this->getProperty('night_color'));
      if ($this->getProperty('flag')) $this->setProperty('flag', '0');
      $this->callMethod('AutoOFF');
    }
    if (($this->getProperty('work_in_dai') == '1' || $this->getProperty('work_in_dai') == '0') && !$this->getProperty('bySensor') && timeBetween($day_b, $night_b)) {
      $this->setProperty('brightness', $brightnes ? $brightnes : $this->getProperty('day_brightness'));
      $this->setProperty('color_temp', $color ? $color : $this->getProperty('day_color'));
      if ($this->getProperty('flag')) $this->setProperty('flag', '0');
      $this->callMethod('AutoOFF');
    }
    if (($this->getProperty('bySensor') && $this->getProperty('illuminance') <= $this->getProperty('illuminanceMax')) || $this->getProperty('illuminanceFlag')) {
      $this->setProperty('brightness', $this->getProperty('night_brightness'));
      $this->setProperty('color_temp', $this->getProperty('night_color'));
      if ($this->getProperty('flag')) $this->setProperty('flag', '0');
      $this->setProperty('illuminanceFlag', 1);
      $this->callMethod('AutoOFF');
    }
  }
}

function edit_time($time, $addTime, $sign)
{
  $part = explode(':', $addTime);
  $addTime_sec = $part[0] * 3600 + $part[1] * 60 + $part[2];
  if (!$sign) {
    $addTime_sec = $addTime_sec * -1;
  }
  $res = strtotime($time) + $addTime_sec;
  return date('H:i', $res);
}
