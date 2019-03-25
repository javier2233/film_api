<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 3:44 PM
 */

namespace FilmApi\Application\CommandHandler\Actor;


use FilmApi\Domain\Actor;
use FilmApi\Domain\Repository\ActorRepository;

class GetActorHandler
{
    private $actorRepository;

    public function  __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function  handle (int $actorId):Actor{
        $actor = $this->actorRepository->findById($actorId);
        return $actor;
    }
}