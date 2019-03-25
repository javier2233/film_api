<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 11:56 AM
 */

namespace FilmApi\Application\CommandHandler\Actor;


use FilmApi\Application\Command\Actor\CreateActorCommand;
use FilmApi\Domain\Repository\ActorRepository;

class DeleteActorHandler
{
    private $actorRepository;

    public function  __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }


    public function  handle (int $id):void
    {
        $this->actorRepository->delete($id);
    }
}