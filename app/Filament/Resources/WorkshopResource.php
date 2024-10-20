<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Workshop;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use App\Filament\Resources\WorkshopResource\Pages;
use App\Filament\Resources\WorkshopResource\RelationManagers\CategoriesRelationManager;

class WorkshopResource extends Resource
{
    protected static ?string $model = Workshop::class;
    protected static ?string $modelLabel = 'ورشة عمل';
    protected static ?string $pluralModelLabel = 'ورش العمل';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('description')->required(),
                DatePicker::make('date')->required(),
                TimePicker::make('time')->required(),
                TextInput::make('capacity')->numeric()->required(),
                TextInput::make('price')->numeric()->required(),
                Select::make('instructor_id')
                    ->relationship('instructor', 'name')
                    ->required(),
                
                Section::make('location')->schema([
                    TextInput::make('latitude')->numeric(),
                    TextInput::make('longitude')->numeric(),
                ]),
                FileUpload::make('image')
                ->image()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->label('الاسم'),
                Tables\Columns\TextColumn::make('instructor.name')->searchable()->sortable()->label('اسم المدرب'),
                Tables\Columns\TextColumn::make('price')->searchable()->sortable()->label('السعر'),
                Tables\Columns\TextColumn::make('date')->searchable()->sortable()->label('التاريخ'),
                Tables\Columns\TextColumn::make('capacity')->searchable()->sortable()->label('السعة'),
                Tables\Columns\TextColumn::make('description')->searchable()->sortable()->label('التفاصيل'),

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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkshops::route('/'),
            'create' => Pages\CreateWorkshop::route('/create'),
            'edit' => Pages\EditWorkshop::route('/{record}/edit'),
        ];
    }
}
