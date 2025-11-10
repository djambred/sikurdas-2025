<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RpsResource\Pages;
use App\Filament\Admin\Resources\RpsResource\RelationManagers\CpmksRelationManager;
use App\Filament\Admin\Resources\RpsResource\RelationManagers\SubCpmksRelationManager;
use App\Models\Rps;
use App\Models\Major;
use App\Models\Course;
use App\Models\CourseLearningOutcome;
use App\Models\Lecture;
use App\Models\TopicLearningOutcome;

use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\CheckboxList;

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
                            ->options(fn() => Major::orderBy('name')->pluck('name','id')->toArray())
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
                                        ->pluck('nama','id')
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
                                        $set('deskripsi_singkat', $course->deskripsi);
                                    }
                                }
                            })
                            ->columnSpan(2),
                    ]),

                    Grid::make(4)->schema([
                        TextInput::make('kode')
                            ->label('Kode MK')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(1),

                        TextInput::make('nama')
                            ->label('Nama Mata Kuliah')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(3),
                    ]),

                    Grid::make(4)->schema([
                        TextInput::make('sks')
                            ->label('SKS')
                            ->numeric()
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(1),

                        TextInput::make('semester')
                            ->label('Semester')
                            ->numeric()
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(1),

                        // Ganti Select dengan TextInput untuk nama penyusun
                        TextInput::make('penyusun')
                            ->label('Penyusun')
                            ->required()
                            ->columnSpan(2)
                            ->placeholder('Masukkan nama lengkap penyusun'),
                    ]),

                    // Tambahkan field untuk nama koordinator dan ketua prodi
                    Grid::make(3)->schema([
                        TextInput::make('koordinator_rps')
                            ->label('Koordinator RPS')
                            ->columnSpan(1)
                            ->placeholder('Nama Koordinator RPS'),

                        TextInput::make('ketua_prodi')
                            ->label('Ketua Program Studi')
                            ->columnSpan(1)
                            ->placeholder('Nama Ketua Prodi'),

                        TextInput::make('dosen_pengampu')
                            ->label('Dosen Pengampu')
                            ->columnSpan(1)
                            ->placeholder('Nama Dosen Pengampu'),
                    ]),

                    Textarea::make('deskripsi_singkat')
                        ->label('Deskripsi Singkat')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            // ... (bagian CPMK, Sub-CPMK, Rencana Pembelajaran Mingguan, dll tetap sama)
            Section::make('Capaian Pembelajaran')
                ->description('Pilih CPMK dan Sub-CPMK yang sudah ada')
                ->schema([
                    CheckboxList::make('existing_cpmks')
                        ->label('Pilih CPMK yang Sudah Ada')
                        ->options(fn() => CourseLearningOutcome::orderBy('code')->get()->mapWithKeys(function ($item) {
                            return [$item->id => "{$item->code} - {$item->description}"];
                        })->toArray())
                        ->columns(2)
                        ->gridDirection('row')
                        ->helperText('Pilih CPMK dari daftar yang sudah ada')
                        ->columnSpanFull(),

                    CheckboxList::make('existing_sub_cpmks')
                        ->label('Pilih Sub-CPMK yang Sudah Ada')
                        ->options(fn() => TopicLearningOutcome::orderBy('code')->get()->mapWithKeys(function ($item) {
                            return [$item->id => "{$item->code} - {$item->detail}"];
                        })->toArray())
                        ->columns(2)
                        ->gridDirection('row')
                        ->helperText('Pilih Sub-CPMK dari daftar yang sudah ada')
                        ->columnSpanFull(),

                    Placeholder::make('relation_manager_note')
                        ->content('Catatan: CPMK dan Sub-CPMK yang dipilih di atas akan ditambahkan ke Relation Managers di bawah. Anda juga dapat menambah/mengelola CPMK dan Sub-CPMK langsung melalui Relation Managers.')
                        ->columnSpanFull()
                        ->extraAttributes(['class' => 'text-sm text-gray-600 bg-blue-50 p-3 rounded']),
                ]),

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

                                TextInput::make('method')
                                    ->label('Metode Pembelajaran')
                                    ->columnSpan(1),

                                TextInput::make('assessment')
                                    ->label('Penilaian')
                                    ->columnSpan(1),
                            ]),

                            Textarea::make('learning_outcomes')
                                ->label('Capaian Pembelajaran')
                                ->rows(2)
                                ->columnSpanFull()
                                ->helperText('Tulis capaian pembelajaran untuk minggu ini'),

                            TextInput::make('references')
                                ->label('Referensi')
                                ->columnSpanFull(),
                        ])
                        ->columns(1)
                        ->createItemButtonLabel('Tambah Minggu')
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => 'Minggu ' . ($state['week'] ?? 'Baru'))
                        ->defaultItems(1),
                ]),

            Section::make('Komponen Penilaian')
                ->schema([
                    Repeater::make('assessment')
                        ->label('Komponen Penilaian')
                        ->schema([
                            Grid::make(3)->schema([
                                TextInput::make('name')
                                    ->label('Nama Komponen')
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
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Komponen Baru')
                        ->defaultItems(1),
                ]),

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
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Referensi Baru')
                        ->defaultItems(1),
                ]),

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
                    ->tooltip(fn (Rps $record): string => $record->nama),

                TextColumn::make('kode')
                    ->label('Kode')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable()
                    ->alignCenter(),

                // Perbaikan: Tampilkan nama penyusun langsung (bukan ID)
                TextColumn::make('penyusun')
                    ->label('Penyusun')
                    ->searchable()
                    ->limit(20)
                    ->tooltip(fn (Rps $record): string => $record->penyusun ?? '-'),

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
            ->emptyStateHeading('Belum ada RPS')
            ->emptyStateDescription('Klik tombol di bawah untuk membuat RPS pertama Anda.')
            ->emptyStateIcon('heroicon-o-document-text');
    }

    // public static function getRelations(): array
    // {
    //     return [
    //         CpmksRelationManager::class,
    //         SubCpmksRelationManager::class,
    //     ];
    // }

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
