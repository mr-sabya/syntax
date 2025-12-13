<a href="{{ route('home') }}" wire:navigate>
    <img src="{{ isset($settings['logo']) ? url('storage/' . $settings['logo']) : url('assets/frontend/images/logo.png') }}" alt="{{ $settings['website_name'] ?? 'Website Logo' }}">
</a>