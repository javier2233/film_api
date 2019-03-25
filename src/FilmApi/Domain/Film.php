<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 23/03/2019
 * Time: 1:03 PM
 */

namespace FilmApi\Domain;


class Film
{
    private $id;
    private $name;
    private $description;
    private $actor;

    private function __construct(string $name, string $description, Actor $actor)
    {
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
        $this->description = filter_var($description, FILTER_SANITIZE_STRING);
        $this->actor = $actor;
    }

    public static function create(string $name, string $description, Actor $actor):self
    {
        return new self($name, $description, $actor);
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param Actor $actor
     */
    public function setActor(Actor $actor): void
    {
        $this->actor = $actor;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Actor
     */
    public function getActor(): Actor
    {
        return $this->actor;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function toArray():array
    {
        $actor = $this->getActor();

        return [
            'id'          => $this->getId(),
            'name'       => $this->getName(),
            'despriction'       => $this->getDescription(),
            'actor'       => ['id' => $actor->getId(), 'name' => $actor->getName()]
        ];
    }
}