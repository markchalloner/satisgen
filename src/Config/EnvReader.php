<?php

namespace SatisGen\Config;

class EnvReader implements ReaderInterface {

    function getEnv($name, $description, $filter = FILTER_DEFAULT, $options = null, $secure = false) {
        return filter_var(getenv($name), $filter, $options);
    }
}
