@foreach ($sliders as $slider)
    <div class="item">
    <img src="{{ asset('storage/' . $slider->image_link) }}" alt="{{ $slider->heading }}"  style="width: 100%; height: 400px; object-fit: cover;">
        <div class="slider-desc">
            <div class="container">
                <div class="row">
                    <div class="">
                        <div class="">
                            <div class="slide-offers-title">{{$slider->heading}}</div>
                            <p>{{$slider->top_sub_heading}}</p>
                            <a href="" class="font-white">{{$slider->bottom_sub_heading}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


