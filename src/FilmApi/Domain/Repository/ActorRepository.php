<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 23/03/2019
 * Time: 1:41 PM
 */

namespace FilmApi\Domain\Repository;

use FilmApi\Domain\Actor;
interface ActorRepository
{
        public function save(Actor $actor):void;
        public function delete(int $id):void;
        public function update(Actor $actor):void;
        public function findById(int $actorId):Actor;
        public function findAll():array;
        public function search(int $id);

}