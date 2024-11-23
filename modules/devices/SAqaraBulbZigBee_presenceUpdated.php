<?php

/*
Запускается при изменении свойства presence
*/

if (!$this->getProperty('presence')) {
  $this->callMethod('AutoOFF');
}