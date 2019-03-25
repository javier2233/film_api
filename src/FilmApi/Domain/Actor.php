<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 23/03/2019
 * Time: 1:03 PM
 */

namespace FilmApi\Domain;


class Actor
{
    private $id;
    private $name;


    private function __construct(string $name)
    {
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
    }

    public static function create(string $name):self
    {
        return new self($name);
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
    public function getId()
    {
        return $this->id;
    }

    public function toArray():array
    {
        return [
            'id'          => $this->getId(),
            'name'       => $this->getName(),
        ];
    }
}