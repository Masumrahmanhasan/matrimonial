@extends($theme.'layouts.user')
@section('title', trans('Warning'))
@section('content')


<section style="padding: 120px 0"

    <section style="padding: 120px 0"id="feature" class="about-page secbg-1 py-5">
        <div class="feature-wrapper add-fund">

            <div class="container-fluid">
                <div class="row justify-content-center">

                    <div class="col-md-8">

                        <div class="card secbg customShadow">
                            <div class="card-body ">

                                <h1 class="text-center text-warning mt-5"><i
                                        class="fa fa-warning"></i>
                                    @lang('Warning')
                                </h1>
                                <h4 class="text-center">@lang('Uh-ho! We are unable to process your Payment by this method.')
                                    <br>@lang('This method is under construction')!!
                                </h4>
                                <br>
                                <h4 class="text-center">@lang('Select') <b>@lang('bkash')</b> @lang('as your payment method')</h4>
                                <div class="col-md-8 col-md-offset-2">

                                    <div class="panel panel-info">
                                        <div class="panel-body">

                                            <div class="text-center">
                                                <a href="{{ route('addFund',["bkash",session()->get('id')]) }}">
                                                    <img class="w-100"src="{{ asset('assets/upload/logo/bkash.png') }}"
                                                         style="max-width: 100px;">
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
