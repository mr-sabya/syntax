<div class="cart-area py-5 product-area" x-data="guestCartPage()">
    <div class="container">
        <h2 class="mb-4 fw-bold">Shopping Cart</h2>

        <div class="row g-4">
            <!-- LEFT COLUMN: Cart Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 border-0">Product</th>
                                        <th class="py-3 border-0 text-center">Price</th>
                                        <th class="py-3 border-0 text-center">Quantity</th>
                                        <th class="py-3 border-0 text-center">Total</th>
                                        <th class="pe-4 py-3 border-0 text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- SCENARIO 1: AUTH USER --}}
                                    @auth
                                    @forelse($cartItems as $item)
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('storage/' . $item->product->thumbnail_image_path) }}"
                                                    class="rounded border" style="width: 70px; height: 70px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0 fw-semibold text-dark">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">Size: Standard</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">৳{{ number_format($item->product->price, 2) }}</td>
                                        <td class="text-center">
                                            <div class="input-group input-group-sm mx-auto" style="width: 100px;">
                                                <button class="btn btn-outline-secondary" wire:click="decrement({{ $item->id }})" wire:loading.attr="disabled">-</button>
                                                <input type="text" class="form-control text-center" value="{{ $item->quantity }}" readonly>
                                                <button class="btn btn-outline-secondary" wire:click="increment({{ $item->id }})" wire:loading.attr="disabled">+</button>
                                            </div>
                                        </td>
                                        <td class="text-center fw-bold text-primary">
                                            ৳{{ number_format($item->product->price * $item->quantity, 2) }}
                                        </td>
                                        <td class="pe-4 text-end">
                                            <button class="btn btn-sm btn-light text-danger" wire:click="remove({{ $item->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="fas fa-shopping-basket fa-3x text-muted mb-3"></i>
                                            <p>Your cart is empty.</p>
                                            <a href="/" class="btn btn-primary btn-sm">Start Shopping</a>
                                        </td>
                                    </tr>
                                    @endforelse
                                    @endauth

                                    {{-- SCENARIO 2: GUEST USER (AlpineJS) --}}
                                    @guest
                                    <template x-for="item in cart" :key="item.id">
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img :src="'/storage/' + item.image" class="rounded border" style="width: 70px; height: 70px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold text-dark" x-text="item.name"></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center" x-text="'$' + parseFloat(item.price).toFixed(2)"></td>
                                            <td class="text-center">
                                                <div class="input-group input-group-sm mx-auto" style="width: 100px;">
                                                    <button class="btn btn-outline-secondary" @click="updateQty(item.id, -1)">-</button>
                                                    <input type="text" class="form-control text-center" :value="item.quantity" readonly>
                                                    <button class="btn btn-outline-secondary" @click="updateQty(item.id, 1)">+</button>
                                                </div>
                                            </td>
                                            <td class="text-center fw-bold text-primary" x-text="'$' + (item.price * item.quantity).toFixed(2)"></td>
                                            <td class="pe-4 text-end">
                                                <button class="btn btn-sm btn-light text-danger" @click="removeItem(item.id)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="cart.length === 0">
                                        <td colspan="5" class="text-center py-5">
                                            <p>Your guest cart is empty.</p>
                                            <a href="/" class="btn btn-primary btn-sm">Start Shopping</a>
                                        </td>
                                    </tr>
                                    @endguest
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 p-4 sticky-top" style="top: 20px;">
                    <h5 class="fw-bold mb-3 border-bottom pb-3">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        @auth <span class="fw-bold">${{ number_format($subtotal, 2) }}</span> @endauth
                        @guest <span class="fw-bold" x-text="'$' + cartTotal"></span> @endguest
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping Estimate</span>
                        <span class="fw-bold text-success">Free</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4 mt-3 pt-3 border-top">
                        <span class="h5 fw-bold">Total</span>
                        @auth <span class="h5 fw-bold text-primary">${{ number_format($subtotal, 2) }}</span> @endauth
                        @guest <span class="h5 fw-bold text-primary" x-text="'$' + cartTotal"></span> @endguest
                    </div>

                    @auth
                    @if(count($cartItems) > 0)
                    <a href="{{ route('checkout') }}" class="btn btn-dark w-100 py-2">Proceed to Checkout</a>
                    @else
                    <button disabled class="btn btn-dark w-100 py-2">Cart is Empty</button>
                    @endif
                    @endauth

                    @guest
                    <a href="{{ route('login') }}" wire:navigate class="btn btn-dark w-100 py-2 mb-2">Login to Checkout</a>
                    <small class="text-muted text-center d-block">You must be logged in to complete purchase.</small>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    {{-- GUEST JS LOGIC --}}
    <script>
        function guestCartPage() {
            return {
                cart: JSON.parse(localStorage.getItem('cart')) || [],
                get cartTotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0).toFixed(2);
                },
                updateQty(id, change) {
                    let item = this.cart.find(i => i.id === id);
                    if (item) {
                        item.quantity += change;
                        if (item.quantity < 1) item.quantity = 1;
                        this.save();
                    }
                },
                removeItem(id) {
                    this.cart = this.cart.filter(i => i.id !== id);
                    this.save();
                },
                save() {
                    localStorage.setItem('cart', JSON.stringify(this.cart));
                    window.dispatchEvent(new CustomEvent('cart-local-updated')); // Sync side cart
                }
            }
        }
    </script>
</div>