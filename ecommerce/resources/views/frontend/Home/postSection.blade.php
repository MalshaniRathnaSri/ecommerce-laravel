@foreach($posts as $post)
<div class="content">
    <div 
        class="content-offers" 
        style="background: url('{{ asset('storage/' . $post->post_image) }}') no-repeat left center; background-size: cover; min-height: 400px; position: relative;"
    >
        <div class="ct-offers" style="position: absolute; bottom: 0; right: 0;">
            <div class="ct-offers-title">{{ $post->heading }}</div>
            <p>{{ $post->description }}</p>
        </div>
    </div>
</div>
@endforeach


