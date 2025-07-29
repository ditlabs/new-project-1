<div>
    @if($testimonials->isNotEmpty())
    <section class="py-16 sm:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">What Our Clients Say</h2>
                <p class="mt-4 text-lg leading-8 text-gray-600">Real stories from satisfied users who have experienced the Ditlabs difference.</p>
            </div>

            {{-- Grid untuk Kartu Testimoni --}}
            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($testimonials as $testimonial)
                        <div class="bg-white p-8 rounded-2xl shadow-lg flex flex-col">
                            {{-- Header Kartu: Avatar & Nama --}}
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $testimonial->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $testimonial->title }}</p>
                                </div>
                            </div>

                            @if ($testimonial->produk)
                                <div class="mt-4 pt-4 border-t border-dashed">
                                    <p class="text-xs text-gray-500">Memberi ulasan untuk:</p>
                                    <p class="font-semibold text-gray-800">{{ $testimonial->produk->nama_produk }}</p>
                                </div>
                            @endif

                            {{-- Tampilan Rating Bintang --}}
                            @if ($testimonial->rating)
                                <div class="flex items-center mt-4">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $testimonial->rating)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endif
                                    @endfor
                                </div>
                            @endif
                            
                            {{-- Isi Testimoni/Ulasan --}}
                            <p class="mt-4 text-gray-700 italic flex-grow">"{{ $testimonial->quote }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
</div>