<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProfilLulusanResource\Pages;
use App\Filament\Admin\Resources\ProfilLulusanResource\RelationManagers;
use App\Models\ProfilLulusan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfilLulusanResource extends Resource
{
    protected static ?string $model = ProfilLulusan::class;

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
            'index' => Pages\ListProfilLulusans::route('/'),
            'create' => Pages\CreateProfilLulusan::route('/create'),
            'edit' => Pages\EditProfilLulusan::route('/{record}/edit'),
        ];
    }
}
