@include('includes.header')
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="col-md-2">
<button onclick="goBack()" class="btn btn-dark" style="font-size: 18px; padding: 10px 20px; border-radius: 8px;">
    ⬅ Back
</button>
</div>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            
            <h6 class="m-0 font-weight-bold " style="color: #29b853;">User List</h6>
            <!-- Add Button -->
            <button class="btn  btn-sm" style="background-color: #29b853;color: white;" data-toggle="modal" data-target="#addCategoryModal">
                <i class="fas fa-plus"></i> Create New User
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%;font-size: 12px;" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>DisplayName</th>
                         
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        <?php $i = 1; ?>
                        @foreach($userData as $data)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->name}}</td>
                        
                            <td class="text-center">
                            <button class="btn btn-sm btn-success" onclick="updateUserData({{$data->id}})">
                            <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteData({{$data->id}})">
                            <i class="fas fa-trash"></i>
                            </button>
                            </td>
                        </tr>
            			@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
    <!-- Edit Category Modal 1 -->
    <div class="modal fade" id="editUserModal1__id" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                        <div class="modal-body">
                          <input type="hidden" id="user_id">
                        <div class="form-group">
                            <label for="displayname">DisplayName</label>
                            <input type="text" class="form-control" id="model_user_name" name="displayname" placeholder="Enter Displayname"  required>
                        </div>
                       
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" onclick="EditUserData()" >Update</button>
                    </div>
               
            </div>
        </div>
    </div>
    <!-- End of Edit Category Modal 1 -->
            
    <!-- Delete Category Modal 1 -->
    <div class="modal fade" id="deleteUserModal1__id" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Delete User</h5>
                    <input type="hidden" id="delete_user_id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user-group  ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="deleteUser()" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Delete Category Modal 1 -->
            
    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Create New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('user_group.create')}}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                     
                        <div class="form-group">
                            <label for="displayname">DisplayName</label>
                            <input type="text" class="form-control" id="displayname" name="displayname" placeholder="Enter Displayname"  required>
                        </div>
                        
              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="background-color: #29b853;color: white;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Add Category Modal -->
</div>
<!-- /.container-fluid -->


@include('includes.footer')
<script>
    function deleteUser(){
        let userId = $("#delete_user_id").val();
        //alert(uploadId);
        $.ajax({
            url: '/deleteUserGroup/' + userId, // Route to delete user
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}" // CSRF protection
            },
            success: function(response) {
                alert(response.message);
                $("#deleteUserModal1__id").modal("hide");
                //$('#successMessage').text(response.message).show();
                location.reload();
                //$("#user-" + userId).remove(); // Remove user row from table
            },
            error: function(response) {
                alert("Error deleting user");
            }
        });
    }
    function deleteData(id){


        $("#deleteUserModal1__id").modal("show");
        $("#delete_user_id").val(id);
        //alert(id);
        

    }
    function EditUserData(){

        let user_id = $("#user_id").val();
        let user_name = $("#model_user_name").val();
      
        $.ajax({
            url: "{{ route('editUsergroupdata.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                userId: user_id,
                name: user_name
            },
            success: function(response) {
                    //alert(response);
                if (response.success) {
                    alert(response.message);
                $("#editUserModal1__id").modal("hide");
                    location.reload();
                } else {
                    alert("Update failed.");
                }
            },
            error: function() {
                alert("An error occurred.");
            }
        });
    }
    function updateUserData(id){

        //alert(id);
        $.ajax({
        url: '/updateUserGroupData/' + id, // Route to delete user
        type: 'GET',
        data: {
        "_token": "{{ csrf_token() }}" // CSRF protection
        },
        success: function(response) {

        if (response.success) {

            $("#user_id").val(response.user.id);
            $("#model_user_name").val(response.user.name);
          
           
           // console.log("Role from database:", response.upload.category);
          
            
            $("#editUserModal1__id").modal("show");
        } else {
            alert("User not found!");
        }
       }
        });



    }





</script>
<script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>