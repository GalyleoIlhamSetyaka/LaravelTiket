<?php

namespace App\Filament\Resources\PemesananResource\Pages;

use App\Filament\Resources\PemesananResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePemesanan extends CreateRecord
{
    protected static string $resource = PemesananResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}