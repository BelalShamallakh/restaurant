@extends('Manager.included.header')


@section('content')


    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">


            <div class="col-md-12">


                @if ($errors->count() > 0)
                    @foreach ($errors->all() as $error)

                        <div class="alert alert-dismissible fade show" style="background-color:#e43b62;color:white"
                             role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{ t('Notification') }}: </strong> {{ $error }}.
                        </div>
                @endforeach

            @endif




            <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{ t('Add Setting') }}

                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('setting.update', $setting->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <br><br><br>

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> {{ t('Logo') }}</label>

                                    <div></div>
                                    <div class="custom-file">

                                        <input name="logo" type="file" class="form-control-file image">
                                        <br>
                                        <img src="{{ asset($setting->logo) }}"
                                             class="img-fluid img-thumbnail image_preview" width="100" height="100">
                                        <br>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> {{ t('Mini Logo') }}</label>

                                    <div></div>
                                    <div class="custom-file">

                                        <input name="miniLogo" type="file" class="form-control-file image2">
                                        <br>
                                        <img src="{{ asset($setting->miniLogo) }}"
                                             class="img-fluid img-thumbnail image_preview2" width="100"
                                             height="100">
                                        <br>

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <br><br><br>


                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-3">
                                <div class="kt-portlet__body">

                                        <div class="form-group">
                                            <label>{{ t('Blog Name') }} </label>
                                            <input value="{{ $setting->blog_name }}" type="text" name="blog_name"  class="form-control" aria-describedby="emailHelp"
                                            placeholder="{{ t('Blog Name') }}">
                                        </div>




                                    <div class="form-group">
                                        <label>{{ t('Address') }}</label>

                                        <input type="text" value="{{ $setting->address }}"
                                                name="address" class="form-control"
                                                placeholder="{{ t('Address') }}">
                                    </div>



                                    <div class="form-group">
                                        <label>{{ t('Instagram') }} </label>

                                        <input value="{{ $setting->instagram }}" type="text" name="instagram"
                                                class="form-control" aria-describedby="emailHelp"
                                                placeholder="{{ t('Instagram') }}">
                                    </div>


                                    <div class="form-group">
                                        <label>{{ t('Linkedin') }} </label>

                                        <input value="{{ $setting->linkedin }}" type="text" name="linkedin"
                                               class="form-control" aria-describedby="emailHelp"
                                               placeholder="{{ t('Linkedin') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ t('Email') }} </label>

                                        <input value="{{ $setting->email }}" type="text" name="email"
                                               class="form-control"
                                               aria-describedby="emailHelp" placeholder="{{ t('Email') }}">
                                    </div>




                                </div>


                            </div>

                            <div class="col-md-3">
                                <div class="kt-portlet__body">

                                        <div class="form-group">
                                            <label>{{ t('Description') }} </label>
                                            <input value="{{ $setting->description }}"
                                            type="text" name="description"  class="form-control" aria-describedby="emailHelp"
                                            placeholder="{{ t('Description') }}">
                                        </div>


                                    <div class="form-group">
                                        <label>{{ t('Facebook') }} </label>

                                        <input value="{{ $setting->facebook }}" type="text" name="facebook"
                                               class="form-control" aria-describedby="emailHelp"
                                               placeholder="{{ t('Facebook') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ t('Twitter') }} </label>

                                        <input value="{{ $setting->twitter }}" type="text" name="twitter"
                                               class="form-control" aria-describedby="emailHelp"
                                               placeholder="{{ t('Twitter') }}">
                                    </div>


                                    <div class="form-group">
                                        <label>{{ t('Whatsapp') }}</label>

                                        <input value="{{ $setting->whatsapp }}" type="text" name="whatsapp"
                                               class="form-control" aria-describedby="emailHelp"
                                               placeholder="{{ t('Whatsapp') }}">
                                    </div>


                                    <div class="form-group">
                                        <label>{{ t('Phone') }} </label>

                                        <input value="{{ $setting->phone }}" type="text" name="phone"
                                               class="form-control"
                                               aria-describedby="emailHelp" placeholder="{{ t('Phone') }}">
                                    </div>

                                </div>


                            </div>
                            <div class="col-md-3"></div>

                        </div>


                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="kt-form__actions">
                                    <button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
                                    <a href="{{ route('dashbaord') }}">
                                        <button type="button" class="btn btn-secondary">
                                            {{ t('Cancle') }}
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <br>
                        <br>


                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->


                <!--end::Portlet-->
            </div>


        </div>
    </div>

@endsection
