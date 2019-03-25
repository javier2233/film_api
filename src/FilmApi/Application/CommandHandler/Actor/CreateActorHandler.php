<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 23/03/2019
 * Time: 2:31 PM
 */

namespace FilmApi\Application\CommandHandler\Actor;


use FilmApi\Application\Command\Actor\CreateActorCommand;
use FilmApi\Domain\Actor;
use FilmApi\Domain\Repository\ActorRepository;

class CreateActorHandler
{
    private $actorRepository;

    public function  __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function  handle (CreateActorCommand $command):Actor{
        $actor = Actor::create($command->getName());
        $this->actorRepository->save($actor);
        return $actor;
    }
}