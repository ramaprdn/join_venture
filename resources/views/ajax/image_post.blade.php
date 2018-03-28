@foreach($images as $image)
	<a data-fancybox="gallery" href="{{ asset('/img/post/'.$image->img_name) }}"><img src="{{ asset('/img/post/'.$image->img_name) }}"></a>
@endforeach