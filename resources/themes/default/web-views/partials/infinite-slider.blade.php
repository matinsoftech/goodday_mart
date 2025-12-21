@php
    $advertisements = \App\Models\Advertisement::select('id', 'text')->latest()->get();
@endphp

@if($advertisements->count())
<!-- infinite slider -->
<div class="delivery-banner my-4">
    <div class="slider-container">
        <div class="slider-track">

            {{-- FIRST SET --}}
            @foreach($advertisements as $advertisement)
                <div class="slide">
                    <svg class="delivery-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                    </svg>
                    <span>{{ $advertisement->text }}</span>
                </div>
            @endforeach

            {{-- DUPLICATE SET (for infinite effect) --}}
            @foreach($advertisements as $advertisement)
                <div class="slide">
                    <svg class="delivery-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                    </svg>
                    <span>{{ $advertisement->text }}</span>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- infinite slider ends -->
@endif
