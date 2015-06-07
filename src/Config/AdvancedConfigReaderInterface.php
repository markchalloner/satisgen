<?php

namespace SatisGen\Config;

interface AdvancedConfigReaderInterface {

    public function getInputReader(InputReaderInterface $inputReader);

    public function getConfig($name, $description, $default = null, $validator = null, $secure = false);

}
