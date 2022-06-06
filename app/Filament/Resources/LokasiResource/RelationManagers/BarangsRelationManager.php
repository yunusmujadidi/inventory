<?php

namespace App\Filament\Resources\LokasiResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class BarangsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'barangs';

    protected static ?string $recordTitleAttribute = 'kode_barang';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('kode_barang')
                    ->rules(['required', 'max:255'])
                    ->placeholder('Kode Barang')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('nama_barang')
                    ->rules(['required', 'max:255'])
                    ->placeholder('Nama Barang')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('stok')
                    ->rules(['required', 'max:255'])
                    ->placeholder('Stok')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('harga')
                    ->rules(['required', 'numeric'])
                    ->numeric()
                    ->placeholder('Harga')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('merek_id')
                    ->rules(['required', 'exists:mereks,id'])
                    ->relationship('merek', 'merek')
                    ->searchable()
                    ->placeholder('Merek')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('kategori_id')
                    ->rules(['required', 'exists:kategoris,id'])
                    ->relationship('kategori', 'kategori')
                    ->searchable()
                    ->placeholder('Kategori')
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
                Tables\Columns\TextColumn::make('kode_barang')->limit(50),
                Tables\Columns\TextColumn::make('nama_barang')->limit(50),
                Tables\Columns\TextColumn::make('stok')->limit(50),
                Tables\Columns\TextColumn::make('harga'),
                Tables\Columns\TextColumn::make('merek.merek')->limit(50),
                Tables\Columns\TextColumn::make('kategori.kategori')->limit(50),
                Tables\Columns\TextColumn::make('lokasi.lokasi')->limit(50),
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

                MultiSelectFilter::make('merek_id')->relationship(
                    'merek',
                    'merek'
                ),

                MultiSelectFilter::make('kategori_id')->relationship(
                    'kategori',
                    'kategori'
                ),

                MultiSelectFilter::make('lokasi_id')->relationship(
                    'lokasi',
                    'lokasi'
                ),
            ]);
    }
}
