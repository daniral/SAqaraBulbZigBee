<?php

if (!$this->getProperty('brightness') && !$this->getProperty('flag')) {
  $this->callMethod('turnOn');
} else if ($this->getProperty('brightness') && !$this->getProperty('flag')) {
  $this->callMethod('turnOn');
} else if ($this->getProperty('brightness') && $this->getProperty('flag')) {
  $this->callMethod('turnOff');
}