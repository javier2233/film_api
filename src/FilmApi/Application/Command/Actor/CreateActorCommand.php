<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 23/03/2019
 * Time: 2:37 PM
 */

namespace FilmApi\Application\Command\Actor;


class CreateActorCommand
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}