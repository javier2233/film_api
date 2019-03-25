<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 12:30 PM
 */

namespace FilmApi\Application\CommandHandler\Actor;


use FilmApi\Domain\Repository\ActorRepository;

class AllActorHandler
{
    private $actorRepository;

    public function  __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }


    public function  handle ():array
    {
        return $this->actorRepository->findAll();
    }
}