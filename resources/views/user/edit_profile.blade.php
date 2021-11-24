@extends('base')

@section('content')
<div class="side-app">

    <!--Page-Header-->
    <div class="page-header">
        <h4 class="page-title">Edit Profile</h4>
    </div>
    <div class="card mb-0">
      
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{$user->first_name}}" class="form-control" placeholder="First Name">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{$user->last_name}}" class="form-control" placeholder="Last Name">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="number" id="phone_number" name="phone_number" value="{{$user->phone_number}}" class="form-control" placeholder="Number">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" id="username" name="username" value="{{$user->username}}" class="form-control" placeholder="Number">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" id="address" name="address" value="{{$user->address}}" class="form-control" placeholder="Home Address">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <input type="text" id="country" name="country" value="{{$user->country}}" class="form-control" placeholder="Country">
                    </div>

                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-label">Postal Code</label>
                        <input type="number" id="postal_code" name="postal_code" value="{{$user->postal_code}}" class="form-control" placeholder="ZIP Code">
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select class="form-control select2-show-search border-bottom-0 w-100 select2-show-search" data-placeholder="Select" >
                                        <optgroup label="Categories">
                                            <option>--Select--</option>
                                            <option value="1">Germany</option>
                                            <option value="2">Real Estate</option>
                                            <option value="3">Canada</option>
                                            <option value="4">Usa</option>
                                            <option value="5">Afghanistan</option>
                                            <option value="6">Albania</option>
                                            <option value="7">China</option>
                                            <option value="8">Denmark</option>
                                            <option value="9">Finland</option>
                                            <option value="10">India</option>
                                            <option value="11">Kiribati</option>
                                            <option value="12">Kuwait</option>
                                            <option value="13">Mexico</option>
                                            <option value="14">Pakistan</option>
                                        </optgroup>
                                    </select>
                                </div> -->
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" id="city" name="city" value="{{$user->city}}" class="form-control" placeholder="City">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Facebook</label>
                        <input type="text" id="facebook" name="facebook" value="{{$user->facebook}}" class="form-control" placeholder="https://www.facebook.com/">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Instagram</label>
                        <input type="text" id="instagram" name="instagram" value="{{$user->instagram}}" class="form-control" placeholder="https://www.instagram.com/">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Twitter</label>
                        <input type="text" id="twitter" name="twitter" value="{{$user->twitter}}" class="form-control" placeholder="https://twitter.com/">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Pinterest</label>
                        <input type="text" id="pinterest" name="pinterest" value="{{$user->pinterest}}" class="form-control" placeholder="https://pinterest.com/">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">About Me</label>
                        <textarea rows="5" id="about" name="about" class="form-control" placeholder="Enter About your description">{{$user->about}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <label class="form-label">Upload Image</label>
                        <input type="file" id="profile_image" class="profile_image" data-max-file-size="3M" data-default-file="{{$user->profile_image}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn ripple  btn-primary update_btn btn-block disabled ">Updated Profile</button>
    </div>
</div>
</div>
@endsection

@section('javascript')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.profile_image').dropify();
    var user_id = '{{$user->id}}';
    var first_name = $('#first_name');
    var last_name = $('#last_name');
    var email = $('#email');
    var phone_number = $('#phone_number');
    var username = $('#username');
    var address = $('#address');
    var country = $('#country');
    var postal_code = $('#postal_code');
    var city = $('#city');
    var facebook = $('#facebook');
    var instagram = $('#instagram');
    var twitter = $('#twitter');
    var pinterest = $('#pinterest');
    var about = $('#about');
    var profile_image = $('#profile_image');
    var update_btn = $('.update_btn');
    first_name.keyup(function() {
        if (first_name.val() != '') {
            update_btn.removeClass('disabled');
            first_name.removeClass('is-invalid');
            first_name.addClass('is-valid');

        } else {
            update_btn.addClass('disabled');
            first_name.addClass('is-invalid');
        }
    });
    last_name.keyup(function() {
        if (last_name.val() != '') {
            update_btn.removeClass('disabled');
            last_name.removeClass('is-invalid');
            last_name.addClass('is-valid');
        } else {
            last_name.addClass('is-invalid');
            update_btn.addClass('disabled');
        }
    });
    username.keyup(function() {
        if (username.val() != '') {
            update_btn.removeClass('disabled');
            username.removeClass('is-invalid');
            username.addClass('is-valid');
        } else {
            username.addClass('is-invalid');
            update_btn.addClass('disabled');
        }
    });
    email.keyup(function() {
        if (email.val() != '') {
            update_btn.removeClass('disabled');
            email.removeClass('is-invalid');
            email.addClass('is-valid');
        } else {
            email.addClass('is-invalid');
            update_btn.addClass('disabled');
        }
    });
    phone_number.keyup(function() {
        update_btn.removeClass('disabled');

    });
    address.keyup(function() {
        update_btn.removeClass('disabled');

    });
    country.keyup(function() {
        update_btn.removeClass('disabled');

    });
    postal_code.keyup(function() {
        update_btn.removeClass('disabled');

    });
    city.keyup(function() {
        update_btn.removeClass('disabled');

    });
    facebook.keyup(function() {
        update_btn.removeClass('disabled');

    });
    instagram.keyup(function() {
        update_btn.removeClass('disabled');

    });
    twitter.keyup(function() {
        update_btn.removeClass('disabled');
    });
    pinterest.keyup(function() {
        update_btn.removeClass('disabled');

    });
    about.keyup(function() {
        update_btn.removeClass('disabled');
    });
    profile_image.change(function() {
        update_btn.removeClass('disabled');
    });
    username.keyup(function() {
        $.ajax({
            type: "POST",
            url: '/username-check',
            data: {
                '_token': '{{csrf_token()}}',
                username: $(this).val(),
            },
            success: function(response) {
                if (response.status === false) {
                    username.addClass('is-invalid');
                    update_btn.addClass('disabled');
                } else {
                    update_btn.removeClass('disabled');
                    username.removeClass('is-invalid');
                    username.addClass('is-valid');

                }
            }
        })
    })
    email.keyup(function() {
        $.ajax({
            type: "POST",
            url: '/email-check',
            data: {
                '_token': '{{csrf_token()}}',
                email: $(this).val(),
            },
            success: function(response) {
                if (response.status === false) {
                    email.addClass('is-invalid');
                    update_btn.addClass('disabled');
                } else {
                    update_btn.removeClass('disabled');
                    email.removeClass('is-invalid');
                }
            }
        })
    });
    update_btn.click(function() {
        if (!$(this).hasClass('disabled')) {
            if (first_name.val() == '') {
                first_name.addClass('is-invalid');
            }
            if (last_name.val() == '') {
                last_name.addClass('is-invalid');
            }
            if (username.val() == '') {
                username.addClass('is-invalid');
            }
            if (email.val() == '') {
                email.addClass('is-invalid');
            }
            if (
                first_name.val() != '' &&
                last_name.val() != '' &&
                username.val() != '' &&
                email.val() != ''
            ) {

                var formData = new FormData();
                var input = document.querySelector('#profile_image').files[0];
                formData.append('_token', '{{csrf_token()}}');
                formData.append('first_name', first_name.val());
                formData.append('last_name', last_name.val());
                formData.append('username', username.val());
                formData.append('user_id', user_id);
                formData.append('email', email.val());
                formData.append('phone_number', phone_number.val());
                formData.append('address', address.val());
                formData.append('country', country.val());
                formData.append('city', city.val());
                formData.append('postal_code', postal_code.val());
                formData.append('facebook', facebook.val());
                formData.append('instagram', instagram.val());
                formData.append('twitter', twitter.val());
                formData.append('pinterest', pinterest.val());
                formData.append('about', about.val());
                formData.append('profile_image', input);
                fetch('/user-profile-edit', {
                    method: 'POST',
                    body: formData
                }).then((result) => {
                    window.location.reload()
                }).catch((err) => {
                    console.log(err);
                });
            }
        }
    });

    $('.dropify-clear').click(function() {
        $.ajax({
            type: "POST",
            url: '/user-image-delete',
            data: {
                _token: "{{csrf_token()}}"
            },
            success: function(data) {
                update_btn.removeClass('disabled');
            }
        })
    });
</script>
@endsection
