<button type="button"
    class="btn {{ $class }}"
    wire:click.prevent="addToCart"
    wire:loading.attr="disabled">

    <!-- Loading State -->
    <span wire:loading wire:target="addToCart">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Adding...
    </span>

    <!-- Normal State -->
    <span wire:loading.remove wire:target="addToCart">
        @if($showIcon)
        <i class="fas fa-shopping-cart me-1"></i>
        @endif
        {{ $text }}
    </span>
</button>