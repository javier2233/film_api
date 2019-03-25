<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 2:17 PM
 */

namespace FilmApi\Application\CommandHandler\Film;


use FilmApi\Domain\Repository\FilmRepository;

class AllFilmHandler
{
    private $filmRepository;

    public function  __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }


    public function  handle ():array
    {
        $films = $this->filmRepository->findAll();
        //print_r($films);exit();
        return $films;
    }
}