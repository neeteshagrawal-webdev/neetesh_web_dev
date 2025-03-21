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
            
            <h6 class="m-0 font-weight-bold " style="color: #003366;">SubGroup List</h6>
            <!-- Add Button -->
            <button class="btn  btn-sm" style="background-color: #003366;color: white;" data-toggle="modal" data-target="#addCategoryModal">
                <i class="fas fa-plus"></i> Create New Subgroup
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
                        @foreach($subgroupData as $data)
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
                    <input type="hidden" id="subgroup_id">
                    <div class="form-group">
                    <label for="designation">UserGroup</label>
                    <select class="form-control user_group" id="model_user_group" name="user_group" required>
                        <option value="" disabled selected> User Group</option>
                        @foreach($groupData as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="form-group">
                    <label for="displayname">SubGroup Name</label>
                    <input type="text" class="form-control" id="model_subgroup_name" name="displayname" placeholder="Enter Displayname"  required>
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
                <form method="POST" action="{{route('user_sub_group.create')}}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="designation">UserGroup</label>
                            <select class="form-control user_group" id="model_user_group" name="user_group" required>
                                <option value="" disabled selected> User Group</option>
                                @foreach($groupData as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
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

        let subgroup_id = $("#subgroup_id").val();
        let user_group = $("#model_user_group").val();
        let subgroup_name = $("#model_subgroup_name").val();
        $.ajax({
            url: "{{ route('editUsersubgroupdata.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                subgroup_id: subgroup_id,
                user_group: user_group,
                subgroup_name:subgroup_name,
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
        url: 'updateUsersubGroupData/' + id, // Route to delete user
        type: 'GET',
        data: {
        "_token": "{{ csrf_token() }}" // CSRF protection
        },
        success: function(response) {

        if (response.success) {

            $('#subgroup_id').val(response.subgroup.id);
            $('#model_subgroup_name').val(response.subgroup.name);
            $('#model_user_group').val(response.subgroup.group_id);
            
            //$("#user_id").val(response.user.id);
            //$("#model_user_name").val(response.user.name);
          
           
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