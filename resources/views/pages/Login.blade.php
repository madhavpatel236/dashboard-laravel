<div>

    <form action="{{ route('loginAuth') }}" method="post" name="login_form">
        @csrf
        Email: <input name="email" id="email" type="email" required /> <br /> <br/>
        Password: <input name="password" id="password" type="password" required /> <br /> <br/>
        <button name="submit_btn" id="submit_btn"> Submit </button>
    </form>

</div>
