<?php

namespace App\Filament\Admin\Resources\RpsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\CourseLearningOutcome;

class CpmksRelationManager extends RelationManager
{
    protected static string $relationship = 'cpmks';

    protected static ?string $title = 'CPMK';

    protected static ?string $modelLabel = 'CPMK';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode CPMK')
                    ->required()
                    ->maxLength(50)
                    ->columnSpan(1),

                Forms\Components\TextInput::make('description')
                    ->label('Deskripsi CPMK')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                Forms\Components\Textarea::make('detail')
                    ->label('Detail CPMK')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->wrap()
                    ->searchable(),

                Tables\Columns\TextColumn::make('detail')
                    ->label('Detail')
                    ->wrap()
                    ->limit(100)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Pilih CPMK')
                            ->options(
                                CourseLearningOutcome::orderBy('code')
                                    ->get()
                                    ->mapWithKeys(fn ($item) => [$item->id => "{$item->code} - {$item->description}"])
                                    ->toArray()
                            )
                            ->searchable(),
                    ])
                    ->modalWidth('3xl'),

                Tables\Actions\CreateAction::make()
                    ->modalHeading('Buat CPMK Baru')
                    ->modalWidth('3xl'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth('3xl'),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada CPMK')
            ->emptyStateDescription('Tambahkan CPMK pertama Anda.')
            ->emptyStateActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Pilih CPMK')
                            ->options(
                                CourseLearningOutcome::orderBy('code')
                                    ->get()
                                    ->mapWithKeys(fn ($item) => [$item->id => "{$item->code} - {$item->description}"])
                                    ->toArray()
                            )
                            ->searchable(),
                    ])
                    ->modalWidth('3xl'),

                Tables\Actions\CreateAction::make()
                    ->modalHeading('Buat CPMK Baru')
                    ->modalWidth('3xl'),
            ]);
    }
}
