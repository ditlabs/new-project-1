<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// Import komponen-komponen yang dibutuhkan
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\IconColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Testimoni & Ulasan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Bagian ini hanya untuk ulasan dari pengguna (read-only)
                Section::make('Ulasan dari Pengguna')
                    ->schema([
                        Placeholder::make('user_name')
                            ->label('Pengirim Ulasan')
                            ->content(fn ($record) => $record->user?->name ?? '-'),
                        Placeholder::make('produk_name')
                            ->label('Produk yang Diulas')
                            ->content(fn ($record) => $record->produk?->nama_produk ?? '-'),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record && $record->user_id), // Hanya tampil jika ini adalah ulasan dari user

                // Bagian ini untuk testimoni manual (admin input)
                Section::make('Testimoni Manual')
                    ->schema([
                        TextInput::make('name')->label('Nama Klien'),
                        TextInput::make('title')->label('Jabatan/Posisi'),
                    ])
                    ->columns(3)
                    ->visible(fn ($record) => !$record || !$record->user_id), // Hanya tampil jika ini testimoni manual
                
                // Bagian yang sama untuk keduanya
                Section::make('Konten')
                    ->schema([
                        Textarea::make('quote')
                            ->label('Isi Ulasan/Testimoni')
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_visible')
                            ->label('Tampilkan di Website?')
                            ->default(false), // Default-nya tidak tampil
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama / Pengirim')->searchable(),
                TextColumn::make('produk.nama_produk')->label('Produk Diulas')->sortable(),
                IconColumn::make('rating')
                    ->label('Rating')
                    ->icon('heroicon-s-star')
                    ->color('warning')
                    ->getStateUsing(fn ($record) => array_fill(0, $record->rating ?? 0, true)),
                TextColumn::make('title')->label('Jabatan'),
                ToggleColumn::make('is_visible')->label('Tampil'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

}