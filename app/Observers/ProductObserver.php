<?php

namespace App\Observers;

use App\Models\Product;
use App\Traits\Response;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->slug = Str::slug($product->name);
        $product->user_id = auth()->id();
        $product->is_active = 1;
    }

    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updating" event.
     *
     * @param  \App\Models\Product  $product
     */
    public function updating(Product $product)
    {
        if ($product->user_id != auth()->id()) {
            return Response::errorResponse('Unauthorized action');
        }
        $product->slug = Str::slug($product->name);
    }


    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleting" event.
     *
     * @param  \App\Models\Product  $product
     */
    public function deleting(Product $product)
    {
        if ($product->user_id != auth()->id()) {
            return Response::errorResponse('Unauthorized action');
        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
