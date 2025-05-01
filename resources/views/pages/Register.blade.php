@extends('templates.home_template')

@section('content')
    <div>
        <h2> Register New User </h2>
        <form name="register_form" class="register_form" method="POST" action="{{ route('admin.store') }}">
            @csrf

            First Name: <input name="firstname" id="firstname" type="text" />
            <span class="firstname_error"> </span>
            @error('firstname')
                <span class="firstname_error"> {{ $message }} </span>
            @enderror
            <br />
            <br />

            Last Name: <input name="lastname" id="lastname" type="text" />
            <span class="lastname_error"> </span>
            @error('lastname')
                <span class="lastname_error"> {{ $message }} </span>
            @enderror
            <br />
            <br />



            Email : <input class="email" name="email" id="email" type="email" />
            <span class="email_error"> </span>
            @error('email')
                <span class="email_error"> {{ $message }} </span>
            @enderror
            <br />
            <br />


            Password: <input name="password" id="password" type="password" />
            <span class="password_error"> </span>
            @error('password')
                <span class="password_error"> {{ $message }} </span>
            @enderror
            <br /> <br />


            Role:
            <select name="role">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <span class="role_error"> </span>
            @error('role')
                <span class="role_error"> {{ $message }} </span>
            @enderror
            <br /> <br />
            <button id="createUser_btn" name="createUser_btn"> Create User </button>
        </form>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // console.log("object");


    $(document).ready(function() {

        function emailValidation() {
            var email = $("#email").val();
            if (!email) {
                $(".email_error").html("Please enter the email");
                isValidate = false;
            }
        }

        $("#email").on("input", emailValidation);

        $(".register_form").on("submit", function(e) {
            var isValidate = true;
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            // var email = $("#email").val();
            var password = $("#password").val();
            var role = $("#role").val();

            if (!firstname) {
                $(".firstname_error").html("Please enter the first name");
                isValidate = false;
            }
            if (!lastname) {
                $(".lastname_error").html("Please enter the last name");
                isValidate = false;
            }
            // if (!email) {
            //     $(".email_error").html("Please enter the email");
            //     isValidate = false;
            // }
            if (!password) {
                $(".password_error").html("Please enter the password");
                isValidate = false;
            }

            if (!isValidate) {
                e.preventDefault();
            }
        });


        $("#email").on("input", function() {
            // $.ajax({
            //     type: "POST",

            //     success: function(res){
            //         alert(res);
            //     }
            // })
        });

    });
</script>
