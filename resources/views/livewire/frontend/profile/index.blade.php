<div>
    <!-- Custom CSS for Profile Page -->
    <style>
        .profile-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            height: 100%;
        }

        .profile-sidebar-header {
            padding: 30px;
            text-align: center;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 30px;
            color: #6c757d;
        }

        .profile-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .profile-menu li a {
            display: block;
            padding: 15px 25px;
            color: #495057;
            text-decoration: none;
            border-bottom: 1px solid #f1f1f1;
            transition: all 0.3s;
            cursor: pointer;
        }

        .profile-menu li a:hover,
        .profile-menu li a.active {
            background: #fff;
            color: #0d6efd;
            font-weight: 600;
            padding-left: 30px;
            border-left: 3px solid #0d6efd;
        }

        .profile-content {
            padding: 30px;
        }

        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #eee;
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card h2 {
            color: #0d6efd;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .form-control-custom {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background: #fcfcfc;
        }

        .form-control-custom:focus {
            border-color: #0d6efd;
            outline: 0;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        .btn-auth {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
        }
    </style>

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
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a wire:click="switchTab('orders')" class="{{ $activeTab == 'orders' ? 'active' : '' }}">
                                    <i class="fas fa-shopping-bag me-2"></i> My Orders
                                </a>
                            </li>
                            <li>
                                <a wire:click="switchTab('address')" class="{{ $activeTab == 'address' ? 'active' : '' }}">
                                    <i class="fas fa-map-marker-alt me-2"></i> Address
                                </a>
                            </li>
                            <li>
                                <a wire:click="switchTab('settings')" class="{{ $activeTab == 'settings' ? 'active' : '' }}">
                                    <i class="fas fa-user-cog me-2"></i> Account Details
                                </a>
                            </li>
                            <li>
                                <a wire:click="logout" class="text-danger">
                                    <i class="fas fa-sign-out-alt text-danger me-2"></i> Logout
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
                        <div class="animate__animated animate__fadeIn">
                            <div class="profile-header mb-4">
                                <h3 class="fw-bold">Dashboard</h3>
                            </div>
                            <p class="mb-4">Hello <strong>{{ Auth::user()->name }}</strong> (not <strong>{{ Auth::user()->name }}</strong>? <a href="javascript:void(0)" wire:click="logout">Log out</a>)</p>

                            <div class="row mt-4">
                                <div class="col-md-4 mb-3">
                                    <div class="stat-card">
                                        <h2>{{ $totalOrdersCount }}</h2>
                                        <p class="mb-0 text-muted">Total Orders</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="stat-card">
                                        <h2>{{ $pendingOrdersCount }}</h2>
                                        <p class="mb-0 text-muted">Pending Orders</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="stat-card">
                                        <h2>{{ $completedOrdersCount }}</h2>
                                        <p class="mb-0 text-muted">Completed Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- 2. ORDERS TAB -->
                        @if($activeTab == 'orders')
                        <div class="animate__animated animate__fadeIn">
                            <div class="profile-header mb-4">
                                <h3 class="fw-bold">My Orders</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover border align-middle">
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
                                        @forelse($orders as $order)
                                        <tr>
                                            <td class="fw-bold text-primary">
                                                {{ $order->order_number }}
                                            </td>
                                            <td>
                                                {{ $order->placed_at->format('M d, Y') }}
                                            </td>
                                            <td>
                                                <span class="badge {{ $order->order_status->badgeColor() }}">
                                                    {{ $order->order_status->label() }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $order->currency }} {{ number_format($order->total_amount, 2) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('order.track', ['orderNumber' => $order->order_number]) }}" class="btn btn-sm btn-outline-primary">
                                                    Track
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-shopping-basket fa-3x mb-3"></i>
                                                    <p>No orders found yet.</p>
                                                    <a href="/" class="btn btn-primary btn-sm">Start Shopping</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-3">
                                {{ $orders->links(data: ['scrollTo' => false]) }}
                            </div>
                        </div>
                        @endif

                        <!-- 3. ADDRESS TAB -->
                        @if($activeTab == 'address')
                        <div class="animate__animated animate__fadeIn">
                            <div class="profile-header mb-4">
                                <h3 class="fw-bold">My Address</h3>
                            </div>
                            <p class="text-muted">The following addresses are retrieved from your most recent order.</p>

                            @if($lastOrder)
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm bg-light">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-file-invoice me-2"></i> Billing Address</h6>
                                            <p class="mb-1 fw-bold">{{ $lastOrder->billing_first_name }} {{ $lastOrder->billing_last_name }}</p>
                                            <p class="mb-1 text-muted">{{ $lastOrder->billing_email }}</p>
                                            <p class="mb-3 text-muted">{{ $lastOrder->billing_phone }}</p>
                                            <p class="mb-0 small">
                                                {{ $lastOrder->billing_address_line_1 }}<br>
                                                {{ $lastOrder->billing_city }} - {{ $lastOrder->billing_zip_code }}<br>
                                                {{ $lastOrder->billing_country }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm bg-light">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3"><i class="fas fa-shipping-fast me-2"></i> Shipping Address</h6>
                                            <p class="mb-1 fw-bold">{{ $lastOrder->shipping_first_name }} {{ $lastOrder->shipping_last_name }}</p>
                                            <p class="mb-1 text-muted">{{ $lastOrder->shipping_email }}</p>
                                            <p class="mb-3 text-muted">{{ $lastOrder->shipping_phone }}</p>
                                            <p class="mb-0 small">
                                                {{ $lastOrder->shipping_address_line_1 }}<br>
                                                {{ $lastOrder->shipping_city }} - {{ $lastOrder->shipping_zip_code }}<br>
                                                {{ $lastOrder->shipping_country }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-info">
                                You haven't placed an order yet, so we don't have a saved address to display.
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- 4. ACCOUNT SETTINGS TAB -->
                        @if($activeTab == 'settings')
                        <div class="animate__animated animate__fadeIn">
                            <div class="profile-header mb-4">
                                <h3 class="fw-bold">Account Details</h3>
                            </div>

                            <!-- Profile Form -->
                            <form wire:submit.prevent="updateProfile">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" wire:model="name" class="form-control-custom">
                                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" wire:model="email" class="form-control-custom">
                                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary px-4">
                                            Save Changes <span wire:loading wire:target="updateProfile" class="spinner-border spinner-border-sm ms-2"></span>
                                        </button>
                                        @if (session()->has('success'))
                                        <span class="text-success ms-3 fw-bold small"><i class="fas fa-check-circle"></i> {{ session('success') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </form>

                            <hr class="my-5">

                            <!-- Password Change Form -->
                            <div class="profile-header border-0 pb-0 mb-3">
                                <h3 class="fw-bold">Change Password</h3>
                            </div>
                            <form wire:submit.prevent="updatePassword">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" wire:model="current_password" class="form-control-custom">
                                        @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">New Password</label>
                                        <input type="password" wire:model="new_password" class="form-control-custom">
                                        @error('new_password') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" wire:model="new_password_confirmation" class="form-control-custom">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary px-4">
                                            Update Password <span wire:loading wire:target="updatePassword" class="spinner-border spinner-border-sm ms-2"></span>
                                        </button>
                                        @if (session()->has('password_success'))
                                        <span class="text-success ms-3 fw-bold small"><i class="fas fa-check-circle"></i> {{ session('password_success') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>