<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private SearchRepository $searchRepository;
    private ProductRepository $productRepository;

    public function __construct(SearchRepository $searchRepository, ProductRepository $productRepository)
    {
        $this->searchRepository = $searchRepository;
        $this->productRepository = $productRepository;
    }

    public function search(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if ($request->header('referer')) {
            $explode = explode('/', $request->header('referer'));
            $referer = end($explode);
            if ($referer == 'cart') {
                // notify
            }
        }

        $products = $this->searchRepository->search($request);

        return view('product.search', [
            'products' => $products,
        ]);
    }


    public function show(Request $request, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if (\Illuminate\Support\Facades\Cache::has('product' . '_' . $id)) {
            return view('product.single', [
                'product' => (\Illuminate\Support\Facades\Cache::get('product' . '_' . $id)),
            ]);
        }
        $product = $this->productRepository->showProduct($request, $id);
        \Illuminate\Support\Facades\Cache::put('product' . '_' . $id, $product);
        return view('product.single', [
            'product' => $product,
        ]);
    }
}
