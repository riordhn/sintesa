<style>
    .notification{
        padding: 1.25rem;
    }
</style>
<div class="card">
    <div class="card-content">
        @include('partials/breadcrumb-navigation', ['breadcrumb' => $breadcrumb])
    </div>
</div>
<div class="card is-gap">
    <div class="card-content">
        <div class="content">
            <p>Halo, selamat datang {{check_admin()? auth_data()->fullname : auth_data()->NAMA}} di Sistem Terintegrasi Sintesa</p>
        </div>
    </div>
</div>