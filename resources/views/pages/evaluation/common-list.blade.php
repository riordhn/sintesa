<div class="card is-bottom-gap">
    <div class="card-content">
        @include('partials/breadcrumb-navigation', ['breadcrumb' => $breadcrumb])
    </div>
</div>
<div id="modal-manage-item" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content" id="modal-manage-item-content" style="width: 85%;">
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
</div>
<div class="card">
    <div class="card-content">
        <div class="container is-bottom-gap">
            <nav class="level">
                <div class="level-left">
                    <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <button class="button is-small is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('evaluation/create', 'modal-manage-item-content')">
                            <span class="icon">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span>Submit Baru</span>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
            <table class="table is-narrow is-bordered is-striped is-fullwidth" id="primary_table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Submit</th>
                        <th>ID</th>
                        @if(check_admin())
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Unit Kerja</th>
                        @endif
                        <th>Institusi</th>
                        <th>Jenjang</th>
                        <th>Prodi</th>
                        <th>Semester</th>
                        <th>Status Studi</th>
                        <th>File Ijazah</th>

                        <th>Pembimbing 1</th>
                        <th>Pembimbing 2</th>
                        <th>Topik Skripsi/Tesis/Disertasi</th>
                        <th>Penulisan Tugas Akhir</th>
                        <th>Langkah Kongkrit</th>
                        <th>KHS</th>
                        <th>Daftar Hadir Bimbingan</th>
                        <th>Ujian proposal</th>
                        <th>Tanggal Ujian Proposal</th>
                        <th>Bukti Ujian Proposal</th>
                        <th>Status Uji Similaritas</th>
                        <th>Tanggal Penilaian</th>
                        <th>Hasil Penilaian</th>
                        <th>Bukti Uji Similaritas</th>

                        <th>Tanggal Ujian Akhir</th>
                        <th>Bukti Ujian Akhir</th>
                        <th>Progress Kelulusan (%)</th>
                        <th>Kendala Selama Studi</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    var primary_table = $('#primary_table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfr<"datatable-content"t>ip',
        buttons: dtButtonConfig,
        lengthMenu: dtLengButton,
        pageLength: 25,
        ajax: {
            url: base_url + 'evaluation/dt',
            type: 'GET',
        },
        columns: [{
                defaultContent: 0,
                searchable: false,
                orderable: false
            },
            {
                data: 'created_at',
                searchable: false,
            },
            { data: 'evaluation_code' },
            @if(check_admin())
            { data: 'NIK' },
            { data: 'name' },
            { data: 'division' },
            @endif
            { data: 'institution' },
            { data: 'stage' },
            { data: 'study' },
            { data: 'semester' },
            { data: 'study_status' },
            {
                data: 'study_certificate',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download File` +
                            `</a>`;
                    }
                    
                    return html;
                }
            },
            { data: 'mentor_1' },
            { data: 'mentor_2' },
            { data: 'topic' },
            { data: 'percentage_ta' },
            { data: 'follow_up_ta' },
            {
                data: 'study_semester_result',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download File` +
                            `</a>`;
                    }
                    
                    return html;
                }
            },
            {
                data: 'study_presence',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download File` +
                            `</a>`;
                    }
                    
                    return html;
                }
            },
            { data: 'has_proposal_test' },
            { data: 'proposal_date' },
            {
                data: 'proposal_file',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download File` +
                            `</a>`;
                    }
                    
                    return html;
                }
            },
            { data: 'has_similarity_test' },
            { data: 'evaluation_date' },
            { data: 'percentage_evaluation' },
            {
                data: 'similarity_file',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download File` +
                            `</a>`;
                    }
                    
                    return html;
                }
            },
            { data: 'end_test_date' },
            {
                data: 'end_test_file',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download File` +
                            `</a>`;
                    }
                    
                    return html;
                }
            },
            { data: 'percentage_pass_academic' },
            {
                data: 'action',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;
                    
                    html = `<button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('evaluation/` + data.id + `/edit', 'modal-manage-item-content')">` +
                    `    <span>Revisi</span>` +
                    `</button>`;
                    
                    return html;
                }
            },
            { data: 'study_problem' 
                searchable: false,
                orderable: false
            },

        ],
        order: [
            [1, 'desc']
        ],
    });

    primary_table.on('draw', function() {
        primary_table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            var start = this.page.info().page * this.page.info().length;
            cell.innerHTML = start + i + 1;
            primary_table.cell(cell).invalidate('dom');
        });
    }).draw();

    async function deleteAction(element) {
        var item = $(element);
        if (item.hasClass('is-loading')) {
            return false;
        } else {
            item.addClass('is-loading');
        }

        Swal.fire({
            title: 'Are you sure you want to delete this data?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: base_url + 'evaluation/' + item.attr('data-id'),
                    async: false,
                    success: function(result) {
                        item.removeClass('is-loading');
                        if (result.status_code == 200) {
                            iziToast.success({
                                title: 'Succesfully',
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