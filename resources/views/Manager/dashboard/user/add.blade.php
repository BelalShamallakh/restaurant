
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

                                {{ t('Add Employee') }}

                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form autocomplete="off" id="form_item" class="kt-form" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="kt-portlet__body">



                  \


                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">


                                <div class="form-group">
                                    <label>{{ t('Email') }} </label>

                                    <input value="{{ old('email') }}" type="email" name="email" class="form-control"
                                    placeholder="{{ t('Email') }}">
                                </div>

                                <div class="form-group">
                                    <label>{{ t('Phone') }} </label>

                                    <input value="{{ old('phone') }}" type="text" name="phone" class="form-control"
                                    placeholder="{{ t('Phone') }}">
                                </div>

                            </div>
                            <div class="col-md-4">


                                <div class="form-group">
                                    <label>{{ t('Password') }} </label>

                                    <input value="{{ old('password') }}" type="password" name="password" class="form-control"
                                    placeholder="{{ t('Password') }}">
                                </div>


                            </div>


                            <div class="col-md-2"></div>

                        </div>




                        <br><br><br>

                        <div class="kt-form__actions text-center">
                            <button type="submit" class="btn btn-primary">{{ t('Submit') }}</button>
                            <a href="{{ route('user.index') }}">
                                <button type="button" class="btn btn-secondary">
                                    {{ t('Cancle') }}
                                </button>
                            </a>
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

    {!! $validator->selector('#form_item') !!}


@endpush

@endsection



