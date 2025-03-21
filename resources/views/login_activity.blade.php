 
@include('includes.header')
 
<style>


</style>
<!-- Begin Page Content -->
<div class="container-fluid">
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
            <h6 class="m-0 font-weight-bold " style="color: #003366;">User Login Activity Data</h6>
            <!-- Add Button -->
            
        </div>
      
        <div class="card-body">
          	<div id="error-message"></div>
          			 <div class="row">
					 <div class="col-md-3">
                <div class="form-group">
                    <label for="categoryName">User</label>
                    <select class="form-control" id="username" name="user_name">
                        <option value="">All</option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="categoryName">From Date</label>
                    <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Enter sequence" value="" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <label for="categoryName">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Enter sequence" value="" required>
                </div>
            </div>
            <div class="col-md-3">
           
                <label>Search</label>
                <button id="searchForm" class="btn form-control" style="background-color: #003366; color: white;"><i class="fa fa-search"></i></button>
           
            </div>
						</div>
          	
        </div>
    </div>




    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold " style="color: #003366;">List of User Login Activity Data</h6>
           
        
        
        </div>
        <div class="card-body">
            <div class="table-responsive">
              
                 <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Event Type</th>
                <th>Status</th>
               <th>Time</th>
            </tr>
        </thead>
        <tbody id="activityTable">
            @forelse ($activities as $index => $activity)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td> @if($activity->user_id)
                    {{ $activity->user->name ?? 'Unknown' }}
                    @else
                    <span class="text-muted">N/A</span>
                    @endif</td>
                    <td>{{ $activity->email ?? 'N/A' }}</td>
                    <td>{{ $activity->ip_address }}</td>
                    <td>{{ Str::limit($activity->user_agent, 50) }}</td>
                    <td>
                        @if($activity->event_type == 'login')
                        <span style="color: white;
                        font-size: 18px;" class="badge bg-success">Login</span>
                        @elseif($activity->event_type == 'failed_login')
                        <span style="color: white;
                        font-size: 18px;" class="badge bg-danger">Failed Login</span>
                        @elseif($activity->event_type == 'logout')
                        <span style="color: white;
                        font-size: 18px;" class="badge bg-warning">Logout</span>
                        @endif
                    </td>
                    <td>
                    @if($activity->message == 'Login Success')
                        <span style="color: white;
                        font-size: 18px;" class="badge bg-success">Login Success</span>
                    @elseif($activity->message == 'Wrong Email')
                        <span style="color: white;
                        font-size: 18px;" class="badge bg-danger">Wrong Email</span>
                    @elseif($activity->message == 'Wrong Password')
                        <span style="color: white;
                        font-size: 18px;" class="badge bg-danger">Wrong Password</span>    
                    @endif
                    </td>
                    
                    <td>{{ $activity->created_at->format('d M Y, H:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No login activity found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

   
              
            </div>
        </div>
    </div>
   

            
  
</div>
<!-- /.container-fluid -->


@include('includes.footer')

<script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>
  <script>
        $(document).ready(function () {
            $('#searchForm').on('click', function () {
                
                //e.preventDefault();
                
                let user_id = $('#username').val();
                //alert(username)
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                //alert(username);
                $.ajax({
                    url: "{{ route('users.search') }}",
                    type: "GET",
                    data: { user_id: user_id, from_date: fromDate, to_date: toDate },
                      success: function (response) {
                       // alert(response);
                    let rows = '';

                    if (response.length > 0) {
                        response.forEach((activity, index) => {
                            rows += `<tr>
                                <td>${index + 1}</td>
                                <td>${activity.user ? activity.user.name : '<span class="text-muted">N/A</span>'}</td>
                                <td>${activity.email ? activity.email : 'N/A'}</td>
                                <td>${activity.ip_address}</td>
                                <td>${activity.user_agent ? activity.user_agent.substring(0, 50) + '...' : 'N/A'}</td>
                                <td>
                                    ${activity.event_type === 'login' ? '<span class="badge bg-success" style="font-size: 18px;">Login</span>' :
                                    activity.event_type === 'failed_login' ? '<span class="badge bg-danger" style="font-size: 18px;">Failed Login</span>' :
                                    activity.event_type === 'logout' ? '<span class="badge bg-warning" style="font-size: 18px;">Logout</span>' : ''}
                                </td>
                                <td>
                                    ${activity.message === 'Login Success' ? '<span class="badge bg-success" style="font-size: 18px;">Login Success</span>' :
                                    activity.message === 'Wrong Email' ? '<span class="badge bg-danger" style="font-size: 18px;">Wrong Email</span>' :
                                    activity.message === 'Wrong Password' ? '<span class="badge bg-danger" style="font-size: 18px;">Wrong Password</span>' : ''}
                                </td>
                                <td>${new Date(activity.created_at).toLocaleString('en-US', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true })}</td>
                            </tr>`;
                        });
                    } else {
                        rows = `<tr>
                            <td colspan="8" class="text-center">No login activity found.</td>
                        </tr>`;
                    }

                    $('#activityTable').html(rows);
                    $('#errorMessages').html('');
                },
                error: function (xhr) {
                    let errorMessage = "Something went wrong!";

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                    } else if (xhr.status === 422) { // Validation errors
                    let errors = xhr.responseJSON.errors;
                    errorMessage = Object.values(errors).flat().join('<br>');
                    }

                    $("#error-message").html(`<div class="alert alert-danger">${errorMessage}</div>`);
                }
                });
            });
        });
    </script>
    <script>
    $(document).ready(function () {
        $('.table').DataTable({
            dom: 'Bfrtip', // Enables buttons
            buttons: [
                {
                    extend: 'csv',
                    text: 'Export CSV',
                    title: 'User List',
                    exportOptions: {
                        columns: [0, 1, 2, 3] // Select columns to include
                    }
                },
                {
                    extend: 'excel',
                    text: 'Export Excel',
                    title: 'User List',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Export PDF',
                    title: 'User List',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'User List',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ]
        });
    });
</script>