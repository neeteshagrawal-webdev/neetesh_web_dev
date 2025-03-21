 @include('includes.header')
 <!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
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
            <h6 class="m-0 font-weight-bold " style="color: #003366;">Upload List</h6>
            <!-- Add Button -->
          
            
            @if(!empty($permissions) && ($permissions->kavach == 1 || $permissions->lte == 1 || $permissions->{'5g'} == 1))
            <button class="btn  btn-sm" style="background-color: #003366;color: white;" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fas fa-plus"></i> Upload New
            </button>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%;font-size: 12px;" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Priority</th>
                            <th>Letter Date</th>
                            <th>Letter Number</th>
                            <th>Subject of Letter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        <?php $i=1;?>
                        @foreach($uploaddata as $data)
                       
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$data->category}}</td>
                            <td>{{$data->subcategory}}</td>
                            <td>{{$data->priority}}</td>
                            <td>{{$data->letter_date}}</td>
                            <td>{{$data->letter_number}}</td>
                            <td>{{$data->subject_of_letter}}</td>
                            <td class="text-center">
                                @if(!empty($permissions) && ($permissions->kavach == 1 || $permissions->lte == 1 || $permissions->{'5g'} == 1))
                                <button class="btn btn-sm btn-success" onclick="updateData({{$data->id}})" >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-sm btn-danger" onclick="deleteData({{$data->id}})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                                <a href="{{ asset($data->upload_file) }}" style=" background-color: #003366; color: white;" class="btn btn-sm" target="_blank"><i class="fa fa-eye" target="_blank">View File</a>
                                
                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
            
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
            <!-- Edit Category Modal 1 -->
            <div class="modal fade" id="editCategoryModal1__id" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Edit Upload</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                           
                        <div class="modal-body">
                            
                            <div class="form-group">
                        <label for="categoryName">Category</label>
                        <input type="hidden" id="upload_id">
                        <select class="form-control" id="model_category_name" name="category" required>
                            <option value="">Please Select</option>
                            @if(!empty($permissions) && $permissions->kavach == 1)
                            <option value="Kavach">Kavach</option>
                            @endif

                            @if(!empty($permissions) && $permissions->lte == 1)
                            <option value="LTE">LTE</option>
                            @endif

                            @if(!empty($permissions) && isset($permissions->{'5g'}) && $permissions->{'5g'} == 1)
                            <option value="5G">5G</option>
                            @endif
                            
                        </select>
                      
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Subcategory</label>
                           <select class="form-control" id="model_subcategory_name" name="subcategory" required>
                                <option value="">Please Select</option>
                                <option value="Brochure">Brochure</option>
                                <option value="Advisories">Advisories</option>
                                <option value="Multimedia">Multimedia</option>
                            </select>
                    </div>
                  
                      <div class="form-group">
                        <label for="user_group">User Group</label>
                            <select class="form-control selectpicker user_group" id="edit_model_user_group" name="user_group[]" multiple data-live-search="true" data-actions-box="true">
                            @foreach($groupData as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  
                    <div class="form-group">
                        <label for="sub_group">Sub Group</label>
                        <select class="form-control selectpicker" id="edit_model_sub_group" name="sub_group[]" multiple data-live-search="true" data-actions-box="true">
                        <!-- Subgroups will be loaded dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Priority</label>
                          <select class="form-control" id="model_Priority" name="priority" required>
                                <option value="">Please Select</option>
                                <option value="PRIORITY">PRIORITY</option>
                                <option value="MOST PRIORITY">MOST PRIORITY</option>
                                <option value="LEAST PRIORITY">LEAST PRIORITY</option>
                                <option value="GENERAL">GENERAL</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Letter Date</label>
                        <input type="date" class="form-control" id="model_letter_date" name="letter_date" placeholder="Enter Question" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Letter Number</label>
                        <input type="text" class="form-control" id="model_letter_number" name="letter_number" placeholder="Enter Letter Number"  required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Subject Of Letter</label>
                        <input type="text" class="form-control" id="model_subject_of_letter" name="subject_of_letter" placeholder="Enter Subject"  required>
                    </div>
                   
                  <!--  <div class="form-group">
                        <label for="categoryName">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file" placeholder="select file"  required>
                    </div> -->
                   
                               
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" onclick="model_update_data()"  class="btn" style=" background-color: #003366; color: white;" >Update</button>
                        </div>
                  
                    </div>
                </div>
            </div>
            <!-- End of Edit Category Modal 1 -->
            
            <!-- Delete Category Modal 1 -->
            <div class="modal fade" id="deleteCategoryModal1__id" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <input type="hidden" id="delete_id">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this record ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" onclick="deleteUploadData()" class="btn btn-danger">Delete</button>
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
                <h5 class="modal-title" id="addCategoryModalLabel">Upload Master</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('uploadManual')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                        <label for="categoryName">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Please Select</option>
                            @if(!empty($permissions) && $permissions->kavach == 1)
                            <option value="Kavach">Kavach</option>
                            @endif

                            @if(!empty($permissions) && $permissions->lte == 1)
                            <option value="LTE">LTE</option>
                            @endif

                            @if(!empty($permissions) && isset($permissions->{'5g'}) && $permissions->{'5g'} == 1)
                            <option value="5G">5G</option>
                            @endif
                        </select>
                      
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Subcategory</label>
                           <select class="form-control" id="subcategory" name="subcategory" required>
                                <option value="">Please Select</option>
                                <option value="Brochure">Brochure</option>
                                <option value="Advisories">Advisories</option>
                                <option value="Multimedia">Multimedia</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="user_group">User Group</label>
                            <select class="form-control selectpicker user_group" id="model_user_group" name="user_group[]" multiple data-live-search="true" data-actions-box="true">
                            @foreach($groupData as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  
                    <div class="form-group">
                        <label for="sub_group">Sub Group</label>
                        <select class="form-control selectpicker" id="model_sub_group" name="sub_group[]" multiple data-live-search="true" data-actions-box="true">
                        <!-- Subgroups will be loaded dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Priority</label>
                          <select class="form-control" id="Priority" name="priority" required>
                                <option value="">Please Select</option>
                                <!-- <option value="PRIORITY">PRIORITY</option>
                                <option value="MOST PRIORITY">MOST PRIORITY</option>
                                <option value="LEAST PRIORITY">LEAST PRIORITY</option> -->
                                <option value="GENERAL">Normal</option>
                                <option value="OTHERS">Heigh</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Letter Date</label>
                        <input type="date" class="form-control" id="letter_date" name="letter_date" placeholder="Enter Question" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Letter Number</label>
                        <input type="text" class="form-control" id="letter_number" name="letter_number" placeholder="Enter Letter Number"  required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Subject Of Letter</label>
                        <input type="text" class="form-control" id="subject_of_letter" name="subject_of_letter" placeholder="Enter Subject"  required>
                    </div>
                   
                   <div class="form-group">
                        <label for="categoryName">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file" placeholder="select file"  required>
                    </div>
                   
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn" style="background-color: #003366;color: white;" >Save</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    function deleteUploadData(){
        let uploadId = $("#delete_id").val();
        //alert(uploadId);
        $.ajax({
            url: '/deleteUpload/' + uploadId, // Route to delete user
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}" // CSRF protection
            },
            success: function(response) {
                alert(response.message);
                $("#deleteCategoryModal1__id").modal("hide");
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


        $("#deleteCategoryModal1__id").modal("show");
        $("#delete_id").val(id);
        //alert(id);
        

    }
    function model_update_data(){

        let upload_id = $("#upload_id").val();
        let category_name = $("#model_category_name").val();
        let subcategory_name =   $("#model_subcategory_name").val();
        let priority  =   $("#model_Priority").val();
        let letter_date = $("#model_letter_date").val();
        let letter_number = $("#model_letter_number").val();
        let subject_of_letter = $("#model_subject_of_letter").val();
        let user_group = $("#edit_model_user_group").val();
        let user_sub_group = $("#edit_model_sub_group").val();
        //alert(user_group);
         $.ajax({
                url: "{{ route('uploadmanualdata.update') }}",
                type: "POST",
                data: {
                _token: "{{ csrf_token() }}",
                uploadId: upload_id,
                category: category_name,
                subcategory:subcategory_name,
                priority:priority,
                letter_date:letter_date,
                letter_number:letter_number,
                subject_of_letter:subject_of_letter,
                user_group:user_group,
                sub_group:user_sub_group,
                },
                success: function(response) {
                    //alert(response);
                    if (response.success) {
                        alert(response.message);
                        $("#editCategoryModal1__id").modal("hide");
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
    function updateData(id){

        //alert(id);
        $.ajax({
        url: '/updateManualData/' + id, // Route to delete user
        type: 'GET',
        data: {
        "_token": "{{ csrf_token() }}" // CSRF protection
        },
        success: function(response) {
            console.log("Subgroup Data:", response.upload.sub_group_id);
   if (response.success) {
    console.log(response);
    $("#upload_id").val(response.upload.id);
    $("#model_category_name").val(response.upload.category);
    $("#model_subcategory_name").val(response.upload.subcategory);
    $("#model_Priority").val(response.upload.priority);
    $("#model_letter_date").val(response.upload.letter_date);
    $("#model_letter_number").val(response.upload.letter_number);
    $("#model_subject_of_letter").val(response.upload.subject_of_letter);
    
    // Set user group and trigger change event to load subgroups
    $("#edit_model_user_group").val(response.upload.user_group_id).trigger("change");

    // Store the selected subgroups
    let selectedSubGroups = response.upload.sub_group_id;

    // Wait for the AJAX call to complete before setting subgroups
    setTimeout(function () {
        $("#edit_model_sub_group").val(selectedSubGroups).trigger("change");
        $(".selectpicker").selectpicker("refresh"); // Refresh Bootstrap SelectPicker
    }, 1000); // Delay to ensure subgroups are loaded

    $("#editCategoryModal1__id").modal("show");
}else {
        alert("User not found!");
        }
       }
        });


    }


      $('#editform').on('click', function(e) {

        var userId = $(this).data('id');
          alert(userId);
      });
</script>
<script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>
<!-- <script>
    $(document).ready(function() {
        $('.user_group').on('change', function() {
            var userGroupId = $(this).val(); // Get selected user group ID
           // alert(userGroupId);
            if(userGroupId) {
                $.ajax({
                    url: "{{ route('get.subgroups') }}", // Route to fetch sub-groups
                    type: "GET",
                    data: { user_group_id: userGroupId },
                    success: function(data) {
                        $('.sub_group').empty().append('<option value="">Please Select Sub Group</option>'); 
                        $.each(data, function(key, value) {
                            $('.sub_group').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_group').empty().append('<option value="">Please Select Sub Group</option>');
            }
        });
    });
</script> -->
<script>
$(document).ready(function() {
    $('#model_user_group, #edit_model_user_group').on('changed.bs.select change', function() {
        var selectedGroups = $(this).val(); // Get selected user groups
        var targetSubGroup = $(this).attr("id") === "edit_model_user_group" ? "#edit_model_sub_group" : "#model_sub_group";
        //alert(selectedGroups);
        if (selectedGroups.length > 0) {
            $.ajax({
                url: "{{ route('get.subgroupsupload') }}",
                type: "GET",
                data: { user_group: selectedGroups },
                dataType: "json", // Ensure JSON response
                success: function(response) {
                    $(targetSubGroup).empty(); // Clear previous options

                    if (response.length > 0) {
                        $.each(response, function(index, subGroup) {
                            $(targetSubGroup).append('<option value="'+ subGroup.id +'">'+ subGroup.name +'</option>');
                        });
                    } else {
                        $(targetSubGroup).append('<option value="">No Subgroups Available</option>');
                    }

                    $(targetSubGroup).selectpicker('refresh'); // Refresh Bootstrap SelectPicker
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error: " + error);
                }
            });
        } else {
            $(targetSubGroup).empty();
            $(targetSubGroup).selectpicker('refresh');
        }
    });

    // Initialize Bootstrap Select
    $('.selectpicker').selectpicker();
});
</script>
