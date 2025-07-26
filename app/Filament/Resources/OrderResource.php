<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ViewField;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Pesanan Pelanggan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Pesanan')
                    ->schema([
                        // Menampilkan ID Pesanan
                        Placeholder::make('order_id')
                            ->label('ID Pesanan')
                            ->content(fn ($record): string => '#' . str_pad($record->id, 6, '0', STR_PAD_LEFT)),

                        Placeholder::make('nama_pembeli')
                            ->label('Nama Pembeli')
                            ->content(fn ($record) => $record->user->name),
                        
                        Placeholder::make('total_harga')
                            ->label('Total Harga')
                            ->content(fn ($record) => 'Rp. ' . number_format($record->total_price, 0, ',', '.')),
                        
                        // Menampilkan daftar produk yang dibeli
                        Placeholder::make('rincian_produk')
                            ->label('Rincian Produk')
                            ->content(function ($record) {
                                $content = '';
                                foreach ($record->details as $detail) {
                                    $content .= "• {$detail->quantity}x {$detail->produk->nama_produk}<br>";
                                }
                                return new \Illuminate\Support\HtmlString($content);
                            }),
                    ])->columns(1),

            Section::make('Verifikasi Pembayaran')
                ->schema([
                    // Tampilkan gambar jika bukti pembayaran ada
                    ViewField::make('payment_proof_path')
                        ->label('Bukti Pembayaran Pelanggan')
                        ->view('filament.forms.components.image-viewer') // Kita akan buat file view ini
                        ->visible(fn($record) => $record?->payment_proof_path), // Hanya tampil jika ada path

                    // Tampilkan pesan jika bukti pembayaran tidak ada
                    Placeholder::make('no_proof')
                        ->label('Bukti Pembayaran Pelanggan')
                        ->content('Pelanggan belum mengunggah bukti pembayaran.')
                        ->visible(fn($record) => !$record?->payment_proof_path), // Hanya tampil jika tidak ada path
                ]),

                Section::make('Update Status')
                    ->schema([
                        Select::make('status')
                            ->label('Status Pesanan')
                            ->options([
                                'belum_dikonfirmasi' => 'Belum Dikonfirmasi',
                                'diproses' => 'Diproses',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID Pesanan')
                    ->formatStateUsing(fn (string $state): string => '#' . str_pad($state, 6, '0', STR_PAD_LEFT))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')->label('Nama Pembeli')->searchable()->sortable(),
                TextColumn::make('total_price')->label('Total Harga')->money('IDR')->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'belum_dikonfirmasi' => 'warning',
                        'diproses' => 'primary',
                        'selesai' => 'success',
                        'dibatalkan' => 'danger',
                    })
                    ->searchable(),
                TextColumn::make('created_at')->label('Tanggal Pesan')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function canCreate(): bool { return false; }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }    
}