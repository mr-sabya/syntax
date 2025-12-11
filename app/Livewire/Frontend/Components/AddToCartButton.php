<?php

namespace App\Livewire\Frontend\Components;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCartButton extends Component
{
    public $productId;
    public $qty = 1;
    public $class = ''; // Allow passing custom CSS classes
    public $showIcon = true;
    public $text = 'Add to Cart';

    public function mount($productId, $qty = 1, $class = 'btn-primary', $showIcon = true, $text = 'Add to Cart')
    {
        $this->productId = $productId;
        $this->qty = $qty;
        $this->class = $class;
        $this->showIcon = $showIcon;
        $this->text = $text;
    }

    public function addToCart()
    {
        // 1. Fetch Product Details (We query here to keep page load fast)
        $product = Product::find($this->productId);

        if (!$product) {
            $this->dispatch('notify', type: 'error', message: 'Product not found');
            return;
        }

        // 2. Authenticated Logic (Database)
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->first();

            if ($cart) {
                $cart->increment('quantity', $this->qty);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $this->productId,
                    'quantity' => $this->qty
                ]);
            }

            // Update Header/Side Cart
            $this->dispatch('cart-updated');
            $this->dispatch('notify', type: 'success', message: 'Added to cart!');
        }

        // 3. Guest Logic (Pass data to JS)
        else {
            $this->dispatch('add-to-local-storage', data: [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->thumbnail_image_path, // Ensure accessor/path is correct
                'slug' => $product->slug,
                'quantity' => $this->qty
            ]);
        }
    }

    public function render()
    {
        return view('livewire.frontend.components.add-to-cart-button');
    }
}
