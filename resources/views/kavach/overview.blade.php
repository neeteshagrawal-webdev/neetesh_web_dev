@include('includes.header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- Begin Page Content -->
<div class="container-fluid">
      <div class="col-md-2 mb-3">
<button onclick="goBack()" class="btn" style="font-size: 18px; background-color: #003366; color: white;  padding: 10px 20px; border-radius: 8px;">
   <i class="bi bi-arrow-left"></i> Back
</button>

</div>   

<div class="card-container" style="margin-bottom: 100px;">
<div class="card-header">
<i class="fas fa-train"></i> KAVACH - Automatic Train Protection System
</div>
@foreach($overviews as $overview)
        <div class="card mb-4">
            <div class="card-body">
                <h3>{{ $overview->title }}</h3>

              
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
                  {{-- Properly display CKEditor content without escaping HTML --}}
                <p>{!! $overview->content !!}</p>

                {{-- Delete Button with Confirmation --}}
               <!--  <form action="{{ route('overview.destroy', $overview->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this section?');">
                        Delete
                    </button>
                </form> -->
            </div>
        </div>
    @endforeach

<div class="footer">
RAILWAYS | INDIAN RAILWAYS | SAFETY & TECHNOLOGY | 2025
</div>
</div>


<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style>

.card-container {
/*max-width: 900px;*/
background: #fff;
box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
border-radius: 12px;
padding: 25px;
overflow: hidden;
margin:auto;
}
.card-header {
background: #003366;
color: white;
font-size: 24px;
font-weight: bold;
text-align: center;
padding: 15px;
border-radius: 8px;
}
.card-body {
padding: 20px;
text-align: center;
}
.card-body video, .card-body img {
width: 100%;
max-width: 700px;
display: block;
margin: 15px auto;
border-radius: 8px;
}
.card-body p {
font-size: 16px;
color: #333;
line-height: 1.6;
text-align: justify;
}
.card-body ul {
text-align: left;
padding-left: 20px;
}
.card-body ul li {
font-size: 16px;
margin-bottom: 8px;
color: #003366;
}
.highlight {
font-weight: bold;
color: #d9534f;
}
.footer {
background: #d9534f;
color: white;
text-align: center;
padding: 10px;
font-size: 14px;
font-weight: bold;
border-radius: 8px;
margin-top: 20px;
}
</style>


</div>
</div>
@include('includes.footer')
<script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>