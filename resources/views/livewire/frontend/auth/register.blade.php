<div>
    <section class="login-area bg-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 col-sm-12">

                    <div class="auth-wrapper">
                        <div class="auth-header text-center">
                            <h3>Register</h3>
                            <p>Create your new account</p>
                        </div>

                        <!-- Register Form -->
                        <form wire:submit.prevent="register">

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <div class="input-group">
                                    <input type="text" id="name" wire:model="name" class="form-control-custom @error('name') is-invalid @enderror" placeholder="Enter your full name">
                                </div>
                                @error('name')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

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
                                    <input type="password" id="password" wire:model="password" class="form-control-custom @error('password') is-invalid @enderror" placeholder="Create a password">
                                </div>
                                @error('password')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" id="password_confirmation" wire:model="password_confirmation" class="form-control-custom" placeholder="Confirm your password">
                                </div>
                            </div>

                            <!-- Terms (Static for now) -->
                            <div class="mb-4">
                                <label class="mb-0" style="cursor: pointer;">
                                    <input type="checkbox" required>
                                    <span class="ms-1 text-muted small">I agree with the <a href="#" class="text-primary">Terms and Conditions</a></span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-auth">
                                <span wire:loading.remove wire:target="register">Register Now</span>
                                <span wire:loading wire:target="register"><i class="fas fa-spinner fa-spin"></i> Creating Account...</span>
                            </button>

                        </form>

                        <!-- Social Login Divider -->
                        <div class="divider">
                            <span>OR</span>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-3">
                            <p class="text-muted">Already have an account?
                                <a href="{{ route('login') }}" wire:navigate class="text-primary fw-bold" style="text-decoration: none;">Sign in</a>
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>