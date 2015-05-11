<?php

namespace SatisGen\Config;

abstract class AbstractConfigReader {

    abstract function getEnv($name, $description, $filter = FILTER_DEFAULT, $options = null, $secure = false);

}
