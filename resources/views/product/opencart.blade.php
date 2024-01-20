<x-ecommerce-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }} > {{__('open cart')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                {{--                <div class="max-w-xl">--}}
                <div class="">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('سبد خرید') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('نمایش اطلاعات سبد خرید') }}
                            </p>
                        </header>
                        <br>

                        <table class="divide-y divide-gray-300 " style="width:100%">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    شناسه
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    نام
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    قیمت واحد
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    تعداد
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    قیمت کل
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    +
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    -
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    0
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300">
                            @if($cart)
                                @foreach($cart as $id => $item)
                                    <tr class="whitespace-nowrap">
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{$item['item_id']}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{$item['item_name']}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500">
                                                {{$item['item_price']}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{$item['item_quantity']}}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{$item['Final_Price']}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button"
                                                    onclick="addToCart({{$item['item_id']}});"
                                                    class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">
                                                +
                                            </button>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button"
                                                    onclick="removeFromCart({{$item['item_id']}});"
                                                    class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">
                                                -
                                            </button>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button"
                                                    onclick="clearCart({{$item['item_id']}});"
                                                    class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">
                                                -0-
                                            </button>
                                        </td>
                                    </tr>

                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        {{-- <button type="button"--}}
                        {{-- class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 btn btn-primary"--}}
                        {{-- class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 btn btn-primary"--}}
                        {{-- onclick="addToCart();">--}}
                        {{-- اضافه کردن به سبد خرید--}}
                        {{-- </button>--}}
                    </section>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                sum of price : {{$sum}}
            </div>
            <button type="button"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 btn btn-primary"
                    {{--class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 btn btn-primary"--}}
                    onclick="deleteCart();">
                باک کردن سبد
            </button>
            <button type="button"
                    {{--class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 btn btn-primary"--}}
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 btn btn-primary"
                    onclick="orderRegistry();">
                ثبت سفارش
            </button>
        </div>
    </div>
</x-ecommerce-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script>
    function addToCart(id) {
        // alert(id);
        // let data = $('#AddToCartData').serialize();
        console.log(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route('cart.add.ajax') }}',
            data: {'id': id},
            dataType: 'json',
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
                window.location.replace('{{ route('product.search') }}');
            }
        }).done(function (response) {
            location.reload();
        });
        // e.preventDefault();
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
            },
            error: function (error) {
                console.log(error);
                window.location.replace('{{ route('product.search') }}');
            }
        }).done(function (response) {
            location.reload();
        });
        return false;
    }

    function clearCart(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '{{ route('cart.clear.ajax') }}',
            data: {'id': id},
            dataType: 'json',
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
                {{--window.location.replace('{{ route('product.search') }}');--}}
            }
        }).done(function (response) {
            location.reload();
        });
        return false;
    }

    function orderRegistry() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '{{ route('order.show') }}',
            // data: {'id': id},
            data: {'val': true},
            dataType: 'json',
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
                window.location.replace('{{ route('login') }}');
            }
        }).done(function (response) {
            // location.reload();
        });
        return false;
    }

    function deleteCart() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '{{ route('cart.delete.ajax') }}',
            data: {'delete': true},
            dataType: 'json',
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
                window.location.replace('{{ route('login') }}');
            }
        }).done(function (response) {
            location.reload();
        });
        return false;
    }
</script>
