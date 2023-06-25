<?php

namespace App\Filament\Resources\PortfolioResource\Pages;

use App\Filament\Resources\PortfolioResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePortfolios extends ManageRecords
{
    protected static string $resource = PortfolioResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
