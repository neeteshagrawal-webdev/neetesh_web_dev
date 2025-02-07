 
@include('includes.header')
 
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
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
                            <th>Email</th>
                            <th>Designation</th>
                            <th>RoleId</th>
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
                            <td>{{$data->email}}</td>
                            <td>{{$data->designation}}</td>
                            <td>{{$data->role}}</td>
                            <td class="text-center">
                            	   <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editCategoryModal1__id">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteCategoryModal1__id">
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
            <div class="modal fade" id="editCategoryModal1__id" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Edit FAQs</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                           
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label for="categoryName">Question</label>
                                <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="categoryName">Answer</label>
                                <input type="text" class="form-control" id="answer" name="answer" placeholder="Enter Answer" value="" required>
                            </div>
                                <div class="form-group">
                                    <label for="categoryName">Sequence</label>
                                    <input type="text" class="form-control" id="sequence" name="sequence" placeholder="Enter sequence" value="" required>
                                </div>
                               
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" >Update</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- End of Edit Category Modal 1 -->
            
            <!-- Delete Category Modal 1 -->
            <div class="modal fade" id="deleteCategoryModal1__id" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCategoryModalLabel">Delete FAQs</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the FAQs  ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <a href="" type="button" class="btn btn-danger">Delete</a>
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
            <div class="modal-body">
                <form method="POST" action="{{route('uploadManual')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                        <label for="categoryName">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Please Select</option>
                            <option value="Kavach">Kavach</option>
                            <option value="LTE">LTE</option>
                            <option value="5G">5G</option>
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
                        <label for="categoryName">Priority</label>
                          <select class="form-control" id="Priority" name="Priority" required>
                                <option value="">Please Select</option>
                                <option value="Brochure">PRIORITY</option>
                                <option value="Advisories">MOST PRIORITY</option>
                                <option value="Multimedia">LEAST PRIORITY</option>
                                <option value="Multimedia">GENERAL</option>
                                <option value="Multimedia">OTHERS</option>
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

