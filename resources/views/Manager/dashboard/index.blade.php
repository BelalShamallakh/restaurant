@extends('Manager.included.header')





@section('content')


    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--begin:: Widgets/Stats-->
        <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row  row-col-separator-xl">

                    <div class="col-md-12 col-lg-6 col-xl-6">

                        <!--begin::New Orders-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <a href="{{ route('category.index') }}">
                                        <h4 class="kt-widget24__title">
                                            {{ t('Categorirs') }}
                                        </h4>
                                    </a>

                                </div>
                                <span class="kt-widget24__stats kt-font-info">
                                    {{ $categories->count() }}
                                </span>
                            </div>


                        </div>

                        <!--end::New Orders-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-6">

                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <a href="{{ route('item.index') }}">
                                        <h4 class="kt-widget24__title">
                                            {{ t('Items') }}
                                        </h4>
                                    </a>

                                </div>
                                <span class="kt-widget24__stats kt-font-info">
                                    {{ $items->count() }}
                                </span>
                            </div>

                        </div>

                        <!--end::New Users-->
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row  row-col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <!--begin::Total Profit-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <a href="{{ route('sub_category.index') }}">
                                        <h4 class="kt-widget24__title">
                                            {{ t('Sub Categories') }}
                                        </h4>
                                    </a>

                                </div>
                                <span class="kt-widget24__stats kt-font-info">
                                    {{ $sub_categories->count() }}
                                </span>
                            </div>


                        </div>
                        <!--end::Total Profit-->
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-6">

                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <a href="{{ route('contact.index') }}">
                                        <h4 class="kt-widget24__title">
                                            {{ t('Contacts') }}
                                        </h4>
                                    </a>

                                </div>
                                <span class="kt-widget24__stats kt-font-info">
                                    {{ $contacts->count() }}
                                </span>
                            </div>

                        </div>

                        <!--end::New Users-->
                    </div>
                </div>


            </div>
        </div>





        <div class="row">


            <div class="col-xl-4">

                <!--begin:: Widgets/Support Tickets -->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{ t('Latest Contacts') }}
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget3">
                            @foreach ($latest_contacts as $latest_contact)

                                <div class="kt-widget3__item">
                                    <div class="kt-widget3__header">
                                        <div class="kt-widget3__user-img">
                                            <i class="fa fa-user-tie fa-2x text-primary"></i>
                                        </div>
                                        <div class="kt-widget3__info">
                                            <a  class="kt-widget3__username">
                                                {{ $latest_contact->email }}
                                            </a><br>
                                            <span class="kt-widget3__time">
                                                {{ $latest_contact->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <span class="kt-widget3__status kt-font-info">
                                        </span>
                                    </div>
                                    <div class="kt-widget3__body">
                                        <p class="kt-widget3__text">
                                            {!! Str::limit($latest_contact->message,500) !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Support Tickets -->
            </div>
            <div class="col-xl-8">

                <!--begin:: Widgets/New Users-->
                <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                               {{t('Latest Items')}}
                            </h3>
                        </div>

                    </div>
                    <style>
                        .kt-widget4 .kt-widget4__item .kt-widget4__pic img {
                            width: 2.5rem;
                            border-radius: 4px;
                            width: 120px;
                        }
                    </style>
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget4_tab1_content">
                                <div class="kt-widget4">
                                    @foreach ($latest_items as $latest_item)
                                        <div class="kt-widget4__item">
                                            <div class="kt-widget4__pic ">
                                                <img  src="{{ $latest_item->image }}" alt="">
                                            </div>
                                            <div class="kt-widget4__info">

                                                <a  class="kt-widget4__username" style="font-weight: bold">
                                                    {{ $latest_item->name }}
                                                </a>
                                                <p class="kt-widget4__text">
                                                    {!! Str::limit($latest_item->description,500) !!}
                                                </p>
                                            </div>
                                            @if ($latest_item->subCategory)
                                                <a class="badge badge-primary text-white">{{ $latest_item->subCategory->category_name }}</a>
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--end:: Widgets/New Users-->
            </div>
        </div>




    </div>




@endsection

