<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 3:16 PM
 */

namespace FilmApi\Application\Command\Film;


class CreateFilmCommand
{
    private $name;
    private $description;
    private $actor;


    public function __construct($name, $description, $actor)
    {
        $this->name = $name;
        $this->description = $description;
        $this->actor = $actor;
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