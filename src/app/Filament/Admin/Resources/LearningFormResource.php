<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LearningFormResource\Pages;
use App\Filament\Admin\Resources\LearningFormResource\RelationManagers;
use App\Models\LearningForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LearningFormResource extends Resource
{
    protected static ?string $model = LearningForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListLearningForms::route('/'),
            'create' => Pages\CreateLearningForm::route('/create'),
            'edit' => Pages\EditLearningForm::route('/{record}/edit'),
        ];
    }
}
