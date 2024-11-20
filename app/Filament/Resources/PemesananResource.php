<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemesananResource\Pages;
use App\Models\Pemesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ViewField;

class PemesananResource extends Resource
{
   protected static ?string $model = Pemesanan::class;
   protected static ?string $navigationIcon = 'heroicon-o-ticket';
   protected static ?string $navigationLabel = 'Pemesanan Tiket';
   protected static ?string $modelLabel = 'Pemesanan Tiket';

   public static function form(Form $form): Form
   {
       return $form
           ->schema([
               Forms\Components\Group::make([
                   Forms\Components\TextInput::make('order_code')
                       ->label('Kode Pemesanan')
                       ->required()
                       ->disabled(),
                   Forms\Components\TextInput::make('pengunjung.name')
                       ->label('Nama Pengunjung')
                       ->required()
                       ->disabled(),
                   Forms\Components\DatePicker::make('order_date')
                       ->label('Tanggal Kunjungan')
                       ->required()
                       ->disabled(),
                   Forms\Components\TextInput::make('num_people')
                       ->label('Jumlah Orang')
                       ->disabled(),
                   Forms\Components\TextInput::make('price')
                       ->label('Harga')
                       ->disabled(),
                   ViewField::make('proof_of_payment')
                       ->label('Bukti Pembayaran')
                       ->view('filament.resources.pemesanan.components.bukti-pembayaran'),
               ])->columns(2)
           ]);
   }

   public static function table(Table $table): Table
   {
       return $table
           ->columns([
               Tables\Columns\TextColumn::make('order_code')
                   ->label('Kode Pemesanan')
                   ->searchable(),
               Tables\Columns\TextColumn::make('pengunjung.name')
                   ->label('Nama Pengunjung')
                   ->searchable(),
               Tables\Columns\TextColumn::make('order_date')
                   ->label('Tanggal Kunjungan')
                   ->date()
                   ->sortable(),
               Tables\Columns\TextColumn::make('num_people')
                   ->label('Jumlah Orang')
                   ->sortable(),
               Tables\Columns\TextColumn::make('price')
                   ->label('Harga')
                   ->money('IDR')
                   ->sortable(),
               Tables\Columns\ImageColumn::make('proof_of_payment')
                   ->label('Bukti Pembayaran')
                   ->disk('public')
                   ->square()
                   ->size(100),
               Tables\Columns\TextColumn::make('status')
                   ->badge()
                   ->color(fn (string $state): string => match ($state) {
                       'pending' => 'warning',
                       'confirmed' => 'success',
                       default => 'gray',
                   }),
           ])
           ->actions([
               Tables\Actions\ViewAction::make(),
               Tables\Actions\Action::make('confirm')
                   ->label('Konfirmasi Tiket')
                   ->icon('heroicon-o-check-circle')
                   ->color('success')
                   ->requiresConfirmation()
                   ->visible(fn (Pemesanan $record): bool => $record->status === 'pending')
                   ->action(function (Pemesanan $record) {
                       $record->update(['status' => 'confirmed']);
                       Notification::make()
                           ->title('Tiket berhasil dikonfirmasi')
                           ->success()
                           ->send();
                   }),
               Tables\Actions\DeleteAction::make()
                   ->requiresConfirmation()
                   ->before(function (Pemesanan $record) {
                       if ($record->proof_of_payment) {
                           Storage::disk('public')->delete($record->proof_of_payment);
                       }
                   }),
           ]);
   }

   public static function getPages(): array
   {
       return [
           'index' => Pages\ListPemesanan::route('/'),
           'view' => Pages\ViewPemesanan::route('/{record}'),
       ];
   }
}