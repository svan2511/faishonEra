@foreach( $allProducts as $product )

<li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
        @if( $product->is_discounted == 1)
        
            <span class="my-index">sale</span>
    
                @endif
    <div class="product product-style-3 equal-elem ">
        <div class="product-thumnail">
            <a href="{{url('product')}}/{{$product->pro_slug}}" title="{{$product->product_title}}">
                <figure><img src="{{ asset('storage/admin_assets/products') }}/{{ $product->product_image }}" alt="{{$product->product_title}}"></figure>
            </a>
        </div>
        
        <div class="product-info">
            <a href="{{url('product')}}/{{$product->pro_slug}}" class="product-name"><span>{{ substr( $product->product_title ,0,25)  }}...</span></a>
            @if(count($product->productAttributes) <= 1 )
@foreach( $product->productAttributes as $attribute )

<div class="wrap-price"><ins><p class="product-price">${{$attribute->disc_price}}</p></ins> <del><p class="product-price">${{$attribute->reg_price}}</p></del></div>
@endforeach

@else
    <?php echo getRangeproductPrice($product->productAttributes);?>
@endif

<div class="wrap-butons">
    <a href="#" class="btn add-to-cart custom-cart">Add to Cart</a>
</div>
        </div>
    </div>
</li>

@endforeach