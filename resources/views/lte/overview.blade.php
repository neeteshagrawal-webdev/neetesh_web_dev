@include('includes.header')

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- Begin Page Content -->
<div class="container-fluid">
      <div class="col-md-2 mb-3">
<button onclick="goBack()" class="btn" style="font-size: 18px; background-color: #003366; color: white;  padding: 10px 20px; border-radius: 8px;">
   <i class="bi bi-arrow-left"></i> Back
</button>

</div>
      <div class="container">
        <div class="card-custom">
            <div class="card-header">
                <i class="fas fa-broadcast-tower"></i> LTE (Telecommunication) Overview
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
          
            </div>
        </div>
    @endforeach
        </div>
    </div>
    
    
    
      <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
      <style>
      
        
        .card-custom {
            /*max-width: 700px;*/
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }
        .card-header {
            background: #003366;
            color: white;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            padding: 15px;
        }
        .card-body {
            padding: 20px;
            text-align: center;
        }
        .card-body img {
            width: 100%;
            max-width: 400px;
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
        .icons {
            color: #003366;
            font-size: 18px;
            margin-right: 10px;
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