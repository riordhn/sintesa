@push('meta')
<!-- Meta Tag -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
@endpush

@extends('app')
@section('content')
@include('partials/header-navigation')
<section class="columns has-background-light" style="min-height: 100vh;">
    @include('partials/sidebar')
    <div class="column is-11-desktop" id="appcontent">
    </div>
</section>
<div id="modal-submit" class="modal">
    <div class="modal-background"></div>
</div>
<div id="modal-change-password" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head is-primary-color">
            <p class="modal-card-title">Ubah Password</p>
            <button class="delete"></button>
        </header>
        <section class="modal-card-body">
            <form id="form-change-password" method="POST" action="{{url('password')}}">
            <div class="field is-horizontal">
                <div class="field-label is-small">
                    <label class="label">Password Lama</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control has-icons-left is-expanded">
                            <input class="input" type="password" name="old_password" minlength="3" required="">
                            <span class="icon is-small is-left">
                                <i class="uil uil-key-skeleton"></i>
                            </span>
                            <p class="help"></p>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-small">
                    <label class="label">Password Baru</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control has-icons-left is-expanded">
                            <input id="new_password" class="input" type="password" name="new_password" minlength="3" required="">
                            <span class="icon is-small is-left">
                                <i class="uil uil-key-skeleton"></i>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-small">
                    <label class="label">Ulangi Password Baru</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control has-icons-left is-expanded">
                            <input class="input" type="password" name="new_confirm_password" minlength="3" required="" equalto="#new_password">
                            <span class="icon is-small is-left">
                                <i class="uil uil-key-skeleton"></i>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <footer class="modal-card-foot">
            <div class="field is-grouped is-grouped-right">
                <div class="control">
                    <button type="submit" class="button is-link is-primary-color">Simpan</button>
                </div>
            </form>
                <div class="control">
                    <button class="button is-cancel is-text">Batal</button>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script type="text/javascript" src="{{asset('vendor/webcamjs/webcam.min.js')}}"></script>
<!-- Javascript -->
<script>
    var dtButtonConfig = {
        buttons: [{
                extend: "pageLength",
                className: "is-black"
            }, {
                extend: "excelHtml5",
                footer: true,
                text: "Download Excel",
                className: "is-success",
                exportOptions: {
                    columns: ":visible"
                }
            }
        ],
        dom: {
            button: {
                className: "button is-small is-rounded"
            }
        }
    };

    var dtLengButton = [
        [10, 25, 50, 100, -1],
        ['10', '25', '50', '100', 'All']
    ];

    $(document).ready(function() {
        var original_title = location.hash;
        var target_url = original_title.replace('#', '');
        if (target_url == '' || target_url == '/' || target_url == 'undefined') {
            loadContent('welcome');
        } else {
            loadContent(target_url);
        }
    });

    window.onhashchange = function() {
        var original_title = location.hash;
        var target_url = original_title.replace('#', '');
        if (target_url == '' || target_url == '/' || target_url == 'undefined') {
            loadContent('welcome');
        } else {
            loadContent(target_url);
        }
    }

    function loadURI(target_url) {
        location.hash = target_url;
    }

    function loadContent(target_url, content) {
        content = typeof content !== 'undefined' ? content : 'appcontent';
        NProgress.start();
        $.ajax({
            type: "GET",
            url: base_url + target_url,
            contentType: false,
            success: function(data) {
                $("#" + content).html(data);

                subsidebarActiveFadeout();
                NProgress.done();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    function reloadContent() {
        var original_title = location.hash;
        var target_url = original_title.replace('#','');
        if (target_url == '' || target_url == '/' || target_url == 'undefined') {
            loadContent('welcome');
        }else{
            loadContent(target_url);
        }
    }

    $('#form-change-password').validate({
        highlight: function(input) {
            $(input).addClass('is-danger');
        },
        unhighlight: function(input) {
            $(input).removeClass('is-danger');
        },
        errorPlacement: function(error, element) {
            $(element).parents('.control').addClass('help').addClass('is-danger').append(error);
        },
        submitHandler: function(form) {
            $('button').attr('disabled', 'disabled');
            $('input').attr('readonly', 'readonly');

            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(result) {
                    if (result.status_code == 200) {
                        iziToast.success({
                            title: 'OK',
                            message: result.message,
                            position: 'topRight'
                        });
                        closeModalHelper();
                        $(form)[0].reset();
                    } else {
                        iziToast.warning({
                            title: 'Oops',
                            message: result.message,
                            position: 'topRight'
                        });
                    }
                },
                complete: function() {
                    $('button').removeAttr('disabled', 'disabled');
                    $('input').removeAttr('readonly', 'readonly');
                }
            });
        }
    });

    function initAutoNumeric() {
        const anElementCurrency = AutoNumeric.multiple('.is-currency', {
            currencySymbol: "Rp",
            decimalCharacter: ".",
            decimalPlaces: 0,
            digitGroupSeparator: ",",
            unformatOnSubmit: true,
            unformatOnHover: false
        });

        const anElementNumber = AutoNumeric.multiple('.is-number', {
            decimalCharacter: ".",
            decimalPlaces: 0,
            digitGroupSeparator: ",",
            unformatOnSubmit: true,
            unformatOnHover: false
        });
    }

    var convertToPercent = function(data) { 
        if(data == null)
            return '-';
        return toNumeric(data)+'%';
    }
    
    var convertToNumeric = function(data) { 
        if(data == null)
            return '-';
        return toNumeric(data);
    }

    var convertToCurrency = function(data) { 
        if(data == null)
            return '-';
        return 'Rp'+toNumeric(data);
    }
    
    function toNumeric(x){
        if(x == null)
            return 0;
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function toCurrency(x){
        if(x == null)
            return 'Rp0';
            
        var rounded_x = Math.round(x);
        return 'Rp'+rounded_x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function initAutoSelect2() {
        $(document).ready(function() {
            $('.is-select2').select2();
        });
    }

    function initCalendar() {
        const datetimeCalendars = bulmaCalendar.attach('.is-datepicker', {
            displayMode: 'dialog',
            dateFormat: 'YYYY-MM-DD',
            validateLabel: 'Select'
        });
        const dateCalendars = bulmaCalendar.attach('.is-date', {
            displayMode: 'dialog',
            dateFormat: 'YYYY-MM-DD'
        });
    }

    $(document).on('click', '.navbar-menu .target-link, .navbar-menu .sidebar-link', function (e) {
        $('.navbar-burger').toggleClass('is-active');
        $('#main-navigation').toggleClass('is-active');
        // $('#appcontent').toggleClass('is-hidden');
	});

    $(document).on('click', '.sidebar-link', function(){
        if($($(this).data('id')).hasClass('is-active')){
            subsidebarFadeout(this);
        }else{
            $('.is-subsidebar').removeClass('is-active');
            $($(this).data('id')).addClass('is-active');
        }

        if($('.is-subsidebar').hasClass('is-active')){
            $('#appcontent').removeClass('is-11-desktop');
            $('#appcontent').addClass('is-9-desktop');
        }
    });

    function subsidebarFadeout(el){
        $($(el).data('id')).addClass('is-fadeout');
        setTimeout(function(){
            $($(el).data('id')).removeClass('is-active');
            $($(el).data('id')).removeClass('is-fadeout');

            $('#appcontent').removeClass('is-9-desktop');
            $('#appcontent').addClass('is-11-desktop');
        }, 200);
    }

    function subsidebarActiveFadeout(){
        $('.is-subsidebar.is-active').addClass('is-fadeout');
        setTimeout(function(){
            $('.is-subsidebar.is-active').removeClass('is-fadeout');
            $('.is-subsidebar.is-active').removeClass('is-active');

            $('#appcontent').removeClass('is-9-desktop');
            $('#appcontent').addClass('is-11-desktop');
        }, 200);
    }

    async function deleteItemAction(el) {
        var item = $(el);
        if (item.hasClass('is-loading')) {
            return false;
        } else {
            item.addClass('is-loading');
        }

        Swal.fire({
            title: 'Apakah Anda yakin menghapus data ini?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: base_url + item.attr('data-menu')  + '/' + item.attr('data-id'),
                    async: false,
                    success: function(result) {
                        item.removeClass('is-loading');
                        if (result.status_code == 200) {
                            iziToast.success({
                                title: 'OK',
                                message: result.message,
                                position: 'topRight'
                            });
                            primary_table.ajax.reload(null, false);
                        } else {
                            iziToast.warning({
                                title: 'Oops',
                                message: result.message,
                                position: 'topRight'
                            });
                        }
                    }
                });
            }else{
                item.removeClass('is-loading');
            }
        })
    }
</script>
@endpush