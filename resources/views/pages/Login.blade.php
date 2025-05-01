<div>
    {{-- {{ $errors->any() }} --}}

    <form action="{{ route('loginAuth') }}" class="login_form" method="post" name="login_form">
        @csrf

        Email: <input name="email" id="email" type="email" />
        <span class="email_error"> </span>
        {{-- @error('email')
            <span class="email_error"> {{ $message }} </span>
        @enderror --}}
{{--
        @if ($errors->has('email'))
            <span>{{ $errors->first('email') }}</span>
        @endif
        <br /> <br /> --}}

        Password: <input name="password" id="password" type="password" />
        <span class="password_error"> </span>
        {{-- @error('password')
            <span class="password_error"> {{ $message }} </span>
        @enderror --}}
        <br /> <br />

        <button name="submit_btn" id="submit_btn"> Submit </button>
    </form>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // console.log("object");
    // $(document).ready(function() {
    //     $(".login_form").on("submit", function(e) {
    //         var isValidate = true;

    //         var email = $("#email").val();
    //         var password = $("#password").val();

    //         if (!email) {
    //             $(".email_error").html("Please enter the email");
    //             isValidate = false;
    //         }
    //         if (!password) {
    //             $(".password_error").html("Please enter the password");
    //             isValidate = false;
    //         }

    //         if (!isValidate) {
    //             e.preventDefault();
    //         }
    //     });
    // });
</script>
