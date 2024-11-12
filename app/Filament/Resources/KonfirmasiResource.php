<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KonfirmasiResource\Pages;
use App\Filament\Resources\KonfirmasiResource\RelationManagers;
use App\Models\Konfirmasi;
use App\Models\Pemesanan;
use Filament\Forms;
use Filament\Forms\Form; // Pastikan ini
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KonfirmasiResource extends Resource
{
    protected static ?string $model = Konfirmasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('order_id')
                    ->label('Pemesanan')
                    ->relationship('pemesanan', 'order_code')
                    ->required(),
                Forms\Components\FileUpload::make('proof_of_transfer')
                    ->label('Bukti Transfer')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->label('Nominal')
                    ->required()
                    ->numeric()
                    ->min(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pemesanan.order_code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('amount')->sortable()->money('idr'),
                Tables\Columns\TextColumn::make('proof_of_transfer')
                    ->getStateUsing(function (Konfirmasi $record) {
                        return $record->proof_of_transfer_url;
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListKonfirmasi::route('/'),
            'create' => Pages\CreateKonfirmasi::route('/create'),
            'edit' => Pages\EditKonfirmasi::route('/{record}/edit'),
        ];
    }
}