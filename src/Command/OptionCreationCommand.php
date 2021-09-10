<?php

namespace App\Command;

use App\Business\Option\OptionCreationAction;
use App\Business\Option\OptionCreationHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OptionCreationCommand extends Command
{
    /**
     * @var OptionCreationHandler
     */
    private $handler;

    protected static $defaultName = 'app:option:creation';

    public function __construct(OptionCreationHandler $handler)
    {
        parent::__construct(null);

        $this->handler = $handler;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Crée une action.')
            ->addOption('name', null, InputOption::VALUE_REQUIRED, 'Nom de l\'option.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $action = new OptionCreationAction();
        $action->name = $input->getOption('name');

        $this->handler->handle($action);

        return Command::SUCCESS;
    }
}