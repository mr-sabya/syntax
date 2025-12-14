<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    // Form Properties
    public $fullname;
    public $email;
    public $phone;
    public $address;
    public $city;
    public $zip;
    public $payment_method = 'cod'; // Default

    public function mount()
    {
        // Redirect if not logged in or cart is empty
        if (!Auth::check() || Cart::where('user_id', Auth::id())->count() == 0) {
            return redirect()->route('cart');
        }

        $user = Auth::user();
        $this->fullname = $user->name;
        $this->email = $user->email;
        // You can pre-fill other fields if you have them in your User model
    }

    protected $rules = [
        'fullname' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'city' => 'required',
        'zip' => 'required',
        'payment_method' => 'required'
    ];

    public function placeOrder()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $userId = Auth::id();
            $cartItems = Cart::with('product')->where('user_id', $userId)->get();

            // 1. Calculate Financials
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }

            $discount = 0;
            $shippingCost = 0;
            $tax = 0;
            $totalAmount = ($subtotal + $shippingCost + $tax) - $discount;

            // 2. Parse Name
            $parts = explode(' ', $this->fullname);
            $lastName = count($parts) > 1 ? array_pop($parts) : '';
            $firstName = implode(' ', $parts);

            // 3. Create Order
            $order = Order::create([
                'user_id' => $userId,
                // Billing
                'billing_first_name' => $firstName,
                'billing_last_name' => $lastName,
                'billing_email' => $this->email,
                'billing_phone' => $this->phone,
                'billing_address_line_1' => $this->address,
                'billing_city' => $this->city,
                'billing_zip_code' => $this->zip,
                'billing_country' => 'Bangladesh',
                'billing_state' => '',

                // Shipping
                'shipping_first_name' => $firstName,
                'shipping_last_name' => $lastName,
                'shipping_email' => $this->email,
                'shipping_phone' => $this->phone,
                'shipping_address_line_1' => $this->address,
                'shipping_city' => $this->city,
                'shipping_zip_code' => $this->zip,
                'shipping_country' => 'Bangladesh',
                'shipping_state' => '',

                // Financials
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'shipping_cost' => $shippingCost,
                'tax_amount' => $tax,
                'total_amount' => $totalAmount,
                'currency' => 'BDT',

                // Statuses
                'payment_method' => $this->payment_method,
                'payment_status' => PaymentStatus::Pending,
                'order_status' => OrderStatus::Pending,
                'placed_at' => now(),
            ]);

            // 4. Create Order Items
            foreach ($cartItems as $item) {
                $itemSubtotal = $item->product->price * $item->quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,

                    // --- FIX STARTS HERE ---
                    // Assign the vendor from the product. 
                    // If your Product model uses 'user_id' for the vendor, change to $item->product->user_id
                    'vendor_id' => $item->product->vendor_id ?? 1,
                    // --- FIX ENDS HERE ---

                    'item_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            // 5. Clear Cart
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('checkout.success', ['orderId' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('base', 'Order failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $cartItems = [];
        $total = 0;

        if (Auth::check()) {
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }
        }

        return view('livewire.frontend.checkout.index', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }
}
