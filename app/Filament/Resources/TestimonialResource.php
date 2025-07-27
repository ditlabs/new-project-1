<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Testimoni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    FileUpload::make('avatar')
                        ->label('Foto Profil')
                        ->image()
                        ->directory('testimonials-avatars')
                        ->required(),
                    TextInput::make('name')
                        ->label('Nama Klien')
                        ->required(),
                    TextInput::make('title')
                        ->label('Jabatan/Posisi')
                        ->required(),
                    Textarea::make('quote')
                        ->label('Isi Testimoni')
                        ->required()
                        ->columnSpanFull(),
                    Toggle::make('is_visible')
                        ->label('Tampilkan di Website?')
                        ->default(true),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')->label('Foto'),
                TextColumn::make('name')->label('Nama')->searchable(),
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
