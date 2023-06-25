<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-annotation';

    protected static ?string $navigationGroup = 'Utilities';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Card::make([
                    Forms\Components\FileUpload::make('user_avatar')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('feedback')
                    ->rules(['nullable', 'mimes:jpg,jpeg,png']),
                Forms\Components\TextInput::make('user_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('rating')
                    ->maxLength(255),
                Forms\Components\TextInput::make('project')
                    ->maxLength(255),
                Forms\Components\TextInput::make('client')
                    ->maxLength(255),
                ])->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('user_avatar'),
                Tables\Columns\TextColumn::make('user_name'),
                Tables\Columns\TextColumn::make('message'),
                Tables\Columns\TextColumn::make('rating'),
                Tables\Columns\TextColumn::make('project'),
                Tables\Columns\TextColumn::make('client'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'view' => Pages\ViewFeedback::route('/{record}'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
