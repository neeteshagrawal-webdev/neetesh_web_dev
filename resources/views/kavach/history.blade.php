 
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

            <h6 class="m-0 font-weight-bold " style="color: #29b853;">Kavach Brochure</h6>
            <!-- Add Button -->
            <p>Letter Date:{{$kavachdata->letter_date}}</p>
            <p>Letter Number:{{$kavachdata->letter_number}}</p>
            <p>Subject Of Letter:{{$kavachdata->subject_of_letter}}</p>
             <a id="btnPrint" onclick="printTable()" class="btn btn-warning" style="float:right;" download><span>Download</span><i class="fa fa-download"></i> </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%;font-size: 12px;" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>User</th>
                            <th>Seen Status</th>
                            <th>Seen At</th>
                            <th>Tentative date as Given by Zonel Railways </th>
                            <th>Status</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        @foreach($users as $data)
                        <tr>
                            <td>1</td>
                            <td>{{$data->name}}</td>
                            <td>{{ $data->seen_status == 1 ? 'yes' : 'no' }}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->date_for_action}}</td>
                            <td>{{$data->status}}</td>
                            <td>{{$data->remarks}}</td>
                            <td class="text-center">
                            <a href="{{url('/KMS/Timeline/'.$data->upload_id)}}">TimeLine</a>
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
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    // Custom Print Function
    function printTable() {
        var printContents = document.getElementById("dataTable").outerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = "<html><head><title>Print Table</title></head><body>" + printContents + "</body></html>";
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // Reload page to restore functionality after print
    }
</script>
<script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>