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
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Contracts\View\View;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\ViewField;

class PemesananResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Pemesanan Tiket';
    protected static ?string $modelLabel = 'Pemesanan Tiket';



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
            ->label('Status')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'pending' => 'warning',
                'confirmed' => 'success',
                default => 'gray',
            }),
    ])
    ->actions([
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
    ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                    ]),
                // Gunakan filter berbasis query untuk tanggal
                Tables\Filters\Filter::make('order_date')
                    ->form([
                        Forms\Components\DatePicker::make('order_date_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('order_date_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['order_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('order_date', '>=', $date),
                            )
                            ->when(
                                $data['order_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('order_date', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\Action::make('viewImage')
                    ->label('Lihat Bukti')
                    ->modalContent(fn (Pemesanan $record): string => view('filament.resources.pemesanan.model.image', [
                        'imageUrl' => Storage::disk('public')->url($record->proof_of_payment)
                    ]))
                    ->modalSubmitAction(false) // Hapus tombol submit
                    ->modalCancelActionLabel('Tutup') // Ganti label cancel
                    ->visible(fn (Pemesanan $record) => $record->proof_of_payment !== null),
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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPemesanan::route('/'),
        ];
    }
}