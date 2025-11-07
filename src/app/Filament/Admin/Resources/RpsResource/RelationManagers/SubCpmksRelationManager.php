<?php

namespace App\Filament\Admin\Resources\RpsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\TopicLearningOutcome;

class SubCpmksRelationManager extends RelationManager
{
    protected static string $relationship = 'subCpmks';

    protected static ?string $title = 'Sub-CPMK';

    protected static ?string $modelLabel = 'Sub-CPMK';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Sub-CPMK')
                    ->required()
                    ->maxLength(50)
                    ->columnSpan(1),

                Forms\Components\Textarea::make('detail')
                    ->label('Deskripsi Sub-CPMK')
                    ->required()
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

                Tables\Columns\TextColumn::make('detail')
                    ->label('Deskripsi')
                    ->wrap()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Pilih Sub-CPMK')
                            ->options(
                                TopicLearningOutcome::orderBy('code')
                                    ->get()
                                    ->mapWithKeys(fn ($item) => [$item->id => "{$item->code} - {$item->detail}"])
                                    ->toArray()
                            )
                            ->searchable(),
                    ])
                    ->modalWidth('3xl'),

                Tables\Actions\CreateAction::make()
                    ->modalHeading('Buat Sub-CPMK Baru')
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
            ->emptyStateHeading('Belum ada Sub-CPMK')
            ->emptyStateDescription('Tambahkan Sub-CPMK pertama Anda.')
            ->emptyStateActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Pilih Sub-CPMK')
                            ->options(
                                TopicLearningOutcome::orderBy('code')
                                    ->get()
                                    ->mapWithKeys(fn ($item) => [$item->id => "{$item->code} - {$item->detail}"])
                                    ->toArray()
                            )
                            ->searchable(),
                    ])
                    ->modalWidth('3xl'),

                Tables\Actions\CreateAction::make()
                    ->modalHeading('Buat Sub-CPMK Baru')
                    ->modalWidth('3xl'),
            ]);
    }
}
