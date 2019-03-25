<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 2:18 PM
 */

namespace FilmApi\Application\CommandHandler\Film;


use FilmApi\Domain\Repository\FilmRepository;

class DeleteFilmHandler
{
    private $filmRepository;

    public function  __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }


    public function  handle (int $id):void
    {
        $this->filmRepository->delete($id);
    }
}