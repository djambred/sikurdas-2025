<?php

namespace App\Filament\Admin\Resources;

use App\Models\Course;
use App\Models\Category;
use App\Models\Major; // Import model Major
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use App\Filament\Admin\Resources\MappingCourseResource\Pages;
use Filament\Tables\Columns\TagsColumn;

class MappingCourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Mapping Mata Kuliah';
    protected static ?string $pluralModelLabel = 'Mapping Mata Kuliah';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->orderBy('semester', 'asc');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            // === PENAMBAHAN: major_id (Program Studi) ===
            Forms\Components\Select::make('major_id')
                ->label('Program Studi')
                ->relationship('major', 'name') // Menggunakan relasi 'major' yang sudah didefinisikan
                ->options(Major::pluck('name', 'id'))
                ->disabled(fn (string $operation): bool => $operation !== 'create') // Disabled saat edit
                ->required(),

            // tampilkan nama course (disabled saat edit)
            Forms\Components\TextInput::make('nama')
                ->label('Nama Mata Kuliah')
                ->disabled(),

            // category_id seperti sebelumnya
            Forms\Components\Select::make('category_id')
                ->label('Kategori')
                ->options(Category::pluck('name', 'id'))
                ->searchable()
                ->required(),

            // MultiSelect untuk many-to-many prasyarat
            Forms\Components\MultiSelect::make('prerequisites') // gunakan nama relasi
                ->label('Prasyarat (pilih satu/lebih)')
                ->relationship('prerequisites', 'nama')
                ->placeholder('Pilih mata kuliah prasyarat')
                ->reactive()
                ->columns(1)
                ->hint('Pilih mata kuliah yang menjadi prasyarat (bisa lebih dari 1)')
                ->required(false),

            // tampilkan SKS & Semester (read-only)
            Forms\Components\TextInput::make('sks')
                ->numeric()
                ->label('Jumlah SKS')
                ->disabled(),

            Forms\Components\TextInput::make('semester')
                ->numeric()
                ->label('Semester')
                ->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // === PENAMBAHAN: Major Name ===
                Tables\Columns\TextColumn::make('major.name')
                    ->label('Program Studi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode')->label('Kode')->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Mata Kuliah'),

                Tables\Columns\TextColumn::make('sks')
                    ->label('SKS'),

                Tables\Columns\TextColumn::make('semester')
                    ->label('Semester'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori'),
                TagsColumn::make('prerequisites.nama')
                    ->label('Prasyarat')
                    ->separator(', ')
                    ->limit(50)
                    ->sortable(),
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMappingCourses::route('/'),
            'create' => Pages\CreateMappingCourse::route('/create'),
            'edit'   => Pages\EditMappingCourse::route('/{record}/edit'),
        ];
    }
}
