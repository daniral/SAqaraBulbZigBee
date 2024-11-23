<?php

if ($params['NEW_VALUE'] == $params['OLD_VALUE']) return;

if ($params['NEW_VALUE'] > $this->getProperty('brightnessMin') && $params['NEW_VALUE'] <= $this->getProperty('brightnessMax') && $this->getProperty('flag')) {
    $this->setProperty('brightness_seved', $params['NEW_VALUE']);
}
