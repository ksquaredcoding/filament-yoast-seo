<?php

namespace Outreach\Filament\FilamentYoastSeo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Outreach\Filament\FilamentYoastSeo\FilamentYoastSeo
 */
class FilamentYoastSeo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Outreach\Filament\FilamentYoastSeo\FilamentYoastSeo::class;
    }
}
