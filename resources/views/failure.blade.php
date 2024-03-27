@extends('layouts.notice')

@section('content')
<h1>{{ __('Payment failed') }}</h1>
@if (!empty($payment->response_message))
  <p><strong>{{ __('Bank response') }}: {{ $payment->response_message }}</strong></p>
  @else
  <p><strong>{{ __('Did you cancel the process?') }}</strong></p>
  @endif
  <p>{{ __('Don\'t hesitate to contact us if you have any questions')  }}</p>
@endsection