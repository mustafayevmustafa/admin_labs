@extends('base')

@section('content')
<div class="side-app">
    <section class="sptb">
        <div class="container customerpage">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label text-dark">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label text-dark">Confirm Password</label>
                            <input id="confirm-password" type="password" class="form-control" name="confirm-password" required>
                            <span class="invalid-feedback" role="alert">
                                <strong>The password confirmation does not match.</strong>
                            </span>
                        </div>
                        <div class="form-footer mt-2">
                            <button type="submit" class="btn ripple btn-primary btn-block btn-change">
                                Change Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('javascript')
<script>
    $('.btn-change').click(function() {
        let password = $("#password");
        let confirmPassword = $("#confirm-password");

        if (password.val() == '') {
            password.addClass('is-invalid');
        }
        if (password.val() != confirmPassword.val()) {
            confirmPassword.addClass('is-invalid');

        }
        if (password.val() == confirmPassword.val()) {
            $.ajax({
                type: "POST",
                url: "/password_change",
                data: {
                    _token: _token,
                    password: password.val(),
                    confirmPassword: confirmPassword.val(),
                },
                success: function(data) {
                    console.log(data);
                    if (data.success == true) {
                        window.location.href = '/';
                    }
                }
            });
        }
    });
</script>
@endsection
