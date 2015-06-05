<?php

namespace SatisGen\Config;

interface ConfigReaderInterface {

    public function getConfig($name, $default = null);

}
