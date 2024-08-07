<?php

namespace App\Filament\Resources\LabRequestResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\LabRequestResource;

class EditLabRequest extends EditRecord
{
    protected static string $resource = LabRequestResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['test_results'] = $this->record->tests->map(function ($test) {
            return [
                'test_id' => $test->id,
                'results' => $test->pivot->results ?? '',
            ];
        })->toArray();

        return $data;
    }

    protected function afterSave(): void
    {
        $testResults = $this->data['test_results'] ?? [];
        foreach ($testResults as $result) {
            $this->record->tests()->updateExistingPivot($result['test_id'], ['results' => $result['results']]);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
