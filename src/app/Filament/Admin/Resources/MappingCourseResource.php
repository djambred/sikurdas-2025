<?php

namespace App\Filament\Admin\Resources;

use App\Models\Course;
use App\Models\Category;
use App\Models\Major;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use App\Filament\Admin\Resources\MappingCourseResource\Pages;
use Filament\Tables\Columns\TagsColumn;
use Filament\Forms\Get;
use Filament\Notifications\Notification;

class MappingCourseResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Mapping Mata Kuliah';
    protected static ?string $pluralModelLabel = 'Mapping Mata Kuliah';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = -7;

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['major', 'category', 'prerequisites', 'pl', 'cpl', 'ik', 'cpmk'])
            ->orderBy('semester', 'asc');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('major_id')
                ->label('Program Studi')
                ->relationship('major', 'name')
                ->options(Major::pluck('name', 'id'))
                ->disabled(fn(string $operation) => $operation !== 'create')
                ->required(),

            Forms\Components\TextInput::make('nama')
                ->label('Nama Mata Kuliah')
                ->disabled()
                ->dehydrated(false),

            Forms\Components\Select::make('category_id')
                ->label('Kategori')
                ->options(Category::pluck('name', 'id'))
                ->searchable()
                ->required(),

            Forms\Components\MultiSelect::make('prerequisites')
                ->label('Prasyarat')
                ->relationship('prerequisites', 'nama')
                ->placeholder('Pilih mata kuliah prasyarat')
                ->searchable()
                ->preload()
                ->helperText('Hanya mata kuliah dari semester sebelumnya yang dapat dipilih')
                ->live()
                ->afterStateUpdated(function ($state, Get $get) {
                    if (!empty($state)) {
                        $currentId = $get('id');
                        if ($currentId && self::hasCircularDependency($currentId, $state)) {
                            Notification::make()
                                ->title('Peringatan')
                                ->body('Terdeteksi circular dependency. Silakan periksa kembali prasyarat.')
                                ->warning()
                                ->send();
                        }
                    }
                }),

            Forms\Components\TextInput::make('sks')
                ->numeric()
                ->label('Jumlah SKS')
                ->disabled()
                ->dehydrated(false),

            Forms\Components\TextInput::make('semester')
                ->numeric()
                ->label('Semester')
                ->disabled()
                ->dehydrated(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                self::createTreeAction('treeSI', '🌳 Tree SI', 'success', 'heroicon-o-academic-cap', 'Struktur Prasyarat - Sistem Informasi', 'Sistem Informasi'),
                self::createTreeAction('treeTI', '🌲 Tree TI', 'info', 'heroicon-o-globe-alt', 'Struktur Prasyarat - Teknik Informatika', 'Teknik Informatika'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('major.name')->label('Program Studi')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kode')->label('Kode')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nama')->label('Mata Kuliah')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sks')->label('SKS')->sortable(),
                Tables\Columns\TextColumn::make('semester')->label('Semester')->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori')->sortable(),

                TagsColumn::make('prerequisites.nama')
                    ->label('Prasyarat')
                    ->limit(99)
                    ->separator(', ')
                    ->extraAttributes(['class' => 'whitespace-normal']),

                TagsColumn::make('pl.description')
                    ->label('PL')
                    ->limit(99)
                    ->separator(', ')
                    ->extraAttributes(['class' => 'whitespace-normal']),

                TagsColumn::make('cpl.description')
                    ->label('CPL')
                    ->limit(99)
                    ->separator(', ')
                    ->extraAttributes(['class' => 'whitespace-normal']),

                TagsColumn::make('ik.description')
                    ->label('IK')
                    ->limit(99)
                    ->separator(', ')
                    ->extraAttributes(['class' => 'whitespace-normal']),

                TagsColumn::make('cpmk.description')
                    ->label('CPMK')
                    ->limit(99)
                    ->separator(', ')
                    ->extraAttributes(['class' => 'whitespace-normal']),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('major_id')->label('Program Studi')->relationship('major', 'name'),
                Tables\Filters\SelectFilter::make('semester')->label('Semester')->options(array_combine(range(1,8), range(1,8))),
            ])
            ->actions([Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    protected static function createTreeAction(string $name, string $label, string $color, string $icon, string $heading, ?string $majorName = null): Tables\Actions\Action
    {
        return Tables\Actions\Action::make($name)
            ->label($label)
            ->color($color)
            ->icon($icon)
            ->modalHeading($heading)
            ->modalContent(function () use ($majorName, $heading) {
                $query = Course::with(['major:id,name', 'prerequisites:id,kode,nama,semester,sks', 'pl', 'cpl', 'ik', 'cpmk']);
                if ($majorName) $query->whereHas('major', fn($q) => $q->where('name', $majorName));
                $courses = $query->get(['id','kode','nama','semester','sks','major_id']);

                $processedData = $courses->map(fn($course) => [
                    'id' => $course->id,
                    'kode' => $course->kode,
                    'nama' => $course->nama,
                    'sks' => $course->sks ?? '?',
                    'semester' => $course->semester ?? '?',
                    'major' => $course->major->name ?? '-',
                    'prerequisites' => $course->prerequisites->pluck('id')->toArray(),
                    'pl' => $course->pl->map(fn($x) => ['description' => $x->description])->all(),
                    'cpl' => $course->cpl->map(fn($x) => ['description' => $x->description])->all(),
                    'ik' => $course->ik->map(fn($x) => ['description' => $x->description])->all(),
                    'cpmk' => $course->cpmk->map(fn($x) => ['description' => $x->description])->all(),
                ]);

                return view('filament.custom.course-tree-blade-only', [
                    'title' => $heading,
                    'courses' => $processedData,
                ]);
            })
            ->modalWidth('full');
    }

    protected static function hasCircularDependency(int $courseId, array $prerequisiteIds, array $visited = []): bool
    {
        if (in_array($courseId, $visited)) return true;
        $visited[] = $courseId;

        foreach ($prerequisiteIds as $prereqId) {
            $course = Course::with('prerequisites:id')->find($prereqId);
            if ($course && $course->prerequisites->isNotEmpty()) {
                if (self::hasCircularDependency($courseId, $course->prerequisites->pluck('id')->toArray(), $visited)) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMappingCourses::route('/'),
            'create' => Pages\CreateMappingCourse::route('/create'),
            'edit' => Pages\EditMappingCourse::route('/{record}/edit'),
        ];
    }
}
