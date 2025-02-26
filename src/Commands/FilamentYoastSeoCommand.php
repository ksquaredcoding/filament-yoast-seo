<?php

namespace Outreach\Filament\FilamentYoastSeo\Commands;

use Illuminate\Console\Command;

class FilamentYoastSeoCommand extends Command
{
    public $signature = 'filament-yoast-seo';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
