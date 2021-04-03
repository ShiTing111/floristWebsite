<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function increaseQuantity($rowId)
    {
        $bouquet = Cart::get($rowId);
        $qty = $bouquet->qty + 1;
        Cart::update($rowId,$qty);
    }

    public function decreaseQuantity($rowId)
    {
        $bouquet = Cart::get($rowId);
        $qty = $bouquet->qty - 1;
        Cart::update($rowId,$qty);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('carts.index');
    }
}
