<?php

namespace Outreach\Filament\FilamentYoastSeo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Outreach\Filament\Forms\Components\FilamentYoastSeo
 */
class FilamentYoastSeo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Outreach\Filament\Forms\Components\FilamentYoastSeo::class;
    }
}
