<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 3:20 PM
 */

namespace FilmApi\AppBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use FilmApi\Domain\Exception\RepositoryException;
use FilmApi\Domain\Exception\UnknownFilmException;
use FilmApi\Domain\Film;
use FilmApi\Domain\Repository\FilmRepository;

class MySQLFilmRepository implements FilmRepository
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;

    }

    public function save(Film $film): void
    {
        $this->em->persist($film);
        $this->em->flush();

    }

    public function delete(int $id): void
    {
        $film = $this->findById($id);
        try{
            $this->em->remove($film);

        }catch (RepositoryException $e){
            exit($e->getMessage());
        }
    }

    public function update(Film $film): Film
    {
        $this->save($film);
        return $film;
    }

    public function findById(int $filmId): Film
    {
        try {
            $query = $this->em->createQueryBuilder()
                ->select('f','c')
                ->from('FilmApi\Domain\Film', 'f')
                ->leftJoin('f.actor', 'c')
                ->where("f.id = $filmId");
            $film =($query->getQuery()->getResult());
            if (count($film) === 0) {
                throw UnknownFilmException::withPostId($filmId);
            }
            return $film[0];
        } catch (RepositoryException $e) {
            exit($e->getMessage());
        }
    }

    public function findAll(): array
    {
        try {
            $query = $this->em->createQueryBuilder()
                ->select('f','c')
                ->from('FilmApi\Domain\Film', 'f')
                ->leftJoin('f.actor', 'c');

            return $query->getQuery()->getResult();
         } catch (Exception $e) {
          exit($e->getMessage());
        }
    }

    public function search(int $id):Film
    {
        return $this->em->getRepository('AppBundle:Film')->find($id);
    }
}