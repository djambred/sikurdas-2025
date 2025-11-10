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

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Mapping Mata Kuliah';
    protected static ?string $pluralModelLabel = 'Mapping Mata Kuliah';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = -7;

    /**
     * Optimized query dengan eager loading untuk menghindari N+1 problem
     */
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['major', 'category', 'prerequisites'])
            ->orderBy('semester', 'asc');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('major_id')
                ->label('Program Studi')
                ->relationship('major', 'name')
                ->options(Major::pluck('name', 'id'))
                ->disabled(fn (string $operation): bool => $operation !== 'create')
                ->helperText(fn (string $operation): ?string =>
                    $operation === 'edit'
                        ? 'Program studi tidak dapat diubah setelah dibuat'
                        : null
                )
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
                ->label('Prasyarat (pilih satu/lebih)')
                ->relationship('prerequisites', 'nama', function ($query, Get $get) {
                    $currentId = $get('id');
                    $currentSemester = $get('semester');

                    // Filter hanya mata kuliah dari semester sebelumnya
                    if ($currentSemester) {
                        $query->where('semester', '<', $currentSemester);
                    }

                    // Exclude mata kuliah itu sendiri
                    if ($currentId) {
                        $query->where('id', '!=', $currentId);
                    }

                    // Filter berdasarkan major_id yang sama
                    $majorId = $get('major_id');
                    if ($majorId) {
                        $query->where('major_id', $majorId);
                    }
                })
                ->placeholder('Pilih mata kuliah prasyarat')
                ->searchable()
                ->preload()
                ->helperText('Hanya mata kuliah dari semester sebelumnya yang dapat dipilih')
                ->live()
                ->afterStateUpdated(function ($state, Get $get, $set) {
                    // Validasi circular dependency
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
                self::createTreeAction(
                    'treeSI',
                    '🌳 Tree SI',
                    'success',
                    'heroicon-o-academic-cap',
                    'Struktur Prasyarat - Sistem Informasi',
                    'Sistem Informasi'
                ),
                self::createTreeAction(
                    'treeTI',
                    '🌲 Tree TI',
                    'info',
                    'heroicon-o-globe-alt',
                    'Struktur Prasyarat - Teknik Informatika',
                    'Teknik Informatika'
                ),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('major.name')
                    ->label('Program Studi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Mata Kuliah')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sks')
                    ->label('SKS')
                    ->sortable(),

                Tables\Columns\TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),

                TagsColumn::make('prerequisites.nama')
                    ->label('Prasyarat')
                    ->separator(', ')
                    ->limit(3)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('major_id')
                    ->label('Program Studi')
                    ->relationship('major', 'name'),

                Tables\Filters\SelectFilter::make('semester')
                    ->label('Semester')
                    ->options([
                        1 => 'Semester 1',
                        2 => 'Semester 2',
                        3 => 'Semester 3',
                        4 => 'Semester 4',
                        5 => 'Semester 5',
                        6 => 'Semester 6',
                        7 => 'Semester 7',
                        8 => 'Semester 8',
                    ]),
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

    /**
     * Helper method untuk membuat tree action tanpa duplikasi kode
     */
    protected static function createTreeAction(
        string $name,
        string $label,
        string $color,
        string $icon,
        string $heading,
        ?string $majorName = null
    ): Tables\Actions\Action {
        return Tables\Actions\Action::make($name)
            ->label($label)
            ->color($color)
            ->icon($icon)
            ->modalHeading($heading)
            ->modalContent(function () use ($majorName, $heading) {
                $query = Course::query()
                    ->with(['prerequisites' => function ($query) {
                        $query->select('courses.id', 'courses.kode', 'courses.nama', 'courses.sks', 'courses.semester');
                    }]);

                if ($majorName) {
                    $query->whereHas('major', fn($q) => $q->where('name', $majorName));
                }

                $courses = $query->get(['id', 'kode', 'nama', 'sks', 'semester']);

                // Pre-process data di server side
                $processedData = $courses->map(function ($course) {
                    return [
                        'id' => $course->id,
                        'kode' => $course->kode,
                        'nama' => $course->nama,
                        'sks' => $course->sks ?? '?',
                        'semester' => $course->semester ?? '?',
                        'prerequisites' => $course->prerequisites->pluck('id')->toArray(),
                    ];
                });

                return view('filament.custom.course-tree-blade-only', [
                    'title' => $heading,
                    'courses' => $processedData,
                ]);
            })
            ->modalWidth('full');
    }

    /**
     * Check circular dependency
     * Fungsi rekursif untuk mengecek apakah ada circular dependency
     */
    protected static function hasCircularDependency(int $courseId, array $prerequisiteIds, array $visited = []): bool
    {
        if (in_array($courseId, $visited)) {
            return true; // Circular dependency detected
        }

        $visited[] = $courseId;

        foreach ($prerequisiteIds as $prereqId) {
            $course = Course::with('prerequisites')->find($prereqId);

            if ($course && $course->prerequisites->isNotEmpty()) {
                $nextPrereqIds = $course->prerequisites->pluck('id')->toArray();

                if (self::hasCircularDependency($courseId, $nextPrereqIds, $visited)) {
                    return true;
                }
            }
        }

        return false;
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
