<?php

namespace Modules\Socialite\Platforms;

interface FactoryInterface
{
    public function handle(string $return = '');
}