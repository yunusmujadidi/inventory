<?php

namespace App\Filament\Resources;

use App\Models\BarangMasuk;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\BarangMasukResource\Pages;

class BarangMasukResource extends Resource
{
    protected static ?string $model = BarangMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    DateTimePicker::make('tanggal_masuk')
                        ->rules(['required', 'date'])
                        ->placeholder('Tanggal Masuk')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('jumlah_masuk')
                        ->rules(['required'])
                        ->placeholder('Jumlah Masuk')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    BelongsToSelect::make('supplier_id')
                        ->rules(['required', 'exists:suppliers,id'])
                        ->relationship('supplier', 'nama_supplier')
                        ->searchable()
                        ->placeholder('Supplier')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    BelongsToSelect::make('barang_id')
                        ->rules(['required', 'exists:barangs,id'])
                        ->relationship('barang', 'kode_barang')
                        ->searchable()
                        ->placeholder('Barang')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_masuk')->dateTime(),
                Tables\Columns\TextColumn::make('jumlah_masuk')->limit(50),
                Tables\Columns\TextColumn::make(
                    'supplier.nama_supplier'
                )->limit(50),
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

                MultiSelectFilter::make('supplier_id')->relationship(
                    'supplier',
                    'nama_supplier'
                ),

                MultiSelectFilter::make('barang_id')->relationship(
                    'barang',
                    'kode_barang'
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangMasuks::route('/'),
            'create' => Pages\CreateBarangMasuk::route('/create'),
            'edit' => Pages\EditBarangMasuk::route('/{record}/edit'),
        ];
    }
}
