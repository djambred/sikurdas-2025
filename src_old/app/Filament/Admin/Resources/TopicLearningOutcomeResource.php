<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TopicLearningOutcomeResource\Pages;
use App\Filament\Admin\Resources\TopicLearningOutcomeResource\RelationManagers;
use App\Models\TopicLearningOutcome;
use App\Models\CourseLearningOutcome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopicLearningOutcomeResource extends Resource
{
    protected static ?string $model = TopicLearningOutcome::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'OBEData';
    protected static ?string $pluralModelLabel = 'Sub-CPMK';
    protected static ?string $modelLabel = 'Sub-CPMK';
    protected static ?string $recordTitleAttribute = 'code';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Sub-CPMK')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Kode Sub-CPMK')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: Sub-CPMK1.1'),

                        Forms\Components\Select::make('course_learning_outcome_id')
                            ->label('CPMK Induk')
                            ->relationship('courseLearningOutcome', 'code')
                            ->required()
                            ->preload()
                            ->searchable()
                            ->getOptionLabelFromRecordUsing(fn (CourseLearningOutcome $record) => "{$record->code} - {$record->description}"),

                        Forms\Components\Textarea::make('detail')
                            ->label('Deskripsi Sub-CPMK')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Deskripsi detail tentang apa yang harus dikuasai mahasiswa...'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Konfigurasi Pembelajaran')
                    ->schema([
                        Forms\Components\Select::make('complexity_level')
                            ->label('Tingkat Kompleksitas')
                            ->required()
                            ->options([
                                'basic' => 'Basic',
                                'intermediate' => 'Intermediate',
                                'advanced' => 'Advanced',
                            ])
                            ->default('basic'),

                        Forms\Components\Select::make('assessment_type')
                            ->label('Jenis Penilaian')
                            ->required()
                            ->options([
                                'knowledge' => 'Knowledge',
                                'skill' => 'Skill',
                                'competence' => 'Competence',
                            ])
                            ->default('skill'),

                        Forms\Components\TextInput::make('order')
                            ->label('Urutan')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Komponen Global')
                    ->schema([
                        Forms\Components\Toggle::make('has_english_component')
                            ->label('Memiliki Komponen Bahasa Inggris')
                            ->default(false)
                            ->inline(false),

                        Forms\Components\Toggle::make('has_global_context')
                            ->label('Memiliki Konteks Global')
                            ->default(false)
                            ->inline(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('courseLearningOutcome.code')
                    ->label('CPMK Induk')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('detail')
                    ->label('Deskripsi')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                Tables\Columns\TextColumn::make('complexity_level')
                    ->label('Kompleksitas')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'basic' => 'success',
                        'intermediate' => 'warning',
                        'advanced' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('assessment_type')
                    ->label('Jenis Penilaian')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'knowledge' => 'gray',
                        'skill' => 'blue',
                        'competence' => 'green',
                    }),

                Tables\Columns\IconColumn::make('has_english_component')
                    ->label('English')
                    ->boolean()
                    ->trueIcon('heroicon-o-language')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\IconColumn::make('has_global_context')
                    ->label('Global')
                    ->boolean()
                    ->trueIcon('heroicon-o-globe-alt')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('info')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('course_learning_outcome_id')
                    ->label('CPMK Induk')
                    ->relationship('courseLearningOutcome', 'code')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('complexity_level')
                    ->label('Tingkat Kompleksitas')
                    ->options([
                        'basic' => 'Basic',
                        'intermediate' => 'Intermediate',
                        'advanced' => 'Advanced',
                    ]),

                Tables\Filters\SelectFilter::make('assessment_type')
                    ->label('Jenis Penilaian')
                    ->options([
                        'knowledge' => 'Knowledge',
                        'skill' => 'Skill',
                        'competence' => 'Competence',
                    ]),

                Tables\Filters\TernaryFilter::make('has_english_component')
                    ->label('Memiliki Komponen English'),

                Tables\Filters\TernaryFilter::make('has_global_context')
                    ->label('Memiliki Konteks Global'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('course_learning_outcome_id')
            ->groups([
                Tables\Grouping\Group::make('courseLearningOutcome.code')
                    ->label('CPMK Induk')
                    ->collapsible(),
            ])
            ->groupingSettingsHidden();
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relations jika diperlukan nanti
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopicLearningOutcomes::route('/'),
            'create' => Pages\CreateTopicLearningOutcome::route('/create'),
            'edit' => Pages\EditTopicLearningOutcome::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('courseLearningOutcome')
            ->ordered();
    }
}
