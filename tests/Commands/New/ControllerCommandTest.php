<?php

declare(strict_types=1);

namespace Tests\Commands\New;

use LionBundle\Commands\New\ControllerCommand;
use LionBundle\Commands\New\ModelCommand;
use LionCommand\Kernel;
use LionTest\Test;
use Symfony\Component\Console\Tester\CommandTester;

class ControllerCommandTest extends Test
{
    const URL_PATH = './app/Http/Controllers/';
    const NAMESPACE_CLASS = 'App\\Http\\Controllers\\';
    const CLASS_NAME = 'TestController';
    const OBJECT_NAME = self::NAMESPACE_CLASS . self::CLASS_NAME;
    const FILE_NAME = self::CLASS_NAME . '.php';
    const OUTPUT_MESSAGE = 'controller has been generated';
    const CONTROLLER_METHODS = ['__construct', 'createTest', 'readTest', 'updateTest', 'deleteTest'];

    const URL_PATH_MODEL = './app/Models/';
    const NAMESPACE_CLASS_MODEL = 'App\\Models\\';
    const CLASS_NAME_MODEL = 'TestModel';
    const OBJECT_NAME_MODEL = self::NAMESPACE_CLASS_MODEL . self::CLASS_NAME_MODEL;
    const FILE_NAME_MODEL = self::CLASS_NAME_MODEL . '.php';
    const OUTPUT_MESSAGE_MODEL = 'model has been generated';
    const MODEL_METHODS = ['createTestDB', 'readTestDB', 'updateTestDB', 'deleteTestDB'];

    private Kernel $kernel;
    private CommandTester $commandTester;

	protected function setUp(): void 
	{
        $this->kernel = new Kernel();
        $this->kernel->commands([ControllerCommand::class, ModelCommand::class]);
        $this->commandTester = new CommandTester($this->kernel->getApplication()->find('new:controller'));

        $this->createDirectory(self::URL_PATH);
        $this->createDirectory(self::URL_PATH_MODEL);
	}

	protected function tearDown(): void 
	{
        $this->rmdirRecursively('./app/');
	}

    public function testExecute(): void
    {
        $this->commandTester->execute(['controller' => self::CLASS_NAME, '--model' => self::CLASS_NAME_MODEL]);

        $this->assertStringContainsString(self::OUTPUT_MESSAGE, $this->commandTester->getDisplay());
        $this->assertStringContainsString(self::OUTPUT_MESSAGE_MODEL, $this->commandTester->getDisplay());
        $this->assertFileExists(self::URL_PATH . self::FILE_NAME);
        $this->assertFileExists(self::URL_PATH_MODEL . self::FILE_NAME_MODEL);

        require_once(self::URL_PATH_MODEL . self::FILE_NAME_MODEL);
        require_once(self::URL_PATH . self::FILE_NAME);

        $objClass = new (self::OBJECT_NAME)();
        $objModelClass = new (self::OBJECT_NAME_MODEL)();

        $this->assertIsObject($objClass);
        $this->assertInstanceOf(self::OBJECT_NAME, $objClass);
        $this->assertSame(self::CONTROLLER_METHODS, get_class_methods($objClass));
        $this->assertIsObject($objModelClass);
        $this->assertInstanceOf(self::OBJECT_NAME_MODEL, $objModelClass);
        $this->assertSame(self::MODEL_METHODS, get_class_methods($objModelClass));
    }
}