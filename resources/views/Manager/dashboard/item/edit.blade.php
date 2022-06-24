
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

                                {{ t('Edit Item') }}

                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form id="form_manager" class="kt-form" action="{{ route('item.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">


                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> {{ t('Image') }}</label>

                                    <div class="custom-file">
                                        <input   name="image" type="file" class="form-control-file image"  >
                                    </div>
                                    <img src="{{ $item->image }}"  class="img-fluid img-thumbnail image_preview"  width="100" height="100" >
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>


                        <div class="row">
                            <div class="col-md-2"></div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label > {{ t('Category') }}</label>
                                    <select name="sub_category_id"  class="form-control select2 dynamic_floor" >
                                        <option value="" disabled selected>{{ t('Category') }}</option>
                                        @foreach ($categories as $category)
                                            <optgroup label="{{ $category->name }}">
                                                @foreach($category->subCategories as $subCategory)
                                                    <option {{ $item->sub_category_id == $subCategory->id ? 'selected' : '' }}
                                                    value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2"></div>



                        </div>




                        <div class="row">
                            <div class="col-md-2"></div>

                            @foreach (config('translatable.locales') as $local)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang("site." . $local . ".Item Name") </label>

                                        <input type="text" name="{{$local}}[name]"
                                        value="{{ $item->translate($local)->name }}"

                                         class="form-control" aria-describedby="emailHelp"
                                        placeholder="@lang('site.' . $local . '.Item Name')">
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-2"></div>
                        </div>


                        <div class="row">
                            <div class="col-md-2"></div>

                            @foreach (config('translatable.locales') as $local)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">@lang("site." . $local . ".Item Description") </label>
                                            <textarea  name="{{$local}}[description]"
                                            class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="@lang('site.' . $local . '.Item Description')">{{  $item->translate($local)->description  }}</textarea>
                                          </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-2"></div>
                        </div>





                        <div class="row">
                            <div class="col-md-2"></div>

                            <div class="col-md-4">
                                <label>{{ t('Price') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                    <input type="text" value="{{ $item->price }}" name="price" class="form-control" placeholder="{{ t('Price') }}" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>{{ t('Calorie') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-fire-alt"></i></span></div>
                                    <input type="text" value="{{ $item->calorie }}" name="calorie" class="form-control" placeholder="{{ t('Calorie') }}" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-md-2"></div>
                        </div>

                        <br><br>






                        <br><br>
                        <div class="kt-form__actions text-center">
                            <button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
                            <a href="{{ route('item.index') }}">
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

    {!! $validator->selector('#form_manager') !!}


    {{-- <script>
        $(document).ready(function () {
            $('.dynamic_floor').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var category_id = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('item.fetchSubCategory') }}",
                        method: "POST",
                        data: {category_id: category_id, _token: _token},
                        success: function (result) {
                            $('#sub_category').html(result);
                            // $('select').refresh;

                        }

                    })
                }
            });
        });

    </script> --}}

@endpush

@endsection



