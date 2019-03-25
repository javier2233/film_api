<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 6:17 PM
 */

namespace FilmApi\Application\CommandHandler\Film;


use FilmApi\Domain\Film;
use FilmApi\Domain\Repository\FilmRepository;

class GetFilmHandler
{
    private $filmRepository;

    public function  __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function  handle (int $filmId):Film{
        $film = $this->filmRepository->findById($filmId);
        return $film;
    }
}