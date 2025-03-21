 
@include('includes.header')
 
 <!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- Begin Page Content -->
<div class="container-fluid">
      <div class="col-md-2 mb-3">
<button onclick="goBack()" class="btn" style="font-size: 18px; background-color: #003366; color: white;  padding: 10px 20px; border-radius: 8px;">
   <i class="bi bi-arrow-left"></i> Back
</button>

</div>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold " style="color: #003366;">Add Notice Message</h6>
            <!-- Add Button -->
            
        </div>
         @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
               <!--  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body">
          		<form action="{{route('notice.message')}}" method="POST" enctype="multipart/form-data">
          			@csrf
          			 <div class="row">
					<div class="form-group col-lg-4 col-md-6 col-sm-12">
					<label for="message">Notice Message</label>
					<input type="text" class="form-control" id="message" name="message" placeholder="Enter Message" value="{{$latestMessage->message}}" required>
					</div>
						<div class="form-group col-lg-4 col-md-6 col-sm-12" style="margin-top:31px;">
					<button type="submit" class="btn " style=" background-color: #003366; color: white;">Save</button>
						</div>
						</div>
          		</form>
        </div>
    </div>
   
  </div>
     </div>
   

@include('includes.footer')

<script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>