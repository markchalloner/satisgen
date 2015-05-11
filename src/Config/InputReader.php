<?php

namespace SatisGen\Config;

use Symfony\Component\Console\Question\Question;

class InputReader implements ReaderInterface {

    private $input;
    private $output;
    private $helper;
    private $answers = array();

    public function __construct() {
    }

    public function setInput($input) {
        $this->input = $input;
    }

    public function setOutput($output) {
        $this->output = $output;
    }

    public function setHelper($helper) {
        $this->helper = $helper;
    }

    public function getEnv($name, $description, $filter = FILTER_DEFAULT, $options = null, $secure = false) {
        if (array_key_exists($name, $this->answers)) {
            $value = $this->answers[$name];
            // TODO - move to writer
            //echo $value;
            return $value;
        }

        $helper = $this->helper;
        $question = new Question('Please enter '.$description.': ', getenv($name));
        $value = $helper->ask($this->input, $this->output, $question);
        $this->answers[$name] = $value;
        // TODO - move to writer
        //echo $value;
        return $value;
    }

}
