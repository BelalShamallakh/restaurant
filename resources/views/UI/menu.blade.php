@extends('UI.front')


@section('title')
  - {{ t('Offer Menu') }}
@endsection


@section('nav')
    @include('UI.nav_menu')
@endsection


@section('content')
    <div class="header-menu">
        <div class="overlay">
            <div class="container">
                <div class="breadcrumb-content">
                    <h3>{{__('front.bg-menu-title')}}</h3>
                    <ul>
                        <li><a href="{{ route('index') }}">{{__('front.home')}}</a></li>
                        <li class="active">{{__('front.our-menu')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="menu-tab-area">
        <div class="container">
            <div class="menu-tab-header text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-10 col-12">
                        <h2>{{__('front.menu-tab-header-title')}}</h2>
                        <p>{{__('front.menu-tab-header-paragraph')}}</p>
                    </div>
                </div>
            </div>

            <div class="menu-tab">
                @if (isset($categories))
                    @if ($categories->count() > 0)
                        @foreach ($categories as $category)
                            @if ($category->subCategories->count() > 0)
                                @foreach ($category->subCategories as $subCategory)

                                    <div class="parent-menu-tab text-center">
                                        <h2>{{ $category->name }} - {{ $subCategory->name }}</h2>
                                    </div>
                                    <div class="row">
                                        @if ($subCategory->items->count() > 0)
                                            @foreach ($subCategory->items as $item)
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="single-menu">
                                                        <div class="menu-img" data-toggle="modal" data-target="#{{ $item->id }}">
                                                            <img  data-src="{{ asset($item->image) }}" alt="{{ t('thailand restaurant') }} - {{ $item->name }}" class="lazyload">
                                                            <div class="icon-more">
                                                                <i class="fa fa-eye"></i>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="{{ $item->id }}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="exampleModalLabel">{{ $item->name }}</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img  data-src="{{ asset($item->image) }}" alt="{{ t('thailand restaurant') }} - {{ $item->name }}" class="lazyload">
                                                                        <div class="sar-cal">
                                                                                <span>{{__('front.nis')}} {{ $item->price }}</span>
                                                                                @if ($item->calorie)
                                                                                    <span>{{__('front.cal')}} {{ $item->calorie }}</span>
                                                                                @endif
                                                                        </div>
                                                                        <p>{{ $item->description }}</p>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="menu-content">
                                                            <h4>{{ $item->name }}</h4>
                                                            <span>{{ $item->price }} {{__('front.nis')}}</span>
                                                            <div class="dotted-lines"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>

                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endif

            </div>

        </div>
    </div>

@endsection
