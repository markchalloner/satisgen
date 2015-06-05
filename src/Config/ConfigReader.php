<?php

namespace SatisGen\Config;

class ConfigReader implements AdvancedConfigReaderInterface {

    private $envReader;
    private $inputReader;
    
    public function __construct(ConfigReaderInterface $envReader, AdvancedConfigReaderInterface $inputReader) {
        $this->envReader = $envReader;
        $this->inputReader = $inputReader;
    }

    public function getInputReader() {
        return $this->inputReader;
    }

    public function getConfig($name, $description, $default = null, $validator = null, $secure = false) {
        $value = $this->envReader->getConfig($name, $default);
        if (false !== $value) {
            return $value;
        }
        return $this->inputReader->getConfig($name, $description, $default, $validator, $secure);
    }

}