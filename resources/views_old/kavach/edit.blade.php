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
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold " style="color: #29b853;">Kavach Remarks</h6>
            <!-- Add Button -->
        </div>
        <div class="card-body">
            <form action="{{url('/Remark/Add/')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">Name</label>
                        <input type="hidden" name="upload_id" value="{{$id}}">
                        <input type="text" class="form-control" id="subject_of_letter" name="subject_of_letter" value="{{$kavachdata->subject_of_letter}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Letter Date</label>
                        <input type="text" class="form-control" id="letter_date" name="letter_date"  value="{{$kavachdata->letter_date}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Tentative Date as given by Zonal Railways</label>
                        <input type="date" class="form-control" id="date_of_action" name="date_of_action"  value="{{$kavachdata->date_for_action}}" required>
                    </div>
                     <div class="form-group">
                        <label for="categoryName">Remarks</label>
                        <textarea type="text" class="form-control" id="remark" name="remark" placeholder="Enter remark" value="{{$kavachdata->remarks}}" required>{{$kavachdata->remarks}}</textarea>
                    </div>
                     <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option value="">Please Select One</option>
                            <option value="inprogress" {{ ($kavachdata->status ?? '') == 'inprogress' ? 'selected' : '' }}>InProgress</option>
                            <option value="completed" {{ ($kavachdata->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="sequence" name="sequence" placeholder="Enter sequence" value="" required> -->
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
<!-- /.container-fluid -->


@include('includes.footer')

<script>
    function goBack() {
        window.history.back(); // This takes the user to the previous page in history
    }
</script>