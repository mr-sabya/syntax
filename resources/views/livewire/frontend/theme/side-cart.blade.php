<!-- This is now the ROOT of the Livewire component -->
<!-- Use w-100 h-100 to fill the parent offcanvas -->
<div class="d-flex flex-column h-100"
    x-data="guestCartLogic()"
    x-init="initCart()">

    <!-- Header -->
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold">My Cart</h5>
        <!-- IMPORTANT: data-bs-dismiss must be on the parent ID -->
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <!-- Body (Scrollable) -->
    <div class="offcanvas-body d-flex flex-column p-4 overflow-auto">

        {{-- AUTH USER LOGIC --}}
        @auth
        @forelse($cartItems as $item)
        <div class="cart-item d-flex gap-3 mb-3 border-bottom pb-3" wire:key="cart-item-{{ $item->id }}">
            <img src="{{ asset('storage/' . $item->product->thumbnail_image_path) }}"
                class="rounded" style="width: 70px; height: 70px; object-fit: cover;">

            <div class="flex-grow-1">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0 fw-semibold">{{ Str::limit($item->product->name, 20) }}</h6>
                    <button type="button" wire:click="remove({{ $item->id }})" class="btn btn-sm text-danger p-0">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="fw-bold">${{ number_format($item->product->price, 2) }}</span>

                    {{-- Stepper --}}
                    <div class="input-group input-group-sm qty-container" style="width: 90px;">
                        <!-- Add wire:loading.attr="disabled" to prevent rapid clicking -->
                        <button class="qty-btn"
                            wire:click="decrement({{ $item->id }})"
                            wire:loading.attr="disabled">-</button>

                        <input type="text" class="form-control text-center p-0" value="{{ $item->quantity }}" readonly>

                        <button class="qty-btn"
                            wire:click="increment({{ $item->id }})"
                            wire:loading.attr="disabled">+</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <p>Your cart is empty.</p>
        </div>
        @endforelse
        @endauth

        {{-- GUEST USER LOGIC (Alpine) --}}
        @guest
        <template x-for="item in guestItems" :key="item.id">
            <div class="cart-item d-flex gap-3 mb-3 border-bottom pb-3">
                <img :src="'/storage/' + item.image" class="rounded" style="width: 70px; height: 70px; object-fit: cover;">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 fw-semibold" x-text="item.name.substring(0, 20)"></h6>
                        <button type="button" @click="removeItem(item.id)" class="btn btn-sm text-danger p-0">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="fw-bold" x-text="'$' + parseFloat(item.price).toFixed(2)"></span>
                        <div class="input-group input-group-sm qty-container" style="width: 90px;">
                            <button class="qty-btn" @click="updateGuestQty(item.id, -1)">-</button>
                            <input type="text" class="form-control text-center p-0" :value="item.quantity" readonly>
                            <button class="qty-btn" @click="updateGuestQty(item.id, 1)">+</button>
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

    {{-- Keep your Javascript logic here --}}
    <script>
        function guestCartLogic() {
            // ... (Your existing Alpine logic from previous answer) ...
            return {
                guestItems: [],
                guestTotal: '0.00',
                initCart() {
                    this.loadFromStorage();
                    window.addEventListener('cart-local-updated', () => {
                        this.loadFromStorage();
                        // Manually show the offcanvas if triggered by 'Add to Cart'
                        const el = document.getElementById('sideCart');
                        if (el && !el.classList.contains('show')) {
                            const bsOffcanvas = new bootstrap.Offcanvas(el);
                            bsOffcanvas.show();
                        }
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
                removeItem(id) {
                    this.guestItems = this.guestItems.filter(i => i.id !== id);
                    this.saveToStorage();
                },
                saveToStorage() {
                    localStorage.setItem('cart', JSON.stringify(this.guestItems));
                    this.calculateTotal();
                    window.dispatchEvent(new CustomEvent('cart-local-updated'));
                },
                calculateTotal() {
                    let total = this.guestItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                    this.guestTotal = total.toFixed(2);
                }
            }
        }
    </script>
</div>