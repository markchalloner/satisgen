<?php

namespace SatisGen\Config;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface InputReaderInterface {

    public function setInput(InputInterface $input);
    
    public function setOutput(OutputInterface $output);
    
    public function setQuestionHelper(QuestionHelper $questionHelper);

}
