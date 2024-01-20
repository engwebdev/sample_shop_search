<x-ecommerce-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }} > {{__('search')}}
        </h2>
    </x-slot>
    @foreach($products as $product)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{--{{ __('محصولات') }}--}}
                                    <a href="{{route('product.show',[$product->id])}}/">
                                        {{$product->title}}
                                    </a>
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{--{{ __('نمایش اطلاعات محصولات') }}--}}
                                    {{$product->description}}
                                </p>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{$product->price}}
                                </p>
                                <p class="mt-1 text-sm text-gray-600">
                                    @foreach($product->variations as $variation)
                                        {{$variation->variation_title_name}} = {{$variation->variation_value_name}}
                                        + {{$variation->variation_price}} ,
                                        <?php $product->price = $product->price + $variation->variation_price; ?>
                                    @endforeach
                                    <br>
                                    {{$product->price}}
                                </p>
                            </header>
                            <button type="button"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 btn btn-primary"
                                    onclick="addToCart({{$product->id}});">
                                اضافه کردن به سبد خرید
                            </button>
                            <button type="button"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 btn btn-primary"
                                    onclick="removeFromCart({{$product->id}});">
                                حذف از سبد خرید
                            </button>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-ecommerce-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script>
    function addToCart(id) {
        // alert(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route('cart.add.ajax') }}',
            data: {'id': id},
            dataType: 'json',
            success: function (response) {
                // console.log(response);
            }
        }).done(function (response) {
            console.log(response);
        });
        return false;
    }

    function removeFromCart(id) {
        // alert(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route('cart.remove.ajax') }}',
            data: {'id': id},
            dataType: 'json',
            success: function (response) {
                // console.log(response);
            }
        }).done(function (response) {
            console.log(response);
        });
        return false;
    }

</script>
