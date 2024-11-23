<?php

if ($params['NEW_VALUE'] == $params['OLD_VALUE']) return;

if ($params['NEW_VALUE'] >= $this->getProperty('color_tempMin') && $params['NEW_VALUE'] <= $this->getProperty('color_tempMax') && $this->getProperty('flag')) {
    $this->setProperty('color_seved', $params['NEW_VALUE']);
}
