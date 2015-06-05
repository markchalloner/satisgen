<?php

namespace SatisGen\Config;

interface ConfigWriterInterface {

    public function setConfigs($configs);

    public function setConfig($name, $value);

}
