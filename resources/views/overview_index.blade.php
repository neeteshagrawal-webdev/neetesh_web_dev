@include('includes.header')

<div class="container">
    <h2>Overview</h2>
    <a href="{{ route('overview.create') }}" class="btn mb-3" style="background-color:#003366;color:white;">Add Section</a>

    @foreach($overviews as $overview)
        <div class="card mb-4">
            <div class="card-body">
                 <h3>{{ $overview->type }}</h3>
                <h3>{{ $overview->title }}</h3>

                {{-- Properly display CKEditor content without escaping HTML --}}
                <p>{!! $overview->content !!}</p>

                {{-- Check if media exists before rendering --}}
                @if(!empty($overview->media))
                    @if($overview->media_type === 'image')
                        <img src="{{ asset('storage/' . $overview->media) }}" alt="Overview Image" class="img-fluid mt-2">
                    @elseif($overview->media_type === 'video')
                        <video width="100%" controls class="mt-2">
                            <source src="{{ asset('storage/' . $overview->media) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                @endif

                {{-- Delete Button with Confirmation --}}
                <form action="{{ route('overview.destroy', $overview->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this section?');">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

@include('includes.footer')