<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RpsResource\Pages;
use App\Filament\Admin\Resources\RpsResource\RelationManagers\CpmksRelationManager;
use App\Filament\Admin\Resources\RpsResource\RelationManagers\SubCpmksRelationManager;
use App\Models\Rps;
use App\Models\Major;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\CourseLearningOutcome;
use App\Models\TopicLearningOutcome;
use App\Models\LearningMethod;
use App\Models\AssessmentCourse;

use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Get;

use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;

class RpsResource extends Resource
{
    protected static ?string $model = Rps::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'RPS';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $modelLabel = 'Rencana Pembelajaran Semester';
    protected static ?int $navigationSort = -7;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Mata Kuliah')
                ->schema([
                    Grid::make(3)->schema([
                        Select::make('major_id')
                            ->label('Program Studi')
                            ->options(fn() => Major::orderBy('name')->pluck('name', 'id')->toArray())
                            ->searchable()
                            ->reactive()
                            ->required()
                            ->columnSpan(1),

                        Select::make('course_id')
                            ->label('Mata Kuliah')
                            ->options(function (callable $get) {
                                $majorId = $get('major_id');
                                return $majorId
                                    ? Course::where('major_id', $majorId)
                                        ->orderBy('nama')
                                        ->pluck('nama', 'id')
                                        ->toArray()
                                    : [];
                            })
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $course = Course::find($state);
                                    if ($course) {
                                        $set('kode', $course->kode);
                                        $set('nama', $course->nama);
                                        $set('sks', $course->sks);
                                        $set('semester', $course->semester);
                                        $set('deskripsi_singkat', $course->deskripsi_singkat ?? $course->nama);
                                    }
                                }
                            })
                            ->columnSpan(2),
                    ]),

                    // Detail Mata Kuliah (Disabled di display, tapi data AKAN disimpan ke database)
                    Grid::make(4)->schema([
                        TextInput::make('kode')
                            ->label('Kode MK')
                            ->required()
                            ->disabled()
                            ->dehydrated(true)
                            ->columnSpan(1),

                        TextInput::make('nama')
                            ->label('Nama Mata Kuliah')
                            ->required()
                            ->disabled()
                            ->dehydrated(true)
                            ->columnSpan(3),
                    ]),

                    Grid::make(4)->schema([
                        TextInput::make('sks')
                            ->label('SKS')
                            ->numeric()
                            ->required()
                            ->disabled()
                            ->dehydrated(true)
                            ->columnSpan(1),

                        TextInput::make('semester')
                            ->label('Semester')
                            ->numeric()
                            ->required()
                            ->disabled()
                            ->dehydrated(true)
                            ->columnSpan(1),

                        // Penyusun RPS
                        Select::make('penyusun_id')
                            ->label('Penyusun')
                            ->relationship('penyusun', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(2),
                    ]),

                    // Otorisasi
                    Grid::make(3)->schema([
                        Select::make('koordinator_rps_id')
                            ->label('Koordinator RPS')
                            ->relationship('koordinator', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1)
                            ->nullable(),

                        Select::make('ketua_prodi_id')
                            ->label('Ketua Program Studi')
                            ->relationship('ketuaProdi', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1)
                            ->nullable(),

                        Select::make('lectures')
                            ->relationship('lectures', 'name')
                            ->label('Dosen Pengampu')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpan(1)
                            ->nullable(),
                    ]),

                    Textarea::make('deskripsi_singkat')
                        ->label('Deskripsi Singkat')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            // --- CAPAIAN PEMBELAJARAN ---
            Section::make('Capaian Pembelajaran')
                ->description('Pilih CPMK dan Sub-CPMK yang sudah ada')
                ->schema([
                    CheckboxList::make('cpmks')
                        ->label('Pilih CPMK')
                        ->relationship('cpmks', 'code')
                        ->getOptionLabelFromRecordUsing(fn (CourseLearningOutcome $record) => "{$record->code} - {$record->description}")
                        ->columns(2)
                        ->gridDirection('row')
                        ->helperText('Pilih CPMK dari daftar yang sudah ada. Filament akan menyimpan relasi ini secara otomatis.')
                        ->columnSpanFull(),

                    CheckboxList::make('subCpmks')
                        ->label('Pilih Sub-CPMK')
                        ->relationship('subCpmks', 'code')
                        ->getOptionLabelFromRecordUsing(fn (TopicLearningOutcome $record) => "{$record->code} - {$record->detail}")
                        ->columns(2)
                        ->gridDirection('row')
                        ->helperText('Pilih Sub-CPMK dari daftar yang sudah ada. Filament akan menyimpan relasi ini secara otomatis.')
                        ->columnSpanFull(),

                    Placeholder::make('relation_manager_note')
                        ->content('Catatan: Pilihan di atas akan disinkronkan saat disimpan, dan dapat dikelola lebih lanjut melalui Relation Managers.')
                        ->columnSpanFull()
                        ->extraAttributes(['class' => 'text-sm text-gray-600 bg-blue-50 p-3 rounded']),
                ]),

            // --- RENCANA PEMBELAJARAN MINGGUAN ---
            Section::make('Rencana Pembelajaran Mingguan')
                ->schema([
                    Repeater::make('weekly_plan')
                        ->label('Rencana Pembelajaran Mingguan')
                        ->schema([
                            Grid::make(5)->schema([
                                TextInput::make('week')
                                    ->label('Minggu')
                                    ->numeric()
                                    ->required()
                                    ->columnSpan(1),

                                TextInput::make('topic')
                                    ->label('Topik / Materi')
                                    ->required()
                                    ->columnSpan(2),

                                Select::make('method')
                                    ->label('Metode Pembelajaran')
                                    ->options(LearningMethod::all()->pluck('name', 'name'))
                                    ->multiple()
                                    ->searchable()
                                    ->columnSpan(1),

                                Select::make('assessment_method')
                                    ->label('Penilaian')
                                    ->options(AssessmentCourse::all()->pluck('name', 'name'))
                                    ->multiple()
                                    ->searchable()
                                    ->columnSpan(1),
                            ]),

                            Textarea::make('learning_outcomes')
                                ->label('Capaian Pembelajaran (Sub-CPMK)')
                                ->rows(2)
                                ->columnSpanFull()
                                ->helperText('Tulis capaian pembelajaran untuk minggu ini'),

                            Grid::make(3)->schema([
                                Select::make('indicator_ik')
                                    ->label('Indikator Kinerja (IK)')
                                    ->options(fn () => \App\Models\LearningOutcomeIndicator::pluck('code', 'id')->toArray())
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->columnSpan(2)
                                    ->helperText('Pilih indikator kinerja dari CPL'),

                                TextInput::make('bobot')
                                    ->label('Bobot (%)')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->columnSpan(1)
                                    ->suffix('%'),
                            ]),

                            Textarea::make('student_task')
                                ->label('Rencana Tugas Mahasiswa (RTM)')
                                ->rows(2)
                                ->columnSpanFull()
                                ->helperText('Jelaskan tugas yang akan diberikan kepada mahasiswa'),

                            TextInput::make('references')
                                ->label('Referensi')
                                ->columnSpanFull()
                                ->helperText('Contoh: Bab 1-3 dari buku referensi'),
                        ])
                        ->columns(1)
                        ->createItemButtonLabel('Tambah Minggu')
                        ->collapsible()
                        ->itemLabel(fn (array $state): string => 'Minggu ' . ($state['week'] ?? 'Baru'))
                        ->defaultItems(1),
                ]),

            // --- KOMPONEN PENILAIAN ---
            Section::make('Komponen Penilaian')
                ->schema([
                    Repeater::make('assessment')
                        ->label('Komponen Penilaian')
                        ->schema([
                            Grid::make(3)->schema([
                                Select::make('component_name')
                                    ->label('Nama Komponen')
                                    ->options(AssessmentCourse::all()->pluck('name', 'name'))
                                    ->searchable()
                                    ->required()
                                    ->columnSpan(2),

                                TextInput::make('weight')
                                    ->label('Bobot (%)')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->required()
                                    ->columnSpan(1)
                                    ->suffix('%'),
                            ]),

                            Textarea::make('criteria')
                                ->label('Kriteria Penilaian')
                                ->rows(2)
                                ->columnSpanFull()
                                ->helperText('Jelaskan kriteria penilaian untuk komponen ini'),

                            TextInput::make('time')
                                ->label('Waktu Pelaksanaan')
                                ->columnSpanFull()
                                ->helperText('Contoh: Minggu ke-8, Akhir Semester, dll'),
                        ])
                        ->createItemButtonLabel('Tambah Komponen')
                        ->collapsible()
                        ->itemLabel(fn (array $state): string => $state['component_name'] ?? 'Komponen Baru')
                        ->defaultItems(1),
                ]),

            // --- REFERENSI ---
            Section::make('Referensi')
                ->schema([
                    Repeater::make('references')
                        ->label('Daftar Pustaka')
                        ->schema([
                            Grid::make(3)->schema([
                                TextInput::make('title')
                                    ->label('Judul')
                                    ->required()
                                    ->columnSpan(2),

                                TextInput::make('author')
                                    ->label('Penulis')
                                    ->columnSpan(1),
                            ]),

                            Grid::make(3)->schema([
                                TextInput::make('publisher')
                                    ->label('Penerbit')
                                    ->columnSpan(1),

                                TextInput::make('year')
                                    ->label('Tahun')
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue(now()->year)
                                    ->columnSpan(1),

                                Select::make('type')
                                    ->label('Jenis')
                                    ->options([
                                        'buku' => 'Buku',
                                        'jurnal' => 'Jurnal',
                                        'artikel' => 'Artikel',
                                        'laporan' => 'Laporan',
                                        'website' => 'Website',
                                        'lainnya' => 'Lainnya',
                                    ])
                                    ->columnSpan(1),
                            ]),
                        ])
                        ->createItemButtonLabel('Tambah Referensi')
                        ->collapsible()
                        ->itemLabel(fn (array $state): string => $state['title'] ?? 'Referensi Baru')
                        ->defaultItems(1),
                ]),

            // --- INFORMASI PENYUSUNAN ---
            Section::make('Informasi Penyusunan')
                ->schema([
                    Grid::make(2)->schema([
                        DatePicker::make('tanggal_penyusunan')
                            ->label('Tanggal Penyusunan')
                            ->default(now())
                            ->required(),

                        TextInput::make('revisi')
                            ->label('Revisi Ke')
                            ->numeric()
                            ->minValue(1)
                            ->default(1),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('major.name')
                    ->label('Program Studi')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nama')
                    ->label('Mata Kuliah')
                    ->sortable()
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn (Rps $record): string => (string) $record->nama),

                TextColumn::make('kode')
                    ->label('Kode')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('penyusun.name')
                    ->label('Penyusun')
                    ->sortable()
                    ->searchable()
                    ->limit(20),

                TextColumn::make('koordinator.name')
                    ->label('Koordinator RPS')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('ketuaProdi.name')
                    ->label('Ketua Prodi')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('lectures.name')
                    ->label('Dosen Pengampu')
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->expandableLimitedList()
                    ->toggleable(),

                TextColumn::make('cpmks_count')
                    ->label('Jumlah CPMK')
                    ->counts('cpmks')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('tanggal_penyusunan')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('major_id')
                    ->label('Program Studi')
                    ->relationship('major', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('semester')
                    ->label('Semester')
                    ->options([
                        '1' => 'Semester 1',
                        '2' => 'Semester 2',
                        '3' => 'Semester 3',
                        '4' => 'Semester 4',
                        '5' => 'Semester 5',
                        '6' => 'Semester 6',
                        '7' => 'Semester 7',
                        '8' => 'Semester 8',
                    ]),

                SelectFilter::make('lectures')
                    ->label('Dosen Pengampu')
                    ->relationship('lectures', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                EditAction::make()->icon(null),
                Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Rps $record) => route('rps.preview', $record))
                    ->openUrlInNewTab(),
                Action::make('export')
                    ->label('PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->url(fn(Rps $record) => route('rps.export', $record))
                    ->openUrlInNewTab(),
                DeleteAction::make()->icon(null),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum ada RPS');
    }

    public static function getRelations(): array
    {
        return [
            CpmksRelationManager::class,
            SubCpmksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRps::route('/'),
            'create' => Pages\CreateRps::route('/create'),
            'edit' => Pages\EditRps::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'primary' : 'gray';
    }
}
