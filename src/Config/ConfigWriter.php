<?php

namespace SatisGen\Config;

class ConfigWriter {

    private $filesystem;
    private $outputFile;

    public function __construct($filesystem, $outputFile) {
        $this->filesystem = $filesystem;
        $this->outputFile = $outputFile;
    }

    public function setEnvs($envs) {
        $filesystem = $this->filesystem;
        $outputFile = $this->outputFile;
        $contents = '';

        if ($filesystem->exists($outputFile)) {
            $contents = file_get_contents($outputFile);
        }
        foreach ($envs as $name => $value) {
            if (preg_match('/^'.$name.'/m', $contents)) {
                $contents = preg_replace('/^('.$name.'=).*$/m', '${1}'.$value, $contents);
            } else {
                $contents .= "\n".$name.'='.$value;
            }
        }
        // TODO: Fixed by https://github.com/symfony/symfony/pull/14580
        file_put_contents($outputFile, $contents);
    }

    public function setEnv($name, $value) {
        $this->setEnvs(array($name => $value));
    }

}
