@push('meta')
<!-- Meta Tag -->
@endpush

@extends('app')
@section('content')
<style>
    .bg-sign-in{
        background-color: #091540; 
    }

    .login {
        border-radius: 25px;
        padding: 1.5rem;
        box-shadow: 8px 8px 15px var(--shadowDark), -8px -8px 15px var(--shadowLight);
    }
</style>

<section class="hero is-fullheight">
    <div class="hero-body bg-sign-in" style="justify-content: center;">
        <form id="form-signin" action="{{url('signin')}}" method="POST">
            <div class="login">
                <center>
                    <figure class="image">
                        <img style="width: 175px" src="{{asset('img/main-logo.png')}}">
                    </figure>
                </center>
                <br>
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-rounded" type="text" placeholder="Username/NIP"
                            name="nip" required />
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-rounded" type="password" placeholder="**********"
                            name="password" required />
                    </div>
                </div>
                <br />
                <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                    Login
                </button>
                <br>
                <div class="has-text-centered has-text-white">
                    <small>@riordhn &copy;{{now()->format('Y')}}</small>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<!-- Javascript -->
<script>
    $('html').css('overflow', 'hidden');
    $('#form-signin').validate({
        highlight: function (input) {
            $(input).addClass('is-danger');
        },
        unhighlight: function (input) {
            $(input).removeClass('is-danger');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.control').addClass('help').addClass('is-danger').append(error);
        },
        submitHandler: function(form) {
            $('button').addClass('is-loading');
            $('control').addClass('is-loading');
            $('input').attr('readonly', 'readonly');
            
            var formData = new FormData(form);

            $.ajax({
                url: form.action,
                type: form.method,
                // enctype: 'multipart/form-data',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response.status_code == 200){
                        iziToast.success({ title: 'OK', message: response.message, position: 'topRight' });
                        window.location.href = base_url + 'dashboard';
                    }else{
                        iziToast.warning({ title: 'Oops', message: response.message, position: 'topRight' });
                    }
                },
                complete: function() {
                    $('button').removeClass('is-loading');
                    $('control').removeClass('is-loading');
                    $('input').removeAttr('readonly', 'readonly');
                }
            });
        }
    });
</script>
@endpush