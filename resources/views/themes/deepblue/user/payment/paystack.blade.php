@extends($theme.'layouts.user')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection
@section('content')

<section style="padding: 120px 0"


    <section style="padding: 120px 0"id="dashboard">
        <div class="container add-fund pb-50">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card secbg br-4 customShadow">
                        <div class="card-body br-4">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <img
                                        src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}"
                                        class="card-img-top gateway-img br-4" alt="..">
                                </div>

                                <div class="col-md-9">
                                    <h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                    <h4 class="mt-15 mb-15">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h4>
                                    <button type="button"
                                            class="btn-flower2"
                                            id="btn-confirm">@lang('Pay Now')</button>
                                    <form
                                        action="{{ route('ipn', [optional($order->gateway)->code, $order->transaction]) }}"
                                        method="POST">
                                        @csrf
                                        <script
                                            src="//js.paystack.co/v1/inline.js"
                                            data-key="{{ $data->key }}"
                                            data-email="{{ $data->email }}"
                                            data-amount="{{$data->amount}}"
                                            data-currency="{{$data->currency}}"
                                            data-ref="{{ $data->ref }}"
                                            data-custom-button="btn-confirm">
                                        </script>
                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

