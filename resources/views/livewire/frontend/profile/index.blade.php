<div>
    <!-- Custom CSS for Profile Page -->

    <section class="profile-area bg-area py-5">
        <div class="container">
            <div class="row">

                <!-- LEFT SIDEBAR -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="profile-card">
                        <div class="profile-sidebar-header">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                        <ul class="profile-menu">
                            <li>
                                <a wire:click="switchTab('dashboard')" class="{{ $activeTab == 'dashboard' ? 'active' : '' }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a wire:click="switchTab('orders')" class="{{ $activeTab == 'orders' ? 'active' : '' }}">
                                    <i class="fas fa-shopping-bag"></i> My Orders
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fas fa-heart"></i> Wishlist
                                </a>
                            </li>
                            <li>
                                <a wire:click="switchTab('address')" class="{{ $activeTab == 'address' ? 'active' : '' }}">
                                    <i class="fas fa-map-marker-alt"></i> Address
                                </a>
                            </li>
                            <li>
                                <a wire:click="switchTab('settings')" class="{{ $activeTab == 'settings' ? 'active' : '' }}">
                                    <i class="fas fa-user-cog"></i> Account Details
                                </a>
                            </li>
                            <li>
                                <a wire:click="logout" class="text-danger">
                                    <i class="fas fa-sign-out-alt text-danger"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- RIGHT CONTENT AREA -->
                <div class="col-lg-9 col-md-8">
                    <div class="profile-card profile-content">

                        <!-- 1. DASHBOARD TAB -->
                        @if($activeTab == 'dashboard')
                        <div class="profile-header">
                            <h3>Dashboard</h3>
                        </div>
                        <p>Hello <strong>{{ Auth::user()->name }}</strong> (not <strong>{{ Auth::user()->name }}</strong>? <a href="javascript:void(0)" wire:click="logout">Log out</a>)</p>
                        <p>From your account dashboard you can view your <a href="javascript:void(0)" wire:click="switchTab('orders')">recent orders</a>, manage your <a href="javascript:void(0)" wire:click="switchTab('address')">shipping and billing addresses</a>, and <a href="javascript:void(0)" wire:click="switchTab('settings')">edit your password and account details</a>.</p>

                        <div class="row mt-4">
                            <div class="col-md-4 mb-3">
                                <div class="stat-card">
                                    <h2>0</h2> {{-- Replace with actual count --}}
                                    <p>Total Orders</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="stat-card">
                                    <h2>0</h2>
                                    <p>Pending Orders</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="stat-card">
                                    <h2>0</h2>
                                    <p>Wishlist Items</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- 2. ORDERS TAB -->
                        @if($activeTab == 'orders')
                        <div class="profile-header">
                            <h3>My Orders</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop through orders here --}}
                                    <tr>
                                        <td colspan="5" class="text-center py-4">No orders found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif

                        <!-- 3. ADDRESS TAB -->
                        @if($activeTab == 'address')
                        <div class="profile-header">
                            <h3>My Address</h3>
                        </div>
                        <p>The following addresses will be used on the checkout page by default.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-transparent fw-bold">Billing Address</div>
                                    <div class="card-body">
                                        <p class="text-muted fst-italic">You have not set up this type of address yet.</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Edit Address</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-transparent fw-bold">Shipping Address</div>
                                    <div class="card-body">
                                        <p class="text-muted fst-italic">You have not set up this type of address yet.</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Edit Address</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- 4. ACCOUNT SETTINGS TAB -->
                        @if($activeTab == 'settings')
                        <div class="profile-header">
                            <h3>Account Details</h3>
                        </div>

                        <!-- Profile Form -->
                        <form wire:submit.prevent="updateProfile">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>Full Name</label>
                                        <input type="text" wire:model="name" class="form-control-custom">
                                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>Email Address</label>
                                        <input type="email" wire:model="email" class="form-control-custom">
                                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-auth" style="width: auto; padding: 10px 30px;">
                                        Save Changes <span wire:loading wire:target="updateProfile" class="spinner-border spinner-border-sm ms-2"></span>
                                    </button>
                                    @if (session()->has('success'))
                                    <span class="text-success ms-3"><i class="fas fa-check-circle"></i> {{ session('success') }}</span>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <hr class="my-5">

                        <!-- Password Change Form -->
                        <div class="profile-header border-0 pb-0">
                            <h3>Change Password</h3>
                        </div>
                        <form wire:submit.prevent="updatePassword">
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" wire:model="current_password" class="form-control-custom">
                                @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" wire:model="new_password" class="form-control-custom">
                                @error('new_password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Confirm New Password</label>
                                <input type="password" wire:model="new_password_confirmation" class="form-control-custom">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-auth" style="width: auto; padding: 10px 30px;">
                                    Update Password <span wire:loading wire:target="updatePassword" class="spinner-border spinner-border-sm ms-2"></span>
                                </button>
                                @if (session()->has('password_success'))
                                <span class="text-success ms-3"><i class="fas fa-check-circle"></i> {{ session('password_success') }}</span>
                                @endif
                            </div>
                        </form>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>