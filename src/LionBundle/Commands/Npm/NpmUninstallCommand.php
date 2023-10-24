<?php

namespace LionBundle\Commands\Npm;

use App\Traits\Framework\ConsoleOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NpmUninstallCommand extends Command
{
	use ConsoleOutput;

	protected static $defaultName = "npm:uninstall";

	protected function initialize(InputInterface $input, OutputInterface $output)
	{

	}

	protected function interact(InputInterface $input, OutputInterface $output)
	{

	}

	protected function configure()
	{
		$this
            ->setDescription("Command to uninstall dependencies with npm from a vite project")
            ->addArgument("project", InputArgument::REQUIRED, "Project name")
            ->addArgument("packages", InputArgument::REQUIRED, "Package name");
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$project = $input->getArgument("project");
        $pkg = $input->getArgument("packages");
        $cmd = kernel->execute("cd vite/{$project}/ && npm uninstall {$pkg}", false);
        $output->writeln(arr->of($cmd)->join("\n"));
        return Command::SUCCESS;
	}
}
