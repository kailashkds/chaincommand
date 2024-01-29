<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Handles the bootstrapping and initialization of the application.
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
