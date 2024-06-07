@extends('admin.layouts.app')

@section('title')
    @lang('Edit Sub-Caste')
@endsection

@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-end">
                <a href="{{route('admin.subCasteList')}}" class="btn btn-sm  btn-primary mr-2">
                    <span><i class="fas fa-arrow-left"></i> @lang('Back')</span>
                </a>
            </div>


            <div class="mt-2">
                <form method="post" action="{{ route('admin.subCasteUpdate',[$id]) }}" class="mt-4">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-4">
                            <label for="caste_id"> @lang('Select Caste') </label>
                            <select name="caste_id" class="form-control @error('caste_id') is-invalid @enderror">
                                @forelse ($casteList as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $subCasteList[0]->caste_id ? 'selected' : '' }}>@lang($item->name)</option>
                                @empty
                                @endforelse
                            </select>

                            <div class="invalid-feedback mt-3">
                                @error('caste_id') @lang($message) @enderror
                            </div>
                            <div class="valid-feedback"></div>
                        </div>

                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="name"> @lang('Sub-Caste Name') </label>
                            <input type="text" name="name"
                                   class="form-control  @error('name') is-invalid @enderror"
                                   value="<?php echo old('name', isset($subCasteList) ? @$subCasteList[0]->name : '') ?>">
                            <div class="invalid-feedback">
                                @error('name') @lang($message) @enderror
                            </div>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">@lang('Update')</button>
                </form>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script>
        "use strict";
        $(document).ready(function (e) {
            $('select').select2({
                selectOnClose: true
            });
        });
    </script>

    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp
        <script>
            "use strict";
            @foreach ($errors as $error)
            Notiflix.Notify.Failure("{{trans($error)}}");
            @endforeach
        </script>
    @endif
@endpush
