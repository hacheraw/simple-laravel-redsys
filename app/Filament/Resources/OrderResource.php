<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->translateLabel()->required()->maxLength(255),
                Forms\Components\TextInput::make('amount')->translateLabel()->prefix('€')->numeric()->inputMode('decimal')->step(0.01)->required(),
                RichEditor::make('description')->translateLabel()->columnSpan([
                    'lg' => 2,
                ])->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->translateLabel()->grow(),
                TextColumn::make('amount')->translateLabel()->money('EUR'),
                ToggleColumn::make('is_paid')->translateLabel()->sortable(),
                TextColumn::make('url')
                    ->getStateUsing(function () {
                        return '&nbsp;';
                    })
                    ->icon('heroicon-o-clipboard')
                    ->html()
                    ->copyable()
                    ->copyableState(fn (Order $order): string => route('pay', ['code' => $order->code])),

            ])
            ->filters([
                Filter::make('is_paid')->translateLabel()
                    ->query(fn (Builder $query): Builder => $query->where('is_paid', true))
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
            RelationManagers\TransactionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
