<?php

namespace SatisGen\Config;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class InputReader implements
    AdvancedConfigReaderInterface,
    InputReaderInterface
{

    private $input;
    private $output;
    private $questionHelper;
    private $configWriter;
    private $first = true;
    private $answers = array();

    public function __construct(ConfigWriterInterface $configWriter) {
        $this->configWriter = $configWriter;
    }

    public function setInput(InputInterface $input) {
       $this->input = $input;
    }

    public function setOutput(OutputInterface $output) {
        $this->output = $output;
    }

    public function setQuestionHelper(QuestionHelper $questionHelper) {
        $this->questionHelper = $questionHelper;
    }

    public function getConfig($name, $description, $default = null, $validator = null, $secure = false) {
        if (array_key_exists($name, $this->answers)) {
            $value = $this->answers[$name];
            return $value;
        }

        // Get question
        $question = new Question(
            'Please enter '.$description.': ',
            $default
        );
        $question->setHidden($secure);
        $question->setHiddenFallback(false);
        $question->setValidator($validator);
        $question->setMaxAttempts(5);

        if ($this->isFirst()) {
            $this->output->write("\n");
        }

        $value = $this->questionHelper->ask($this->input, $this->output, $question);
        $this->answers[$name] = $value;
        $this->configWriter->setConfig($name, $value);
        return $value;
    }

    protected function isFirst() {
        $first = $this->first;
        $this->first = false;
        return $first;
    }

}
