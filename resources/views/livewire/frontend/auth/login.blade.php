<div>
    <!-- Custom Styles for Auth Pages to match your theme -->
    <section class="login-area bg-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 col-sm-12">

                    <div class="auth-wrapper">
                        <div class="auth-header text-center">
                            <h3>Sign In</h3>
                            <p>Welcome back to our shop</p>
                        </div>

                        <!-- Login Form -->
                        <form
                            x-data="{ 
                            handleLogin() {
                                let cart = localStorage.getItem('cart');
                                // Send data to Livewire property
                                @this.set('localCartData', cart);
                                // Call the PHP login method
                                $wire.login(); 
                            }
                        }"
                            @submit.prevent="handleLogin">

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <input type="email" id="email" wire:model="email" class="form-control-custom @error('email') is-invalid @enderror" placeholder="Enter your email">
                                </div>
                                @error('email')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" wire:model="password" class="form-control-custom @error('password') is-invalid @enderror" placeholder="Enter your password">
                                </div>
                                @error('password')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <label class="mb-0" style="cursor: pointer;">
                                    <input type="checkbox" wire:model="remember">
                                    <span class="ms-1 text-muted">Remember me</span>
                                </label>
                                <a href="#" class="text-primary small" style="text-decoration: none;">Forgot Password?</a>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-auth">
                                <span wire:loading.remove wire:target="login">Sign In</span>
                                <span wire:loading wire:target="login"><i class="fas fa-spinner fa-spin"></i> Processing...</span>
                            </button>

                        </form>

                        <!-- Social Login Divider -->
                        <div class="divider">
                            <span>OR</span>
                        </div>


                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <p class="text-muted">Don't have an account?
                                <a href="{{ route('register') }}" wire:navigate class="text-primary fw-bold" style="text-decoration: none;">Register here</a>
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>