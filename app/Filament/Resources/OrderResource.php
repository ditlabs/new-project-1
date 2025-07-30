<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Actions\Action;


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
                        Placeholder::make('nama_pembeli')
                            ->label('Nama Pembeli')
                            ->content(fn ($record) => $record->user->name),
                        
                        Placeholder::make('total_harga')
                            ->label('Total Harga')
                            ->content(fn ($record) => 'Rp. ' . number_format($record->total_price, 0, ',', '.')),
                        
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

                Section::make('Informasi Pengiriman')
                    ->schema([
                        // Tampilkan alamat (hanya bisa dibaca, tidak bisa diedit)
                        Textarea::make('shipping_address')
                            ->label('Alamat Pengiriman Pelanggan')
                            ->rows(4)
                            ->disabled(),

                        TextInput::make('tracking_number')
                            ->label('Nomor Resi Pengiriman')
                            ->placeholder('Masukkan nomor resi disini')
                    ])->columns(1),

                Section::make('Verifikasi Pembayaran')
                    ->schema([
                        // Tampilkan gambar jika bukti pembayaran ada
                        ViewField::make('payment_proof_path')
                            ->label('Bukti Pembayaran Pelanggan')
                            ->view('filament.forms.components.image-viewer')
                            ->visible(fn ($record) => $record?->payment_proof_path),

                        // Tampilkan pesan jika bukti pembayaran tidak ada
                        Placeholder::make('no_proof')
                            ->label('Bukti Pembayaran Pelanggan')
                            ->content('Pelanggan belum mengunggah bukti pembayaran.')
                            ->visible(fn ($record) => !$record?->payment_proof_path),

                        // Tombol untuk menghapus bukti pembayaran
                        Actions::make([
                            Action::make('delete_proof')
                                ->label('Hapus Bukti Pembayaran')
                                ->icon('heroicon-o-trash')
                                ->color('danger')
                                ->requiresConfirmation()
                                ->modalHeading('Hapus bukti pembayaran?')
                                ->modalDescription('Aksi ini akan menghapus file bukti pembayaran. Pelanggan akan diminta untuk mengunggah ulang.')
                                ->action(function ($record) {
                                    if ($record->payment_proof_path) {
                                        Storage::disk('public')->delete($record->payment_proof_path);
                                        $record->update(['payment_proof_path' => null]);
                                    }
                                })
                                ->visible(fn ($record) => $record?->payment_proof_path),
                        ])->maxWidth('sm'),
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
                TextColumn::make('user.name')->label('Nama Pembeli')->searchable()->sortable(),
                TextColumn::make('total_price')->label('Total Harga')->money('IDR')->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'belum_dikonfirmasi' => 'warning',
                        'diproses' => 'primary',
                        'selesai' => 'success',
                        'dibatalkan' => 'danger',
                        default => 'gray', // Menangani kasus tak terduga lainnya
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