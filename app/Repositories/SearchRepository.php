<?php

namespace App\Repositories;


use App\Models\Product as ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchRepository extends RepositoryInterface
{
    private Request $request;
    private \Symfony\Component\HttpFoundation\InputBag $query;
    private string|int|bool|null|float $sort_by;
    private string|int|bool|null|float $order_by;
    private string|int|bool|null|float $limit;
    private string|int|bool|null|float $offset;
    private string|int|bool|null|float $page;
    private string|int|bool|null|float $min_price;
    private string|int|bool|null|float $max_price;
    private \Symfony\Component\HttpFoundation\InputBag $searchItems;
    public \Illuminate\Database\Eloquent\Builder $productQuery;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = $request->query;
        $this->searchItems = $this->query;

        $arr_sort = ['id', 'title', 'description'];
        if ($this->query->get('sort_by')) {
            $res_1 = in_array(strtoupper($this->query->get('order_by')), $arr_sort);
            if (!$res_1) {
                $this->sort_by = 'id';
            }
            else {
                $this->sort_by = $this->query->get('sort_by');
            }
        }
        else {
            $this->sort_by = 'id';
        }

        $arr_order = ['ASC', 'DESC'];
        if ($this->query->get('order_by')) {
            $res_2 = in_array(strtoupper($this->query->get('order_by')), $arr_order);
            if (!$res_2) {
                $this->order_by = 'asc';
            }
            else {
                $this->order_by = $this->query->get('order_by');
            }
        }
        else {
            $this->order_by = 'asc';
        }

        // ctype_digit()
        if (is_numeric($this->query->get('limit'))) {
            $this->limit = $this->query->get('limit');
        }
        else {
            $this->limit = '10';
        }

        if (is_numeric($this->query->get('page'))) {
            $this->page = $this->query->get('page');
        }
        else {
            $this->page = '1';
        }

//        $this->offset = $this->query->get('offset');
        $this->min_price = $this->query->get('min_price');
        $this->max_price = $this->query->get('max_price');

        $this->searchItems->remove('sort_by');
        $this->searchItems->remove('order_by');
        $this->searchItems->remove('limit');
        $this->searchItems->remove('page');
        $this->searchItems->remove('min_price');
        $this->searchItems->remove('max_price');
    }

    public function model()
    {
        return ProductModel::class;
    }

//        $searchItems = [
//            'color' => 'green',
//            'brand' => 'apple'
//            ...
//        ];

    public function search()
    {
        $this->productQuery = ProductModel::query();
        foreach ($this->searchItems as $variation_title_name => $variation_value_name) {
            $this->productQuery = $this->productQuery->whereHas('variations',
                function ($query) use ($variation_title_name, $variation_value_name) {
                    $query
                        ->where('variation_title_name', $variation_title_name) // color // brand
                        ->Where('variation_value_name', $variation_value_name); // green // apple
                });
        }
//        if(isset($this->min_price) && isset($this->max_price)){
//            $this->productQuery
//                ->where('price', '>', $this->min_price)
//                ->where('price', '<', $this->max_price);
//        }numquam


        $key = 'qu';// seeder
        return Cache::remember('products', 300, function () use($key) {
            return $this->productQuery
                ->where('title', 'LIKE', '%'.$key.'%')
                ->orwhere('description', 'LIKE', '%'.$key.'%')
                ->orderBy($this->sort_by, $this->order_by)
                ->with('variations')
                ->paginate($this->limit, '*', 'page', $this->page);
        });
    }
}
