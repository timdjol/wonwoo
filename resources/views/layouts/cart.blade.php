@if($products->isNotEmpty())
    <div class="row search_res" id="search_res">
    @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-6" style="margin-bottom: 40px">
            <div class="products-item">
                <div class="img-wrap">
                    <div class="labels">
                        @if($product->isNew())
                            <div class="badge badge-success">@lang('product.properties.new')</div>
                        @endif
                        @if($product->isRecommend())
                            <div class="badge badge-warning">@lang('product.properties.recommend')</div>
                        @endif
                        @if($product->isHit())
                            <div class="badge badge-danger">@lang('product.properties.hit')</div>
                        @endif
                    </div>
                    <a href="{{ route('product', [isset($category) ? $category->code : $product->category->code, $product->code]) }}">
                        <div class="img" style="background-image: url({{ Storage::url($product->image) }})"></div>
                    </a>
                </div>
                <h4>{{ $product->__('title') }}</h4>
                <div class="price"><ins>{{ $product->price }} {{ $currencySymbol }}</ins></div>
                {{--    <div class="price price_sale"><def>{{ $product->price_sale }} {{ $currencySymbol }}</def></div>--}}
                {{--    @if($sku->isAvailable())--}}
                {{--        <form action="{{ route('basket-add', $sku) }}" method="POST">--}}
                {{--            <button class="more" type="submit">@lang('product.addtocart')</button>--}}
                {{--            @csrf--}}
                {{--        </form>--}}
                {{--    @else--}}
                {{--        <p>@lang('product.no_available')</p>--}}
                {{--    @endif--}}
                <div class="buy">
                    <form action="{{ route('basket-add', $product) }}" method="post">
                        <button class="more" type="submit">@lang('product.addtocart')</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@else
    <h2>@lang('main.not_found')</h2>
@endif


