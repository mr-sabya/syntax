<!-- Root Div -->
<div class="d-flex flex-column h-100"
    x-data="guestCartLogic()"
    x-init="initCart()">

    <!-- Header -->
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold">My Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <!-- Body (Scrollable) -->
    <div class="offcanvas-body d-flex flex-column p-4 overflow-auto">

        {{-- ================= AUTHENTICATED USERS ================= --}}
        @auth
        @forelse($cartItems as $item)
        <div class="cart-item d-flex gap-3 mb-3 border-bottom pb-3" wire:key="cart-item-{{ $item->id }}">
            <!-- Product Image -->
            <img src="{{ asset('storage/' . $item->product->thumbnail_image_path) }}"
                class="rounded" style="width: 70px; height: 70px; object-fit: cover;">

            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start">
                    <!-- Product Name -->
                    <h6 class="mb-0 fw-semibold">{{ Str::limit($item->product->name, 20) }}</h6>

                    <!-- DELETE BUTTON (Auth) -->
                    <button type="button"
                        wire:click="remove({{ $item->id }})"
                        wire:loading.attr="disabled"
                        class="btn btn-sm text-danger p-0 ms-2"
                        title="Remove item">
                        <i class="fas fa-trash-alt"></i> <!-- FontAwesome Icon -->
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="fw-bold">${{ number_format($item->product->price, 2) }}</span>

                    {{-- Quantity Stepper --}}
                    <div class="input-group input-group-sm qty-container" style="width: 90px;">
                        <button class="qty-btn btn btn-light border"
                            wire:click="decrement({{ $item->id }})"
                            wire:loading.attr="disabled">-</button>

                        <input type="text" class="form-control text-center p-0" value="{{ $item->quantity }}" readonly>

                        <button class="qty-btn btn btn-light border"
                            wire:click="increment({{ $item->id }})"
                            wire:loading.attr="disabled">+</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <i class="fas fa-shopping-basket fa-3x text-muted mb-3"></i>
            <p class="text-muted">Your cart is empty.</p>
        </div>
        @endforelse
        @endauth

        {{-- ================= GUEST USERS (ALPINE JS) ================= --}}
        @guest
        <!-- Empty State for Guest -->
        <div x-show="guestItems.length === 0" class="text-center mt-5" style="display: none;">
            <i class="fas fa-shopping-basket fa-3x text-muted mb-3"></i>
            <p class="text-muted">Your cart is empty.</p>
        </div>

        <!-- Loop Guest Items -->
        <template x-for="item in guestItems" :key="item.id">
            <div class="cart-item d-flex gap-3 mb-3 border-bottom pb-3">
                <!-- Image -->
                <img :src="'/storage/' + item.image" class="rounded" style="width: 70px; height: 70px; object-fit: cover;">

                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start">
                        <!-- Name -->
                        <h6 class="mb-0 fw-semibold" x-text="item.name.substring(0, 20)"></h6>

                        <!-- DELETE BUTTON (Guest) -->
                        <button type="button"
                            @click="removeItem(item.id)"
                            class="btn btn-sm text-danger p-0 ms-2"
                            title="Remove item">
                            <i class="fas fa-trash-alt"></i> <!-- FontAwesome Icon -->
                        </button>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="fw-bold" x-text="'$' + parseFloat(item.price).toFixed(2)"></span>

                        <!-- Qty -->
                        <div class="input-group input-group-sm qty-container" style="width: 90px;">
                            <button class="qty-btn btn btn-light border" @click="updateGuestQty(item.id, -1)">-</button>
                            <input type="text" class="form-control text-center p-0" :value="item.quantity" readonly>
                            <button class="qty-btn btn btn-light border" @click="updateGuestQty(item.id, 1)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        @endguest

    </div>

    <!-- Footer -->
    <div class="cart-footer bg-white border-top p-3 shadow-sm mt-auto">
        <div class="d-flex justify-content-between mb-3">
            <span class="h6 text-muted mb-0">Total Amount</span>
            @auth <span class="h5 fw-bold mb-0">${{ number_format($subTotal, 2) }}</span> @endauth
            @guest <span class="h5 fw-bold mb-0" x-text="'$' + guestTotal"></span> @endguest
        </div>
        <div class="row gx-2">
            <div class="col-6"><a href="{{ route('cart') }}" wire:navigate class="btn btn-outline-dark w-100">View Cart</a></div>
            <div class="col-6"><a href="{{ route('checkout') }}" wire:navigate class="btn btn-dark w-100">Checkout</a></div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        function guestCartLogic() {
            return {
                guestItems: [],
                guestTotal: '0.00',

                initCart() {
                    this.loadFromStorage();

                    // Listen for updates from AddToCart button
                    window.addEventListener('add-to-local-storage', () => {
                        // Small delay to ensure storage is written
                        setTimeout(() => {
                            this.loadFromStorage();
                            // Open the side cart automatically
                            const el = document.getElementById('sideCart');
                            if (el) {
                                const bsOffcanvas = bootstrap.Offcanvas.getInstance(el) || new bootstrap.Offcanvas(el);
                                bsOffcanvas.show();
                            }
                        }, 200);
                    });
                },

                loadFromStorage() {
                    this.guestItems = JSON.parse(localStorage.getItem('cart')) || [];
                    this.calculateTotal();
                },

                updateGuestQty(id, change) {
                    let item = this.guestItems.find(i => i.id === id);
                    if (item) {
                        item.quantity += change;
                        if (item.quantity < 1) item.quantity = 1;
                        this.saveToStorage();
                    }
                },

                // === DELETE FUNCTION ===
                removeItem(id) {
                    // Filter out the item with the matching ID
                    this.guestItems = this.guestItems.filter(i => i.id !== id);
                    this.saveToStorage();
                },

                saveToStorage() {
                    localStorage.setItem('cart', JSON.stringify(this.guestItems));
                    this.calculateTotal();

                    // Dispatch event so Header updates the count bubble
                    window.dispatchEvent(new Event('storage'));
                },

                calculateTotal() {
                    let total = this.guestItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                    this.guestTotal = total.toFixed(2);
                }
            }
        }
    </script>
</div>