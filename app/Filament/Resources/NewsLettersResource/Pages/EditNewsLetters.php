<?php

namespace App\Filament\Resources\NewsLettersResource\Pages;

use App\Filament\Resources\NewsLettersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsLetters extends EditRecord
{
    protected static string $resource = NewsLettersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
