<?php

namespace SatisGen\Config;

interface ReaderInterface {

    public function getEnv($name, $description, $filter = FILTER_DEFAULT, $options = null, $secure = false);

}
