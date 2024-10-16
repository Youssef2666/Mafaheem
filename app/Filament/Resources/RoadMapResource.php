<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\RoadMap;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RoadMapResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RoadMapResource\RelationManagers;
use App\Filament\Resources\RoadMapResource\RelationManagers\CoursesRelationManager;
use App\Models\Course;
use Filament\Forms\Components\Section;

class RoadMapResource extends Resource
{
    protected static ?string $model = RoadMap::class;
    protected static ?string $modelLabel = 'خريطة سير';
    protected static ?string $pluralModelLabel = 'خرائط السير';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                ->required(),

                TextInput::make('description')
                ->required(),

                Section::make('Courses')->schema(
                    [
                        Forms\Components\Select::make('courses')
                        ->multiple()
                        ->relationship('courses', 'title')
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->searchable()
                ->sortable()
                ->label('الاسم'),

                TextColumn::make('description')
                ->searchable()
                ->sortable()
                ->label('التفاصيل'),
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
            CoursesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoadMaps::route('/'),
            'create' => Pages\CreateRoadMap::route('/create'),
            'edit' => Pages\EditRoadMap::route('/{record}/edit'),
        ];
    }
}
