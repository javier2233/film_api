<?php

namespace FilmApi\AppBundle;

use FilmApi\AppBundle\DependecyInjection\FilmApiExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new FilmApiExtension();
    }
}
