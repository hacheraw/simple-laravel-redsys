<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use Illuminate\Support\Number;

class TotalsOverview extends BaseWidget
{
    protected static ?int $sort = -4;

    protected function getStats(): array
    {
        $unpaidCount = Order::query()->where('is_paid', false)->count();

        return [
            Stat::make(__('Total Orders'), Order::query()->count()),
            Stat::make(__('Total Amount'), Number::currency(Order::query()->sum('amount'), in: 'EUR'))
            ->description(__('Average') . ': ' . Number::currency(Order::query()->avg('amount'), in: 'EUR'))
            ->chart(Order::pluck('amount')->toArray())
            ->color('success'),
            Stat::make(__('Unpaid Orders'), $unpaidCount)
            ->description($unpaidCount ? Number::currency(Order::query()->where('is_paid', false)->sum('amount'), in: 'EUR') : '')
            ->color('danger')
        ];
    }
}
