
@extends('Manager.included.header')


@section('content')


<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


    <div class="row">
        <div class="col-md-12">
            @include('Manager.included.notfication')

            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">

                                {{ t('Edit Sub Category') }}

                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form id="form_manager" class="kt-form" action="{{ route('sub_category.update',$sub_category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">




                                <div class="form-group">
                                    <label >{{ t('Category') }}</label>
                                    <select name="category_id" class="form-control select2" >
                                        <option value="" disabled selected>{{ t('Category') }}</option>

                                                @foreach($categories as $category)
                                                    <option {{ $sub_category->category_id == $category->id ? 'selected' : ''  }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach


                                    </select>
                                </div>



                                @foreach (config('translatable.locales') as $local)
                                    <div class="form-group">
                                        <label>@lang("site." . $local . ".Category Name") </label>

                                        <input type="text" name="{{$local}}[name]"
                                        value="{{ $sub_category->translate($local)->name }}"
                                        class="form-control" aria-describedby="emailHelp"
                                        placeholder="@lang('site.' . $local . '.Category Name')">
                                    </div>

                                 @endforeach



                                <div class="kt-form__actions">
                                    <button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
                                    <a href="{{ route('sub_category.index') }}">
                                        <button type="button" class="btn btn-secondary">
                                            {{ t('Cancle') }}
                                        </button>
                                    </a>
                                </div>


                            </div>

                            <div class="col-md-3"></div>


                        </div>






                    </div>

                </form>

                <!--end::Form-->
            </div>

            <!--end::Portlet-->


            <!--end::Portlet-->
        </div>

    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! $validator->selector('#form_manager') !!}


@endpush

@endsection



