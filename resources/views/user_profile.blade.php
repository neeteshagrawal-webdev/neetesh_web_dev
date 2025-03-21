@include('includes.header')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>  
<!-- Begin Page Content -->
<div class="container-fluid" style="margin-bottom: 100px;">


<div class="profile-container">
@if(session('success'))
    <div style="color: green; background: #e0f7e9; padding: 10px; border-radius: 5px; margin-top: 10px;">
        {{ session('success') }}
    </div>
@endif
<!-- Header Section (Background Image) -->
<div class="profile-header" style="justify-content: left;background: #003366;">

<form method="POST" action="{{route('profileImage.update')}}" enctype="multipart/form-data">
    @csrf
<div style="position: relative; display: inline-block; text-align: center;">
<!-- Profile Image -->
<img id="profileImage" 
     src="{{ Auth::user()->image ? asset('public/' . Auth::user()->image) : 'https://cybrazetech.com/KMS/assets/admin_css/img/undraw_profile.svg' }}"  
     style="border: none; border-radius: 60%; width: 150px; height: 150px;">

<!-- Edit Icon -->
<label for="fileUpload" 
style="position: absolute;
bottom: 0px;
right: 90px;
background: #000;
color: white;
border-radius: 50%;
padding: 5px;
cursor: pointer;">
&#9998; <!-- Unicode for edit icon (✎) -->
</label>

<!-- Hidden File Input -->
<input type="file" id="fileUpload" name="image" accept="image/*" style="display: none;">

<!-- Save Button -->
<button type="submit" 
style="margin-top: 10px; background-color: #ffffff;
color: #003366; border: none; 
padding: 8px 16px; border-radius: 5px; cursor: pointer;">
<i class="fas fa-save"></i> Save
</button>
</div>

</form>





</div>

<!-- Tabs Section (Now below background image) -->
<div class="tabs-section">
<ul class="nav flex-column nav-pills" id="profileTab" role="tablist">
<li class="nav-item">
<button class="nav-link active" id="personal-tab" data-bs-toggle="pill" data-bs-target="#personal" type="button" role="tab">Personal Information</button>
</li>



<li class="nav-item">
<button class="nav-link" id="password-tab" data-bs-toggle="pill" data-bs-target="#educationalssss" type="button" role="tab">Change Password</button>
</li>

</ul>
</div>

<!-- Form Section (Content) -->
<div class="form-section">
<div class="tab-content" id="profileTabContent">
<!-- Personal Tab -->
<div class="tab-pane fade show active" id="personal" role="tabpanel">


<div class="row">

<div class="mb-3 col-lg-4">
<label for="name" class="form-label">Name</label>
<input type="text" class="form-control" name="first_name" id="name" readonly value="{{$userData->name}}" placeholder="Enter your name">
</div>
<div class="mb-3 col-lg-4">
<label for="name" class="form-label">Designation</label>
<input type="text" class="form-control" name="last_name" id="name" readonly value="{{$userData->designation}}" placeholder="Enter your name">
</div>

<div class="mb-3 col-lg-4">
<label for="phone_number">Phone Number</label>
<input type="text" class="form-control" maxlength="10" id="mobile" readonly name="mobile" value="{{$userData->phone_number}}" placeholder="Enter your phone number" />
</div>



</div>

<div class="row">

<div class="mb-3 col-lg-4">
<label for="name" class="form-label">Email</label>
<input type="text" class="form-control" name="first_name" id="name" readonly value="{{$userData->email}}" placeholder="Enter your name">
</div>
<div class="mb-3 col-lg-4">
<label for="name" class="form-label">Group</label>
<input type="text" class="form-control" name="last_name" id="name" readonly value="{{ $userData->usergroup['name'] ?? 'N/A' }}" placeholder="Enter your name">
</div>

<div class="mb-3 col-lg-4">
<label for="phone_number">Sugroup</label>
<input type="text" class="form-control" maxlength="10" id="mobile" readonly name="mobile" value="{{ $data->sub_group['name'] ?? 'N/A' }}" placeholder="Enter your phone number" />
</div>



</div>  

</div>










<!-- Educational Tab -->

<div class="tab-pane fade" id="educationalssss" role="tabpanel">
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<form method="POST" action="{{ route('changepassword.update') }}" >
@csrf
<div class="row">
<!-- Minimum Password Requirement Label -->
<div class="mb-3 col-lg-4 form-group">
<label for="new-password">Current Password</label>
<input type="password" name="current_password" class="form-control" required>
@error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<!-- Enter New Password -->
<div class="mb-3 col-lg-4 form-group">

<label for="new-password">New Password</label>
<input type="password" name="new_password" class="form-control" required>
@error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<!-- Confirm New Password -->
<div class="mb-3 col-lg-4 form-group">
<label for="confirm-password">Confirm New Password</label>
<input type="password" name="confirm_password" class="form-control" required>
@error('confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<!-- Save Button -->
<div class="col-lg-12 text-center" style="margin-top: 20px;">
<button type="submit"  class="btn  px-4 py-2" style="background-color: #003366;color: white;">Save</button>
</div>
</div>
</form>



</div>












</div>
</div>
</div>







</div>
<!-- /.container-fluid -->

</div>

<style>


.profile-container {
max-width: 100%;
margin: 0px auto;
background: #fff;
border: 1px solid #ddd;
border-radius: 10px;
overflow: hidden;
display: flex;
flex-wrap: wrap;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile-header {
background: #4e73df;
border-bottom: 2px solid black;
position: relative;
width: 100%;
padding: 20px;
/* background: url('https://ezsmartmall.com/static/ezsmart/eaze zone/bg2.jpg') no-repeat center/cover; */
background-size: cover;
color: #fff;
display: flex;
align-items: center;
justify-content: space-between;
}

.profile-header img {
/* width: 80px; */
height: 80px;
border-radius: 50%;
border: 2px solid #000;
}

.camera-icon {
position: absolute;
bottom: 5px;
right: 5px;
width: 20px;
height: 20px;
background: #fff;
border-radius: 50%;
display: flex;
justify-content: center;
align-items: center;
border: 1px solid #ddd;
}

.profile-info {
flex: 1;
margin-left: 15px;
display: flex;
align-items: center;
justify-content: space-between;
flex-wrap: wrap;
}

.profile-info h4 {
margin: 0;
font-size: 18px;
color: #fff;
font-weight: bold;
text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
}

.profile-info .share-icon {
margin-top: 5px;
margin-left: 10px;
font-size: 1rem;
color: white;
cursor: pointer;
}

.tabs-section {
width: 30%;
border-right: 1px solid #ddd;
padding: 20px;
background: #f8f9fa;
}

.tabs-section .nav-link {
color: black;
margin-bottom: 10px;
border: 1px solid #ddd;
text-align: left;
width: 100%;
padding: 10px;
border-radius: 5px;
}

.tabs-section .nav-link:hover {
background: #003366;
color: white;
}

.tabs-section .nav-link.active {
background: #003366;
color: #fff;
}

.form-section {
width: 70%;
padding: 20px;
}

.tab-pane {
background: #fff;
padding: 20px;
border: 1px solid #ddd;
border-radius: 5px;
}

.btn-dark {
margin-top: 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
.profile-container {
flex-direction: column;
}

.profile-header {
flex-direction: column;
text-align: center;
}

.profile-info {
margin-top: 10px;
justify-content: center;
}

.tabs-section {
width: 100%;
margin-top: 20px;
}

.tabs-section .nav-link {
margin-bottom: 5px;
}

.form-section {
width: 100%;
}
}

@media (max-width: 576px) {
.profile-header {
padding: 15px;
}

.profile-header img {
width: 70px;
height: 70px;
}

.profile-info h4 {
font-size: 16px;
}

.tabs-section {
display: flex;
flex-wrap: wrap;
gap: 10px;
margin-top: 20px;
}

.tabs-section .nav-link {
flex: 1 1 45%;
text-align: center;
padding: 12px;
border-radius: 5px;
}

.form-section {
width: 100%;
padding: 10px;
}

.tab-pane {
padding: 15px;
}
}

.highlight-text {
background-color: rgba(0, 0, 0, 0.5);
padding: 5px;
border-radius: 5px;
}


.tabs-section {
display: flex;
flex-direction: column;
align-items: flex-start;
}

.nav-pills {
width: 100%;
display: flex;
flex-wrap: wrap;
gap: 10px; /* Adjust spacing between buttons as needed */
}

/* .nav-item {
flex: 1 1 auto;
text-align: center;
} */

@media (max-width: 768px) { /* Tablet and mobile screens */
.nav-pills {
display: grid;
grid-template-columns: repeat(2, 1fr); /* Two buttons per row */
gap: 15px; /* Adjust spacing between buttons */
}
}

.form-control{
border:1px solid #9E9E9E  !important;
}

label{
color: #000 !important;
}
</style>
<script>
document.getElementById('fileUpload').addEventListener('change', function(event) {
var file = event.target.files[0];
if (file) {
var reader = new FileReader();
reader.onload = function(e) {
document.getElementById('profileImage').src = e.target.result;
};
reader.readAsDataURL(file);
}
});

/*document.getElementById('saveBtn').addEventListener('click', function() {
alert("Profile image saved successfully!"); 
});*/
</script>
@include('includes.footer')