<div>
    {{-- {{ $errors->any() }} --}}

    <form action="{{ route('loginAuth') }}" class="login_form" method="post" name="login_form">
        @csrf

        Email: <input name="email" id="email" type="email" />
        <span class="email_error"> </span>
        @error('email')
            <span class="email_error"> {{ $message }} </span>
        @enderror
        {{--
        @if ($errors->has('email'))
            <span>{{ $errors->first('email') }}</span>
        @endif --}}
        <br /> <br />
        {{--
        <div>
            <div class="password-container" style="position: relative;">
                <input type="password" class="input" id="password" name="password" />
                <span class="toggle-eye" onclick="togglePassword()"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👁️</span>
            </div>
        </div> --}}


        Password: <input type="password" name="password" id="password" class="password-section" />
        <span onclick="togglePassword()" style="cursor: pointer" class="eye_btn"> 👀 </span>
        <span class="password_error"> </span>
        @error('password')
            <span class="password_error"> {{ $message }} </span>
        @enderror
        <br /> <br />

        {{-- {{ session('credenetial_error') }} --}}

        {{-- {!! session(['credential_error' => null]) !!} --}}

        @php
            if (!is_null(session('credenetial_error'))) {
                echo session('credenetial_error');
                session(['credenetial_error' => null]);
            }
        @endphp

        <br /> <br />
        {{-- @php
        <span class="email_error"> </span>
        $error = $request->session->get('credential_error');
        @endphp --}}


        <button name="submit_btn" id="submit_btn"> Submit </button>
    </form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function togglePassword() {
        // alert('sdfvdfv');
        var passwordField = document.getElementById("password");
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    }
    // console.log("object");
    $(document).ready(function() {

        // $('.eye_btn').on('click', function() {
        //     var val = $('#password').val();
        //     val.();
        // })

        $(".login_form").on("submit", function(e) {
            var isValidate = true;

            var email = $("#email").val();
            var password = $("#password").val();

            if (!email) {
                $(".email_error").html("Please enter the email");
                isValidate = false;
            }
            if (!password) {
                $(".password_error").html("Please enter the password");
                isValidate = false;
            }

            if (!isValidate) {
                e.preventDefault();
            }
        });
    });
</script>
