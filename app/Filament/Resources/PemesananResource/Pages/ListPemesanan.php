<?php

namespace App\Filament\Resources\PemesananResource\Pages;

use App\Filament\Resources\PemesananResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemesanan extends ListRecords
{
    protected static string $resource = PemesananResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}