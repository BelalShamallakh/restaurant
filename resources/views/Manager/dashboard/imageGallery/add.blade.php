
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

                                {{ t('Add Image') }}

                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form id="form_manager" class="kt-form" action="{{ route('imageGallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">



                                    <div class="form-group">
                                        <label> {{ t('Image') }}</label>

                                        <div class="custom-file">
                                            <input   name="image" type="file" class="form-control-file image"  >
                                        </div>
                                        <img   class="img-fluid img-thumbnail image_preview"  width="100" height="100" >
                                    </div>




                                <div class="kt-form__actions">
                                    <button type="submit" class="btn btn-primary">{{ t('Submit') }}</button>
                                    <a href="{{ route('imageGallery.index') }}">
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



