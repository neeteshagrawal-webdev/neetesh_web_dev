 
@include('includes.header')
 
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold " style="color: #29b853;">5G Brochure</h6>
            <!-- Add Button -->
         
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%;font-size: 12px;" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Sequence</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editCategoryModal1__id">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteCategoryModal1__id">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
            
                       
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

