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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Group Detail</th>
                            <th>Department</th>
                            <!-- <th>Designation</th> -->
                            <th>Status</th>
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
                            <td>{{$data->email}}</br>{{$data->phone_number}}</td>
                            <td>{{ $data->usergroup['name'] ?? 'N/A' }}</br>
{{ $data->sub_group['name'] ?? 'N/A' }}</td>
                         
                            <td>{{$data->department}}</td>
                           <!--  <td>{{$data->designation}}</td> -->
                            <td>@if($data->status == 0)
                            <span style="font-size:16px;"class="text-warning">Pending</span>
                            @else
                            <span class="text-success">Approved</span>
                            @endif</td>
                            <td class="text-center">
                            @if($data->status == 0)   
                            <button class="btn btn-sm btn-danger" id="accept_btn_{{$data->id}}" onclick="ConfirmData({{$data->id}})">Accept</button></br>
                            @else
                            <button class="btn btn-sm btn-success" id="permission_btn_{{$data->id}}" onclick="Userpermission({{$data->id}})">Permission</button><br>
                            @endif
                        </br>
                            <button class="btn btn-sm btn-success" onclick="updateUserData({{$data->id}})">
                            <i class="fas fa-edit"></i>
                            </button>
                            <!-- <button class="btn btn-sm btn-danger" onclick="deleteData({{$data->id}})">
                            <i class="fas fa-trash"></i>
                            </button> -->
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
                          <div class="form-group">
                            <input type="hidden" id="user_id">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="model_user_email" name="email" placeholder="Enter Email"  required>
                        </div>
                        <div class="form-group">
                            <label for="displayname">Name</label>
                            <input type="text" class="form-control" id="model_user_name" name="displayname" placeholder="Enter Displayname"  required>
                        </div>
                        <div class="form-group">
                            <label for="designation">UserGroup</label>
                            <select class="form-control" id="model_user_group" name="user_group" required>
                                <option value="">Please Select UserGroup</option>
                                @foreach($userGroupData as $data)
                                <option value="{{$data->name}}">{{ $data->usergroup['name'] ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                         
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <select class="form-control" id="model_user_designation" name="model_user_designation" required>
                                <option value="">Please Select</option>
                                <option value="ZR">ZR</option>
                                <option value="COE">COE</option>
                                <option value="RB">RB</option>
                                <option value="RDSO">RDSO</option>
                                <option value="OEM">OEM</option>
                                <option value="AGENCY">AGENCY</option>
                                <option value="PU">PU</option>
                                <option value="WS">WS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="PhoneNumber">PhoneNumber</label>
                            <input type="text" class="form-control" id="model_user_phone" name="phone_number" placeholder="Enter Phone Number"  required>
                        </div>
                        <div class="form-group">
                            <label for="zone">Zone</label>
                            <select class="form-control" id="model_user_zone" name="zone" required>
                            <option value="">Please Select</option>
                            <option value="INDIAN RAILWAYS">INDIAN RAILWAYS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoryName">RoleId</label>
                            <select class="form-control" id="model_user_role" name="role_id" required>
                                <option value="">Please Select</option>
                                <option value="Brochure">GlobalAdmin</option>
                                <option value="Advisories">Others</option>
                                <option value="Multimedia">Report Viewer</option>
                                <option value="Multimedia">Contract Supervisior</option>
                            </select>
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
                    Are you sure you want to delete this user  ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="deleteUser()" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Delete Category Modal 1 -->
    <!----confirm---->
        <div class="modal fade" id="confirmUserModal1__id" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Delete User</h5>
                    <input type="hidden" id="confirm_user_id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Accept this user  ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="acceptUser()" class="btn btn-danger">Accept</button>
                </div>
            </div>
        </div>
    </div>
    <!------end-------->
    <!-- Edit Category Modal 1 -->
    <div class="modal fade" id="permissionsModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        
                    </div>
                     <input type="hidden" id="permission_user_id">
                   
                        <div class="modal-body">
                           
                            
                            <div id="entry_module_permission">
                            <div class="form-check">
                               
                                <input type="hidden" id="permission_user_id" >
                                <input type="checkbox" id="kavach" class="form-check-input" name="permissions[kavach]" value="1" 
                                >
                                <input type="hidden" name="permissions[kavach]" value="0">
                                <label class="form-check-label" for="kavach">Kavach</label>
                             </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="lte" name="permissions[LTE]" value="1" 
                                >
                                <input type="hidden" name="permissions[LTE]" value="0">
                                <label class="form-check-label" for="lte">LTE</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="5g" name="permissions[5g]" value="1" 
                                >
                                <input type="hidden" name="permissions[5g]" value="0">
                                <label class="form-check-label" for="5g">5G</label>
                            </div>
                           
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" onclick="EditUserPermission()" >Update</button>
                            </div>
                        </div>
                       
                   
                   
               </div>
            </div>
        </div>
    </div>
    <!-- End of Edit Category Modal 1 -->
            
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
                <form method="POST" action="{{route('user.create')}}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email"  required>
                        </div>
                        <div class="form-group">
                            <label for="displayname">DisplayName</label>
                            <input type="text" class="form-control" id="displayname" name="displayname" placeholder="Enter Displayname"  required>
                        </div>
                        <div class="form-group">
                            <label for="designation">UserGroup</label>
                            <select class="form-control" id="model_user_group" name="user_group" required>
                                <option value="">Please Select UserGroup</option>
                                @foreach($userGroupData as $data)
                                <option value="{{$data->name}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <select class="form-control" id="designation" name="designation" required>
                                <option value="">Please Select</option>
                                <option value="ZR">ZR</option>
                                <option value="COE">COE</option>
                                <option value="RB">RB</option>
                                <option value="RDSO">RDSO</option>
                                <option value="OEM">OEM</option>
                                <option value="AGENCY">AGENCY</option>
                                <option value="PU">PU</option>
                                <option value="WS">WS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="PhoneNumber">PhoneNumber</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number"  required>
                        </div>
                        <div class="form-group">
                            <label for="zone">Zone</label>
                            <select class="form-control" id="model_user_zone" name="zone" required>
                            <option value="">Please Select</option>
                            <option value="INDIAN RAILWAYS">INDIAN RAILWAYS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoryName">RoleId</label>
                            <select class="form-control" id="role_id" name="role_id" required>
                                <option value="">Please Select</option>
                                <option value="Brochure">GlobalAdmin</option>
                                <option value="Advisories">Others</option>
                                <option value="Multimedia">Report Viewer</option>
                                <option value="Multimedia">Contract Supervisior</option>
                            </select>
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
            url: '/deleteUser/' + userId, // Route to delete user
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

   
    function ConfirmData(id)
    {

        $("#confirmUserModal1__id").modal("show");
        $("#confirm_user_id").val(id);

    }
    function acceptUser(){

        let userId = $("#confirm_user_id").val();
        //alert(uploadId);
        $.ajax({
            url: '/acceptUser/' + userId, // Route to delete user
            type: 'get',
            data: {
                "_token": "{{ csrf_token() }}" // CSRF protection
            },
            success: function(response) {
                alert(response.message);
                $("#confirmUserModal1__id").modal("hide");
                $("#accept_btn_" + userId).hide();
                //$('#successMessage').text(response.message).show();
                location.reload();
                //$("#user-" + userId).remove(); // Remove user row from table
            },
            error: function(response) {
                alert("Error deleting user");
            }
        });

    }
    function EditUserData(){

        let user_id = $("#user_id").val();
        let user_name = $("#model_user_name").val();
        let user_email =   $("#model_user_email").val();
        let user_designation  =   $("#model_user_designation").val();
        let user_role = $("#model_user_role").val();
        let user_zone = $("#model_user_zone").val();
        let user_phone = $("#model_user_phone").val();
        let user_group = $("#model_user_group").val();
        $.ajax({
            url: "{{ route('editUserdata.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                userId: user_id,
                name: user_name,
                email:user_email,
                designation:user_designation,
                role:user_role,
                zone:user_zone,
                user_group:user_group,
                phone:user_phone
            },
            success: function(response) {
                    //alert(response);
                if (response.success) {
                    alert(response.message);
                $("#editUserModal1__id").modal("hide");
                    //  location.reload();
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
        url: '/updateUserData/' + id, // Route to delete user
        type: 'GET',
        data: {
        "_token": "{{ csrf_token() }}" // CSRF protection
        },
        success: function(response) {

        if (response.success) {

            $("#user_id").val(response.user.id);
            $("#model_user_name").val(response.user.name);
            $("#model_user_role").val(response.user.role);
            $("#model_user_zone").val(response.user.zone);
            $("#model_user_designation").val(response.user.designation);
            $("#model_user_phone").val(response.user.phone_number);
            $("#model_user_email").val(response.user.email);
            $("#model_user_group").val(response.user.user_group);
           
           // console.log("Role from database:", response.upload.category);
          
            
            $("#editUserModal1__id").modal("show");
        } else {
            alert("User not found!");
        }
       }
        });



    }
     function Userpermission(id){

        $("#permissionsModal").modal("show");
        $("#permission_user_id").val(id);
    }


    function EditUserPermission() {
        var user_id = $('#permission_user_id').val(); // Get user ID
       // var module_name = $('#permission_module_name').val(); // Get user ID
      
        var permissions = {}; // Initialize object to store permissions

        // Iterate through all checkboxes and get their values (0 or 1)
        $('.form-check-input').each(function() {
            permissions[$(this).attr('name')] = $(this).is(':checked') ? 1 : 0;
        });

        $.ajax({
            url: "/give/permissions", // Your Laravel route
            type: "POST",
            data: {
                user_id: user_id,
                permissions: permissions,
                _token: "{{ csrf_token() }}" // Include CSRF token for security
            },
            success: function(response) {
                alert("Permissions updated successfully!");
                $('#permissionsModal').modal('hide'); // Close modal
            },
            error: function(error) {
                console.log(error);
                alert("Something went wrong!");
            }
        });
}




</script>
<script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>