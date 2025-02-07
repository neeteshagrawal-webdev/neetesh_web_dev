 
@include('includes.header')
 
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold " style="color: #29b853;">User Login Activity Data</h6>
            <!-- Add Button -->
           <!--  <button class="btn  btn-sm" style="background-color: #29b853;color: white;" data-toggle="modal" data-target="#addCategoryModal">
                <i class="fas fa-plus"></i> Add FAQs
            </button> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%;font-size: 12px;" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Username</th>
                            <th>LoginTime</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        <?php $i=1; ?>
                        @foreach($loginActivities as $logindata)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$logindata->name}}</td>
                            <td>{{$logindata->created_at}}</td>
                        </tr>
                        <?php  $i++; ?>
            			@endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   

            
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

