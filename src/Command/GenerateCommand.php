<?php

namespace SatisGen\Command;

use SatisGen\Config\AdvancedConfigReaderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class GenerateCommand extends Command
{

    private $filesystem;
    private $config;

    public function __construct(Filesystem $filesystem, AdvancedConfigReaderInterface $config)
    {
        $this->filesystem = $filesystem;
        $this->config = $config;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('generate')
            ->setDescription('Generate a satis.json file from a satis.php file')
            ->addArgument(
                'input_file',
                InputArgument::OPTIONAL,
                'Location of the input satis.php file'
            )
            ->addArgument(
                'output_file',
                InputArgument::OPTIONAL,
                'Location of the output satis.json file'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filesystem = $this->filesystem;

        $inputFile  = $input->getArgument('input_file') ?: 'satis.php';
        $outputFile = $input->getArgument('output_file') ?: 'satis.json';

        $this->config->getInputReader()->setInput($input);
        $this->config->getInputReader()->setOutput($output);
        $this->config->getInputReader()->setQuestionHelper($this->getHelper('question'));

        if ($filesystem->exists($inputFile)) {
            $output->write('<info>Generating... </info>');
            /* TODO: Fixed by https://github.com/symfony/symfony/pull/14580
            try {
                $filesystem->dumpFile($outputFile, $this->generate($inputFile));
                $status = $filesystem->exists($outputFile);
            } catch (IOExceptionInterface $error) {
                $status = false;
            }*/
            file_put_contents($outputFile, $this->generate($inputFile));
            $status = $filesystem->exists($outputFile);
            $output->writeln($status ? '<info>OK' : '<error>Failed</error>');
        } else {
            $output->writeln('<error>Error: '.$inputFile.' not found.</error>');
        }
    }

    protected function generate($file) {
        $config = $this->config;
        ob_start();
        require $file;
        return ob_get_clean();
    }
}
