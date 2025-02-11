 
@include('includes.header')
 
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">

        {{$user->name}}
        </div>
        <div class="card-body">
            {{$timelinedata->remarks}}

            <br>

             {{$timelinedata->status}}
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




@include('includes.footer')

