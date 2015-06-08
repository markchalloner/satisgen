<?php

namespace SatisGen\Config;

use Symfony\Component\Filesystem\Filesystem;

class DotEnvWriter implements ConfigWriterInterface {

    private $filesystem;
    private $outputFile;

    public function __construct(Filesystem $filesystem, $outputFile) {
        $this->filesystem = $filesystem;
        $this->outputFile = $outputFile;
    }

    public function setConfigs($configs) {
        $filesystem = $this->filesystem;
        $outputFile = $this->outputFile;
        $contents = '';

        if ($filesystem->exists($outputFile)) {
            $contents = file_get_contents($outputFile);
        }
        foreach ($configs as $name => $value) {
            if (preg_match('/^'.$name.'/m', $contents)) {
                $contents = preg_replace('/^('.$name.'=).*$/m', '${1}"'.$value.'"', $contents);
            } else {
                $contents .= $name.'="'.$value.'"'."\n";
            }
        }
        file_put_contents($outputFile, $contents);
    }

    public function setConfig($name, $value) {
        $this->setConfigs(array($name => $value));
    }

}
