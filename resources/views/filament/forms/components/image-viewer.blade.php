{{-- resources/views/filament/forms/components/image-viewer.blade.php --}}

<div>
    <a href="{{ asset('storage/' . $getState()) }}" target="_blank" rel="noopener noreferrer">
        <img src="{{ asset('storage/' . $getState()) }}" 
             alt="Bukti Pembayaran" 
             class="max-w-xs max-h-48 rounded-md shadow border hover:opacity-80 transition">
    </a>
</div>