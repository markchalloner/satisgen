<?php

namespace SatisGen\Config;

class EnvReader implements ConfigReaderInterface {

    public function getConfig($name, $default = null) {
        return getenv($name);
    }

}
