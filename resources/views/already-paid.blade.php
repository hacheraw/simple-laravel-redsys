@extends('layouts.notice')

@section('content')
  <h1>{{ __('Already paid') }}</h1>
  <p>{{ __('This invoice has already been paid on') }} {{ $order->paid_at }}</p>
@endsection