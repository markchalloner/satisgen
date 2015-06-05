<?php

namespace SatisGen\Config;

class EnvReader implements ConfigReaderInterface {

    function getConfig($name, $default = null) {
        return getenv($name);
    }

}
