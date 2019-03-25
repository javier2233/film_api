<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 23/03/2019
 * Time: 1:41 PM
 */

namespace FilmApi\Domain\Repository;

use FilmApi\Domain\Film;
interface FilmRepository
{
    public function save(Film $film):void;
    public function delete(int $id):void;
    public function update(Film $film):Film;
    public function findById(int $filmId):Film;
    public function findAll():Array;
    public function search(int $id);

}