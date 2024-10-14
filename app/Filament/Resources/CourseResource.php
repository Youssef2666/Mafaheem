<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\CourseResource\RelationManagers\CouponsRelationManager;
use App\Filament\Resources\CourseResource\RelationManagers\OrderItemsRelationManager;
use App\Filament\Resources\CourseResource\RelationManagers\RatingsRelationManager;
use App\Models\Course;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable()->sortable()->label('المعرف'),
                TextColumn::make('title')->searchable()->sortable()->label('الاسم'),
                TextColumn::make('instructor.name')->label('Instructor Name')->label('اسم المدرب'),
                TextColumn::make('level')->sortable()->label('المستوى'),
                TextColumn::make('price')->label('السعر'),
                TextColumn::make('average_rating') // Use the accessor
                    ->label('متوسط التقييم')
                    ->formatStateUsing(fn($state) => round($state, 1)),
            ])
            ->filters([
                SelectFilter::make('level')
                ->label('المستوى')
                    ->options([
                        'مبتدئ' => 'مبتدئ',
                        'متوسط' => 'متوسط',
                        'متقدم' => 'متقدم',
                    ]),
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
            // OrderItemsRelationManager::class,
            CategoriesRelationManager::class,
            RatingsRelationManager::class,
            CouponsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}