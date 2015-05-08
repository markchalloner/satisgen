<?php

namespace SatisGen\Application;

use SatisGen\Command\GenerateCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Filesystem\Filesystem;


class GenerateApplication extends Application
{
    private $filesystem;
    
    public function __construct(Filesystem $filesystem) 
    {
        $this->filesystem = $filesystem;
        parent::__construct('Satis Generator', '0.0.1');
    }
    
    protected function getCommandName(InputInterface $input)
    {
        return 'generate';
    }
    
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new GenerateCommand($this->filesystem);
        return $defaultCommands;
    }
    
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();
        return $inputDefinition;
    }
}
