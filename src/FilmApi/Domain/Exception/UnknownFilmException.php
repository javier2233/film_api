<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 10:45 PM
 */

namespace FilmApi\Domain\Exception;


class UnknownFilmException extends BadOperationException
{
    public $filmId;

    private function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withPostId(int $id):self
    {
        $e = new static("Film with id [$id] doesn't exist");
        $e->filmId = $id;
        return $e;
    }

}