<?php

namespace App\Filament\Resources\RoadMapResource\Pages;

use App\Filament\Resources\RoadMapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoadMaps extends ListRecords
{
    protected static string $resource = RoadMapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
