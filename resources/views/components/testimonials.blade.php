<div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    @if($testimonials->isNotEmpty())
    <section class="py-16 sm:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Judul Section --}}
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">What Our Clients Say</h2>
                <p class="mt-4 text-lg leading-8 text-gray-600">Real stories from satisfied users who have experienced the Ditlabs difference.</p>
            </div>

            {{-- Grid untuk Kartu Testimoni --}}
            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($testimonials as $testimonial)
                        <div class="bg-white p-8 rounded-2xl shadow-lg">
                            <div class="flex items-center gap-4">
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $testimonial->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $testimonial->title }}</p>
                                </div>
                            </div>
                            <p class="mt-6 text-gray-700 italic">"{{ $testimonial->quote }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
</div>