<?php

namespace Masterix21\Skeleton;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Masterix21\Skeleton\Boilerplate
 */
class BoilerplateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'skeleton';
    }
}
