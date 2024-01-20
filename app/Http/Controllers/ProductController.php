<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product as ProductResource;
use App\Models\Product as ProductModel;
use App\Models\Variation;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function search(Request $request)
    {
        if ($request->header('referer')) {
            $explode = explode('/', $request->header('referer'));
            $referer = end($explode);
            if ($referer == 'cart') {
                // notify
            }
        }

//        $filters = ['sort_by', 'order_by', 'limit', 'offset', 'page'];
//        ?iste=magni&esse=autem&sort_by=aaa&order_by=bbb&page=2
//        $searchItems = [
//            'color' => 'green',
//            'brand' => 'apple'
//            ...
//        ];
        $searchItems = $request->query;
        $sort_by = $searchItems->get('sort_by');
        $searchItems->remove('sort_by');
        $order_by = $searchItems->get('order_by');
        $searchItems->remove('order_by');
        $limit = $searchItems->get('limit');
        $searchItems->remove('limit');
        $offset = $searchItems->get('offset');
        $searchItems->remove('offset');
        $page = $searchItems->get('page');
        $searchItems->remove('page');
        $min_price = $searchItems->get('min_price');
        $searchItems->remove('min_price');
        $max_price = $searchItems->get('max_price');
        $searchItems->remove('max_price');

        $productQuery = ProductModel::query();
        foreach($searchItems as $variation_title_name => $variation_value_name)
        {
            $productQuery = $productQuery->whereHas('variations',
                function ($query) use ($variation_title_name, $variation_value_name) {
                $query
                    ->where('variation_title_name', $variation_title_name) // color // brand
                    ->Where('variation_value_name', $variation_value_name); // green // apple
            });
        }
        $products = $productQuery->with('variations')->get();

        return view('product.search', [
            'products' => $products,
        ]);
    }


    public function show(Request $request, $id)
    {
        $product = ProductModel::select(['id', 'title', 'description', 'price'])
            ->with('variations')
            ->find($id);

        return view('product.single', [
            'product' => $product,
        ]);
    }
}
