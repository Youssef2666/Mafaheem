<?php

namespace App\Filament\Resources\RoadMapResource\Pages;

use App\Filament\Resources\RoadMapResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoadMap extends EditRecord
{
    protected static string $resource = RoadMapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
