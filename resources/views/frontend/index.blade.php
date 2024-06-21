@extends('layouts.front')

@section('title')
    Welcome to E-COM
@endsection

@section('content')
    @include('layouts.inc.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Featured Product</h2>
                @foreach ($featured_products as $prod)
                    <div class="col-md-3 mt-3">
                        <div class="card">
                            <a href="{{ url('category/' . $prod->category->name . '/' . $prod->slug) }}">
                                <img src="{{ asset('assets/uploads/products/' . $prod->image) }}" alt="Product image"
                                    width="auto" height="300">
                                <div class="card-body" style="color: black; text-decoration: none">
                                    <h5>{{ $prod->name }}</h5>
                                    <span class="float-start">{{ $prod->selling_price }}</span>
                                    <span class="float-end"><s>{{ $prod->original_price }}</s></span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Trending Category</h2>
                @foreach ($trending_category as $trend_cate)
                    <div class="col-md-3 mt-3">
                        <a href="{{ url('view-category/' . $trend_cate->slug) }}">
                            <div class="card">
                                <img src="{{ asset('assets/uploads/category/' . $trend_cate->image) }}" alt="Product image"
                                    width="auto" height="300">
                                <div class="card-body">
                                    <h5>{{ $trend_cate->name }}</h5>
                                    <p>
                                        {{ $trend_cate->description }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
@endsection --}}
