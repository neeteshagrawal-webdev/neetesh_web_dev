 
@include('includes.header')
 
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        
        <div class="card-body">

            <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="col-md-2">
            <div class="form-group">
            <label for="categoryName">User</label>
            
            <select class="form-control" name="user_name">
                <option>All</option>
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            </div>
            </div>
            <div class="col-md-2">
            <div class="form-group">
            <label for="categoryName">Category</label>
                <select class="form-control" id="category_name" name="category" required>
                    <option value="">Please Select</option>
                    <option value="Kavach">Kavach</option>
                    <option value="LTE">LTE</option>
                    <option value="5G">5G</option>
                </select>
            </div>
            </div>
                <div class="col-md-2">
            <div class="form-group">
            <label for="categoryName">Subcategory</label>
                <select class="form-control" id="subcategory_name" name="subcategory" required>
                    <option value="">Please Select</option>
                    <option value="Brochure">Brochure</option>
                    <option value="Advisories">Advisories</option>
                    <option value="Multimedia">Multimedia</option>
                </select>
            </div>
            </div>
             <div class="col-md-2">
            <div class="form-group">
            <label for="categoryName">From Date</label>
            <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Enter sequence" value="" required>
            </div>
            </div>
            <div class="col-md-2">
            <div class="form-group">
            <label for="categoryName">To Date</label>
            <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Enter sequence" value="" required>
            </div>
            </div>
            <div class="form-group">
                <label>Search</label>
                <button id="idgetdata" class="btn btn-success form-control"><i class="fa fa-search"></i></button>
            </div>
            <!-- Add Button -->
            <button class="btn  btn-sm" style="background-color: #29b853;color: white;" data-toggle="modal" >
                Download
            </button>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%;font-size: 12px;" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Priority</th>
                            <th>Letter Date</th>
                            <th>Letter Number</th>
                            <th>Subject of Letter</th>
                            <th>User Remark</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody">
                       
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   


</div>
<!-- /.container-fluid -->
@include('includes.footer')

<script>
    $(document).ready(function() {
        // Set default date to today
        let today = new Date().toISOString().split('T')[0];
        $('#from_date').val(today);
        $('#to_date').val(today);
        var baseUrl = "{{ url('Download/history') }}";
        // Function to fetch and append data
        function fetchData() {
           // alert("dffs");
            let category = $('#category_name').val();
            let subcategory = $('#subcategory_name').val();
            let user_id = $('#user_name').val();
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();

            $.ajax({
                url: "{{ route('records.search') }}",
                type: "GET",
                data: { category, subcategory, user_id, from_date, to_date },
                success: function(response) {
                    $('#dataBody').empty(); // Clear previous results
                    if (response.length === 0) {
                        $('#dataBody').append('<tr><td colspan="5" class="text-center">No records found</td></tr>');
                    } else {
                        $.each(response, function(index, record) {
                        $('#dataBody').append(`
                        <tr>
                        <td>${record.category}</td>
                        <td>${record.subcategory}</td>
                        <td>${record.priority}</td>
                        <td>${record.letter_date}</td>
                        <td>${record.letter_number}</td>
                        <td>${record.subject_of_letter}</td>
                        <td>
                            <a href="${baseUrl}/${record.upload_id}" class="btn btn-sm btn-primary">
                                View History
                            </a>
                        </td>
                        </tr>
                        `);
                        });
                    }
                }
            });
        }

        // Search button click
        $('#idgetdata').click(fetchData);

        // Reset button click
        $('#reset').click(function() {
            $('#category').val('');
            $('#subcategory').val('');
            $('#user_id').val('');
            $('#from_date').val(today);
            $('#to_date').val(today);
            fetchData(); // Reload data
        });

        // Load initial data
        fetchData();
    });
</script>


