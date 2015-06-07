<?php

namespace SatisGen\Config;

interface AdvancedConfigReaderInterface {

    public function getConfig($name, $description, $default = null, $validator = null, $secure = false);

}
