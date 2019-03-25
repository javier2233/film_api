<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 23/03/2019
 * Time: 6:29 PM
 */

namespace FilmApi\AppBundle\Repository;


use Doctrine\ORM\EntityManagerInterface;
use FilmApi\Domain\Actor;
use FilmApi\Domain\Exception\RepositoryException;
use FilmApi\Domain\Exception\UnknownActorException;
use FilmApi\Domain\Repository\ActorRepository;
use Exception;
class MySQLActorRepository implements ActorRepository
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function save(Actor $actor):void
    {
        $this->em->persist($actor);

    }
    public function delete(int $id):void
    {
        $actor = $this->findById($id);
        try{
            $this->em->remove($actor);

        }catch (Exception $e){
            exit($e->getMessage());
        }
    }
    public function update(Actor $actor):void
    {
        $this->save($actor);
    }
    public function findById(int $actorId):Actor
    {
        $actor = $this->em
            ->getRepository('AppBundle:Actor')
            ->findBy(['id' => $actorId]);
        if (count($actor) === 0) {
            throw UnknownActorException::withPostId($actorId);
        }
        return $actor[0];
    }
    public function findAll():array{
        #try {
            return $this->em->getRepository('AppBundle:Actor')->findAll();
       # } catch (Exception $e) {
       #     throw RepositoryException::withError($e);
        #}
    }

    public function search(int $id)
    {
        return $this->em->getRepository('AppBundle:Actor')->find($id);
    }


}