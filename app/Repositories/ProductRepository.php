<?php

namespace App\Repositories;

use App\Models\Product as ProductModel;
use Illuminate\Http\Request;

class ProductRepository extends RepositoryInterface
{
    public mixed $product;

    public function __construct(Request $request)
    {
        //
    }

    public function model()
    {
        return ProductModel::class;
    }

    public function showProduct(Request $request, $id)
    {
        $this->product = ProductModel::select(['id', 'title', 'description', 'price'])
            ->with('variations')
            ->find($id);
        return $this->product;
    }
}
