<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MappingPLtoCPLResource\Pages;
use App\Models\MappingPLtoCPL;
use App\Models\GraduateProfile;
use App\Models\LearningOutcome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class MappingPLtoCPLResource extends Resource
{
    protected static ?string $model = MappingPLtoCPL::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Mapping PL, CPL, IK';
    protected static ?string $pluralModelLabel = 'Mapping PL, CPL, IK';

    public static function form(Form $form): Form
    {
        $graduateProfiles = GraduateProfile::all();
        $learningOutcomes = LearningOutcome::all();

        return $form->schema([
            Forms\Components\Repeater::make('mappings')
                ->label('Daftar Profil Lulusan dan CPL terkait')
                ->schema(function () use ($graduateProfiles, $learningOutcomes) {
                    return [
                        Forms\Components\Select::make('graduate_profile_id')
                            ->label('Profil Lulusan (PL)')
                            ->options(
                                $graduateProfiles->pluck('code', 'id')->map(function ($code, $id) use ($graduateProfiles) {
                                    $desc = $graduateProfiles->find($id)?->description;
                                    return "{$code} - {$desc}";
                                })
                            )
                            ->extraAttributes(['style' => 'white-space: normal; word-wrap: break-word; overflow-wrap: break-word;'])
                            ->required(),

                        Forms\Components\Select::make('learning_outcome_ids')
                            ->label('Capaian Pembelajaran Lulusan (CPL)')
                            ->options(
                                $learningOutcomes->pluck('code', 'id')->map(function ($code, $id) use ($learningOutcomes) {
                                    $desc = $learningOutcomes->find($id)?->description;
                                    return "{$code} - {$desc}";
                                })
                            )
                            ->extraAttributes(['style' => 'white-space: normal; word-wrap: break-word; overflow-wrap: break-word;'])
                            ->multiple()
                            ->required(),
                    ];
                })
                ->columns(2)
                ->createItemButtonLabel('Tambah PL-CPL Mapping'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('graduateProfile.code')
                    ->label('Kode PL')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('graduateProfile.description')
                    ->label('Deskripsi PL')
                    ->limit(60),

                Tables\Columns\TextColumn::make('learningOutcome.code')
                    ->label('Kode CPL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('learningOutcome.description')
                    ->label('Deskripsi CPL')
                    ->limit(60),
            ])
            ->headerActions([
                Action::make('previewHtml')
                    ->label('Preview Matriks')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn () => route('mapping.preview'))
                    ->openUrlInNewTab(),

                // Action::make('generatePdf')
                //     ->label('Download PDF Matriks')
                //     ->icon('heroicon-o-document-arrow-down')
                //     ->color('success')
                //     ->action(function () {
                //         $profiles = GraduateProfile::all();
                //         $outcomes = LearningOutcome::all();
                //         $relations = MappingPLtoCPL::all();

                //         $pdf = Pdf::loadView('pdf.mapping_pl_to_cpl_matrix', [
                //             'profiles' => $profiles,
                //             'outcomes' => $outcomes,
                //             'relations' => $relations,
                //         ])->setPaper('a4', 'portrait');

                //         return response()->streamDownload(
                //             fn () => print($pdf->output()),
                //             'Mapping_PL_to_CPL.pdf'
                //         );
                    // }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMappingPLtoCPLS::route('/'),
            'create' => Pages\CreateMappingPLtoCPL::route('/create'),
        ];
    }
}
