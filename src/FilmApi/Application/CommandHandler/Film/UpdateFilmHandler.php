<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 4:15 PM
 */

namespace FilmApi\Application\CommandHandler\Film;


use FilmApi\Application\Command\Film\UpdateFilmCommand;
use FilmApi\Domain\Film;
use FilmApi\Domain\Repository\FilmRepository;

class UpdateFilmHandler
{
    private $filmRepository;

    public function  __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function  handle (UpdateFilmCommand $command):Film{

        $film = $this->filmRepository->findById($command->getId());
        if ($film){
            $film->setName($command->getName());
            $film->setDescription($command->getDescription());
            $film->setActor($command->getActor());
            $film = $this->filmRepository->update($film);


        }
        return $film;
    }
}