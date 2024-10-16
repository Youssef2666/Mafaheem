<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $title = 'دوراتي';  // Optional title

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('course_id')
                    ->label('Course ID'),
                Tables\Columns\TextColumn::make('enrolled_at')
                    ->label('Enrollment Date'),
                Tables\Columns\TextColumn::make('price_at_purchase')
                    ->label('Price at Purchase'),
                Tables\Columns\TextColumn::make('completed_at')
                    ->label('Completion Date'),
            ])
            ->filters([
                // Add any filters if needed
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                // Define bulk actions if needed
            ]);
    }

}
