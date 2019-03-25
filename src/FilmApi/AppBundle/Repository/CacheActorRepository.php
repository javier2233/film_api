<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 8:35 PM
 */

namespace FilmApi\AppBundle\Repository;


use FilmApi\Application\CommandHandler\Actor\GetActorHandler;
use FilmApi\Domain\Actor;
use FilmApi\Domain\Repository\ActorRepository;
use Psr\Cache\CacheItemPoolInterface;

class CacheActorRepository
{
    private $em;
    private $cache;

    public function __construct(ActorRepository $entityManager, CacheItemPoolInterface $cache,GetActorHandler $actorHandler)
    {
        $this->em = $entityManager;
        $this->actorHandler = $actorHandler;
        $this->cache = $cache;
    }

    public function handle(int $actorId):Actor
    {
        $actor = $this->actorHandler->handle($actorId);
        return $actor;
    }


    public function findById(int $actorId):Actor
    {
        $item = $this->cache->getItem((string) $actorId);
        if (!$item->isHit()) {
            $actor = $this->em->findById($actorId);
            $item->set($actor);
            $this->cache->save($item);
            if (!$actor) {
                throw UnknownPostException::withPostId($actorId);
            }


        }
        return $item->get();
    }

}