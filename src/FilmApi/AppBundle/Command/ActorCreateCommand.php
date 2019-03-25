<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 25/03/2019
 * Time: 12:20 AM
 */

namespace FilmApi\AppBundle\Command;



use FilmApi\Application\Command\Actor\CreateActorCommand;
use FilmApi\Application\CommandHandler\Actor\CreateActorHandler;
use FilmApi\Domain\Actor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ActorCreateCommand extends Command
{

    private $createActorHandler;

    public function __construct(CreateActorHandler $createActorHandler, $name = null)
    {
        parent::__construct($name);
        $this->createActorHandler = $createActorHandler;
    }

    protected function configure()
    {
        $this
            ->setName("actor:create")
            ->addArgument('name',InputArgument::REQUIRED ,'The name to Actor');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $actor = new CreateActorCommand($name);
        //$output->write('Username: '.$actor);
        $this->createActorHandler->handle($actor);
        // $output->writeln('Whoa!');
        $output->writeln('Username: '.$input->getArgument('name'));

    }

}