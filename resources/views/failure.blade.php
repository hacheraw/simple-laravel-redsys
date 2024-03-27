@extends('layouts.notice')

@section('content')
  <h1>{{ __('An error occurred') }}</h1>
  <p><strong>{{ __('Bank response')  }}: {{ $payment->response_message }}</strong></p>
  <p>{{ __('Don\'t hesitate to contact us if you have any questions')  }}</p>
@endsection