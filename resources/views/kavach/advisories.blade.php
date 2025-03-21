 
@include('includes.header')

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
            <h6 class="m-0 font-weight-bold " style="color: #29b853;">Kavach Advisories</h6>
            <!-- Add Button -->
             
       </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%;font-size: 12px;" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Letter Date</th>
                            <th>Letter Number</th>
                            <th>Priority</th>
                            <th>Subject Of Letter</th>
                            <th>Tentative date as Given by Zonel Railways </th>
                            <th>Status</th>
                            <th>User Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        @foreach($kavachdata as $data)
                        <tr>
                            <td>1</td>
                            <td>{{$data->letter_date}}</td>
                            <td>{{$data->letter_number}}</td>
                            <td>{{$data->priority}}</td>
                            <td>{{$data->subject_of_letter}}</td>
                            <td>{{$data->date_for_action}}</td>
                            <td>{{$data->status}}</td>
                            <td>{{$data->remarks}}</td>
                            <td class="text-center">
                                <a href="{{ url('Download/history/'.$data->id) }}" class="btn btn-sm btn-primary" ><i class="fa fa-eye"></i></a>

                                <a href="{{ url('Remark/'.$data->upload_id) }}" class="btn btn-sm btn-success" >
                                    <i class="fas fa-edit"></i>
                                </a>
               
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
                <h5 class="modal-title" id="addCategoryModalLabel">FAQs Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                  
                   
                    <div class="form-group">
                        <label for="categoryName">Question</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Answer</label>
                        <input type="text" class="form-control" id="answer" name="answer" placeholder="Enter Answer"  required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Sequence</label>
                        <input type="text" class="form-control" id="sequence" name="sequence" placeholder="Enter sequence"  required>
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
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>