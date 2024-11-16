<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemesananResource\Pages;
use App\Models\Pemesanan;
use Filament\Forms;
use Filament\Forms\Form;  // Update import ini
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;  // Update import ini
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;

class PemesananResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Pemesanan';
    protected static ?string $modelLabel = 'Pemesanan';
    protected static ?string $pluralModelLabel = 'Pemesanan';

    public static function form(Form $form): Form  // Update tipe return
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('order_code')
                        ->label('Kode Pemesanan')
                        ->required()
                        ->disabled()
                        ->unique(Pemesanan::class, 'order_code'),

                    Forms\Components\TextInput::make('name')
                        ->label('Nama Pengunjung')
                        ->required(),

                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required(),

                    Forms\Components\TextInput::make('phone')
                        ->label('Nomor Telepon')
                        ->tel()
                        ->required(),

                    Forms\Components\DatePicker::make('order_date')
                        ->label('Tanggal Kunjungan')
                        ->required(),

                    Forms\Components\TextInput::make('num_people')
                        ->label('Jumlah Orang')
                        ->numeric()
                        ->required()
                        ->minValue(1),

                    Forms\Components\TextInput::make('price')
                        ->label('Harga')
                        ->numeric()
                        ->required()
                        ->prefix('Rp'),

                    FileUpload::make('proof_of_payment')
                        ->label('Bukti Pembayaran')
                        ->image()
                        ->directory('proof-of-payment')
                        ->preserveFilenames()
                        ->required()
                        ->columnSpan('full'),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table  // Update tipe return
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label('Kode Pemesanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pengunjung.name')
                    ->label('Nama Pengunjung')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pengunjung.email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('pengunjung.phone')
                    ->label('Nomor Telepon'),

                Tables\Columns\TextColumn::make('order_date')
                    ->label('Tanggal Kunjungan')
                    ->date('d F Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('num_people')
                    ->label('Jumlah Orang')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr')
                    ->sortable(),

                ImageColumn::make('proof_of_payment')
                    ->label('Bukti Pembayaran')
                    ->circular(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pemesanan')
                    ->dateTime('d F Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPemesanan::route('/'),
            'create' => Pages\CreatePemesanan::route('/create'),
            'edit' => Pages\EditPemesanan::route('/{record}/edit'),
        ];
    }
}