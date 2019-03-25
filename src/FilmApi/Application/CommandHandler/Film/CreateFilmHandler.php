<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 2:17 PM
 */

namespace FilmApi\Application\CommandHandler\Film;


use FilmApi\Application\Command\Film\CreateFilmCommand;
use FilmApi\Domain\Film;
use FilmApi\Domain\Repository\FilmRepository;

class CreateFilmHandler
{
    private $filmRepository;

    public function  __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function  handle (CreateFilmCommand $command):Film{
        $film = Film::create($command->getName(), $command->getDescription(), $command->getActor());
        $this->filmRepository->save($film);
        return $film;
    }
}