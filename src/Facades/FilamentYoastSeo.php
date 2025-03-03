<?php

namespace Outreach\Filament\FilamentYoastSeo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Outreach\FilamentYoastSeo\Forms\Components\FilamentYoastSeo
 */
class FilamentYoastSeo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Outreach\FilamentYoastSeo\Forms\Components\FilamentYoastSeo::class;
    }
}
