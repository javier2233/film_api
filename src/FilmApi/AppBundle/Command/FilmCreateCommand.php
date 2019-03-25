<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 25/03/2019
 * Time: 3:18 AM
 */

namespace FilmApi\AppBundle\Command;


use FilmApi\AppBundle\Repository\CacheActorRepository;
use FilmApi\Application\Command\Film\CreateFilmCommand;
use FilmApi\Application\CommandHandler\Actor\GetActorHandler;
use FilmApi\Application\CommandHandler\Film\CreateFilmHandler;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FilmCreateCommand extends Command
{
    private $createFilmHandler;
    private $getActorHandler;

    public function __construct(CreateFilmHandler $createFilmHandler, CacheActorRepository $cacheActorRepository, $name = null)
    {
        parent::__construct($name);
        $this->createFilmHandler = $createFilmHandler;
        $this->getActorHandler = $cacheActorRepository;
    }

    protected function configure()
    {
        $this
            ->setName("film:create")
            ->addArgument('name', InputArgument::REQUIRED, 'The name to Actor')
            ->addArgument('description', InputArgument::REQUIRED, 'The name to Actor')
            ->addArgument('actor', InputArgument::REQUIRED, 'The name to Actor');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $description = $input->getArgument('description');
        $actor = $input->getArgument('actor');

        $actor = $this->getActorHandler->findById($actor);
        $command = new CreateFilmCommand($name, $description, $actor);
        $this->createFilmHandler->handle($command);
        // $output->writeln('Whoa!');
        $output->writeln('$name: ' . $input->getArgument('name'));
        $output->writeln('$description: ' . $description);
        $output->writeln('$actord: ' . $command->getName());

    }
}