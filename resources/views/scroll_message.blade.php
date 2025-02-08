 
@include('includes.header')
 
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold " style="color: #29b853;">Add Notice Message</h6>
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
					<div class="form-group">
					<label for="message">Notice Message</label>
					<input type="text" class="form-control" id="message" name="message" placeholder="Enter Message" value="" required>
					</div>
					<button type="submit" class="btn btn-success" >Save</button>
          		</form>
        </div>
    </div>
   


@include('includes.footer')

