<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>KMS - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        html, body {
            display: grid;
            height: 100vh;
            width: 100%;
            place-items: center;
            background: url({{ asset('assets/admin_css/img/maxresdefault.jpeg')}}) no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            background: #fff;
            max-width: 700px;
            width: 100%;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.15);
        }
        .container form .title {
            font-size: 24px;
            font-weight: 600;
            margin: 10px 0 15px;
            position: relative;
        }
        .container form .title:before {
            content: '';
            position: absolute;
            height: 4px;
            width: 33px;
            left: 0px;
            bottom: 3px;
            border-radius: 5px;
            background: linear-gradient(to right, #0c244a 0%, #2186b7 100%);
        }
        .container form .input-box {
            width: 100%;
            height: 45px;
            margin-top: 20px;
            position: relative;
        }
        .container form .input-box input, 
        .container form .input-box select {
            width: 100%;
            height: 100%;
            outline: none;
            font-size: 16px;
            border: none;
            padding: 0 10px;
        }
        .container form .underline::before {
            content: '';
            position: absolute;
            height: 2px;
            width: 100%;
            background: #ccc;
            left: 0;
            bottom: 0;
        }
        .container form .underline::after {
            content: '';
            position: absolute;
            height: 2px;
            width: 100%;
            background: linear-gradient(to right, #0c244a 0%, #2186b7 100%);
            left: 0;
            bottom: 0;
            transform: scaleX(0);
            transform-origin: left;
            transition: all 0.3s ease;
        }
        .container form .input-box input:focus ~ .underline::after,
        .container form .input-box select:focus ~ .underline::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        .container form .input-row {
            display: flex;
            gap: 15px;
        }
        .container form .input-row .input-box {
            width: 50%;
        }
        .container form .button {
            margin: 30px 0 15px;
        }
        .container .input-box input[type="submit"] {
            background: linear-gradient(to right, #0c244a 0%, #2186b7 100%);
            font-size: 17px;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .container .input-box input[type="submit"]:hover {
            letter-spacing: 1px;
            background: linear-gradient(to right, #293649 0%, #50c5fe 100%);
        }
        .error{

          color:red;
        }
        @media screen and (min-width: 1024px) {
            .container {
                float: left;
                margin-left: -600px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <form id="signupForm" method="POST">
    @csrf
    <div class="title">Signup 
        <img style="height: 50px; float: right;" src="assets/admin_css/img/logoSnT2.png" alt="KWS Logo">
    </div>
    <div style="text-align: center;"><b>Knowledge<br> Management System</b></div>

    <!-- First Name & Last Name -->
    <div class="input-row">
        <div class="input-box underline">
            <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
            <div class="underline"></div>
            <span class="error" id="nameError"></span>
        </div>
        <div class="input-box underline">
            <input type="text" name="designation" id="designation" placeholder="Enter Designation" required>
            <div class="underline"></div>
            <span class="error" id="designationError"></span>
        </div>
    </div>

    <!-- Email & User Type -->
    <div class="input-row">
        <div class="input-box underline">
            <input type="email" name="email" id="email" placeholder="Enter Your Email" required>
            <div class="underline"></div>
            <span class="text-danger error-text email_error" id="emailError"></span>
        </div>
        <div class="input-box underline">
            <input type="number" name="phone_number" id="phone_number" placeholder="Enter Number" required>
            <div class="underline"></div>
            <span class="error" id="phoneError"></span>
        </div>
    </div>
    <div class="input-row">
    <!-- Password -->
        <div class="input-box underline">
            <select name="user_group" id="user_group" required>
                    <option value="" disabled selected> User Group</option>
                    @foreach($userGroupData as $data)
                    <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
            </select>
            <div class="underline"></div>
            <span class="error" id="userGroupError"></span>
        </div>
        <div class="input-box underline">
            <select name="sub_group" id="sub_group" required>
                <option value="" disabled selected>Sub Group</option>
                @foreach($userSubGroupData as $data)
                <option value="{{$data->name}}">{{$data->name}}</option>
                @endforeach
            </select>
            <div class="underline"></div>
            <span class="error" id="subGroupError"></span>
        </div>
    </div>
    <div class="input-box underline">
        <select name="department" id="department" required>
            <option value="" disabled selected>Department</option>
            @foreach($departments as $data)
            <option value="{{$data->name}}">{{$data->name}}</option>
            @endforeach
        </select>
        <div class="underline"></div>
        <span class="error" id="departmentError"></span>
    </div>
    <div class="input-row">
        <div class="input-box underline">
            <input type="password" name="password" placeholder="Enter Password" required>
            <div class="underline"></div>
            <span class="error" id="passwordError"></span>
        </div>
        <div class="input-box underline">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Your Password" required>
            <span class="error" id="confirmPasswordError"></span>
        </div>
    </div>
    <div class="input-row">
        <div class="input-box button">
           
            <a href="{{route('login')}}">Login</a>
        </div>
        <div class="input-box button">
            <input type="submit" name="" value="Submit">
        </div>
        <
    </div>
    </form>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user_group').on('change', function() {
            var userGroupId = $(this).val(); // Get selected user group ID
            //alert(userGroupId);
            if(userGroupId) {
                $.ajax({
                    url: "{{ route('get.subgroups') }}", // Route to fetch sub-groups
                    type: "GET",
                    data: { user_group_id: userGroupId },
                    success: function(data) {
                        $('#sub_group').empty().append('<option value="">Please Select Sub Group</option>'); 
                        $.each(data, function(key, value) {
                            $('#sub_group').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_group').empty().append('<option value="">Please Select Sub Group</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#signupForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            $.ajax({
                url: "{{ route('user.register') }}", // Laravel route
                type: "POST",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('.error-text').text(''); // Clear previous errors
                },
                success: function(response) {
                 // alert(response);
                    if (response.status == "success") {
                         window.location.href = "{{ route('login') }}";
                        alert("User registered successfully!");
                        $('#signupForm')[0].reset(); // Reset form
                    }
                },
                error: function (xhr) {
                  if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.email) {
                        $("#emailError").text(errors.email[0]);
                    } else {
                        $("#emailError").text(""); // Hide error if fixed
                    }
                    if (errors.name) {
                        $("#nameError").text(errors.name[0]);
                    } else {
                        $("#nameError").text("");
                    }
                     if (errors.password) {
                        $("#passwordError").text(errors.password[0]);
                    } else {
                        $("#passwordError").text("");
                    }

                    if (errors.password_confirmation) {
                        $("#confirmPasswordError").text(errors.password_confirmation[0]);
                    } else {
                        $("#confirmPasswordError").text("");
                    }
                    if (errors.phone_number){

                        $("#phoneError").text(errors.name[0]);
                    } else{
                        $("#phoneError").text("");
                    }

                    if (errors.user_group) {
                        $("#userGroupError").text(errors.user_group[0]);
                    } else {
                        $("#userGroupError").text("");
                    }

                    if (errors.sub_group) {
                        $("#subGroupError").text(errors.sub_group[0]);
                    } else {
                        $("#subGroupError").text("");
                    }
                
                  }
                }
            });
        });
    });
     $("input, select").on("input change", function () {
        $(this).next(".error").text("");
    });
</script>
