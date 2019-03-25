<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 9:13 PM
 */

namespace FilmApi\AppBundle\Repository;


use FilmApi\Application\Command\Film\UpdateFilmCommand;
use FilmApi\Domain\Film;
use FilmApi\Domain\Repository\FilmRepository;
use Psr\Cache\CacheItemPoolInterface;

class CacheFilmRepository
{
    private $em;
    private $cache;

    public function __construct(FilmRepository $filmRepository, CacheItemPoolInterface $cache)
    {
        $this->em = $filmRepository;
        $this->cache = $cache;
    }

    public function  deleteCache(int $filmId)
    {
        $this->cache->deleteItem((string) "film_$filmId");
    }

    public function findById(int $filmId): Film
    {
        $item = $this->cache->getItem((string) "film_".$filmId);
        if (!$item->isHit()) {
            $film = $this->em->findById($filmId);
            $item->set($film);
            $this->cache->save($item);
            if (!$film) {
                throw UnknownPostException::withPostId($filmId);
            }
        }
        return $item->get();
    }
}