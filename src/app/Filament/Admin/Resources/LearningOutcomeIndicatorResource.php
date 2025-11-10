<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LearningOutcomeResource\Pages;
use App\Models\LearningOutcome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LearningOutcomeResource extends Resource
{
    protected static ?string $model = LearningOutcome::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Capaian Pembelajaran (CPL)';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('code')
                ->label('Kode CPL')
                ->required()
                ->maxLength(10),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi CPL')
                ->required()
                ->rows(3),

            Forms\Components\HasManyRepeater::make('indicators')
                ->relationship('indicators')
                ->label('Indikator Capaian (IK)')
                ->schema([
                    Forms\Components\TextInput::make('code')
                        ->label('Kode IK')
                        ->required(),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi IK')
                        ->required()
                        ->rows(2),
                ])
                ->columns(2)
                ->createItemButtonLabel('Tambah Indikator'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode CPL')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi CPL')
                    ->limit(80)
                    ->wrap(),

                Tables\Columns\TextColumn::make('indicators_count')
                    ->counts('indicators')
                    ->label('Jumlah IK'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLearningOutcomes::route('/'),
            'create' => Pages\CreateLearningOutcome::route('/create'),
            'edit' => Pages\EditLearningOutcome::route('/{record}/edit'),
        ];
    }
}
