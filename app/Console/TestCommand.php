<?php

namespace App\Console;

use Symfony\Component\Console\Command\Command; 
use Symfony\Component\Console\Input\{ InputInterface, InputArgument }; 
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command {

	protected static $defaultName = "test";

	protected function initialize(InputInterface $input, OutputInterface $output) {

	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure() { 
		$this->setDescription("Command to create run unit tests");
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$result = exec('.\vendor\bin\phpunit');
        $output->writeln($result);
        return Command::SUCCESS;
    }

}