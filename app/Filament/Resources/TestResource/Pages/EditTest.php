<?php

namespace App\Filament\Resources\TestResource\Pages;

use Filament\Actions;
use App\Filament\Resources\TestResource;
use Filament\Resources\Pages\EditRecord;

class EditTest extends EditRecord
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
