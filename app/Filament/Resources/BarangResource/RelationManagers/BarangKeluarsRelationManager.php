<?php

namespace App\Filament\Resources\BarangResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class BarangKeluarsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'barangKeluars';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                DateTimePicker::make('tanggal_keluar')
                    ->rules(['required', 'date'])
                    ->placeholder('Tanggal Keluar')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('jumlah_keluar')
                    ->rules(['required'])
                    ->placeholder('Jumlah Keluar')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('lokasi_id')
                    ->rules(['required', 'exists:lokasis,id'])
                    ->relationship('lokasi', 'lokasi')
                    ->searchable()
                    ->placeholder('Lokasi')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_keluar')->dateTime(),
                Tables\Columns\TextColumn::make('jumlah_keluar')->limit(50),
                Tables\Columns\TextColumn::make('lokasi.lokasi')->limit(50),
                Tables\Columns\TextColumn::make('barang.kode_barang')->limit(
                    50
                ),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('lokasi_id')->relationship(
                    'lokasi',
                    'lokasi'
                ),

                MultiSelectFilter::make('barang_id')->relationship(
                    'barang',
                    'kode_barang'
                ),
            ]);
    }
}
