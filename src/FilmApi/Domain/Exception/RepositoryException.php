<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 10:47 PM
 */

namespace FilmApi\Domain\Exception;


use Exception;
use Throwable;

class RepositoryException extends Exception
{
    private function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withError(Throwable $repositoryException):self
    {
        return new static(
            "There has being an error while using the repository",
            0,
            $repositoryException
        );
    }
}