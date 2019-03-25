<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 10:45 PM
 */

namespace FilmApi\Domain\Exception;


class UnknownActorException extends BadOperationException
{
    public $actorId;

    private function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withPostId(int $id):self
    {
        $e = new static("Actor with id [$id] doesn't exist");
        $e->actorId = $id;
        return $e;
    }
}