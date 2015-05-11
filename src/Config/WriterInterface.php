<?php

namespace SatisGen\Config;

interface WriterInterface {

    public function setEnvs($envs);

    public function setEnv($name, $value);

}
