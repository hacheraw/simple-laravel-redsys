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
        $orders = Order::query()->get();
        if (!$orders->count()) {
            return [];
        }

        $unpaidCount = $orders->where('is_paid', false)->count();

        return [
            Stat::make(__('Total Orders'), $orders->count()),
            Stat::make(__('Total Amount'), Number::currency($orders->sum('amount'), in: 'EUR'))
            ->description(__('Average') . ': ' . Number::currency($orders->avg('amount'), in: 'EUR'))
            ->chart(Order::pluck('amount')->toArray())
            ->color('success'),
            Stat::make(__('Unpaid Orders'), $unpaidCount)
            ->description($unpaidCount ? Number::currency($orders->where('is_paid', false)->sum('amount'), in: 'EUR') : '')
            ->color('danger')
        ];
    }
}
