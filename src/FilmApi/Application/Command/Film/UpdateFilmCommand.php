<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 4:14 PM
 */

namespace FilmApi\Application\Command\Film;


class UpdateFilmCommand
{
    private $id;
    private $name;
    private $description;
    private $actor;


    public function __construct($id, $name, $description, $actor)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->actor = $actor;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
}