<form id="form-manage-item" 
    method="POST"
    action="{{ !empty($item)? route('evaluation.update', $item->evaluation_id) : route('evaluation.store') }}">

    <input type="hidden" name="_method" value="{{ !empty($item)? 'PUT' : 'POST' }}">

    <div class="box">
        <nav class="level">
            <div class="level-left">
                <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
            </div>
        </nav>
        <ul class="steps">
            <li class="steps-segment is-step-1 is-active">
                <span class="steps-marker">1</span>
            </li>
            <li class="steps-segment is-step-2">
                <span class="steps-marker">2</span>
            </li>
            <li class="steps-segment is-step-3">
                <span class="steps-marker">3</span>
            </li>
            <li class="steps-segment is-step-4">
                <span class="steps-marker">4</span>
            </li>
            <li class="steps-segment is-step-5">
                <span class="steps-marker">5</span>
            </li>
        </ul>
        <div id="steps-1" class="is-steps-content">
            <p class="title is-5"><u>Informasi Studi</u></p>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Nama<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" name="name" required="" value="{{!empty($item)? $item->name : auth_data()->NAMA}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Unit Kerja<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" name="division" required="" value="{{!empty($item)? $item->division : auth_data()->UNIT_KERJA}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Jenjang Studi<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <select class="input" name="stage">
                                <option {{(!empty($item) && $item->stage == 'S1')? 'selected' : '' }} value="S1">S1</option>
                                <option {{(!empty($item) && $item->stage == 'S2')? 'selected' : '' }} value="S2">S2</option>
                                <option {{(!empty($item) && $item->stage == 'S3')? 'selected' : '' }} value="S3">S3</option>
                                <option {{(!empty($item) && $item->stage == 'Sp.1')? 'selected' : '' }} value="Sp.1">Sp.1</option>
                                <option {{(!empty($item) && $item->stage == 'Sp.2')? 'selected' : '' }} value="Sp.2">Sp.2</option>
                            </select>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Prodi<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" name="study" required="" value="{{!empty($item)? $item->study : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Instansi<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" name="institution" required="" value="{{!empty($item)? $item->institution : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Semester Saat ini<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="number" name="semester" required="" value="{{!empty($item)? $item->semester : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Status Studi<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="study_status" {{(!empty($item) && $item->study_status == 1)? 'checked' : '' }} value="1">
                                <b>Sudah Selesai</b>
                            </label>
                            <label class="radio">
                                <input type="radio" name="study_status" {{(!empty($item) && $item->study_status == 2)? 'checked' : '' }} value="2">
                                <b>Belum Selesai</b>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Ijazah</label>
                </div>
                <div class="field-body">
                    <div class="box">
                        @if(!empty($item) && !empty($item->study_certificate))
                        <a href="{{$item->study_certificate}}?v={{time()}}" target="_blank">Download Ijazah</a>
                        <input class="input" type="file" name="study_certificate">
                        @else
                        <input class="input" type="file" name="study_certificate">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="steps-2" class="is-steps-content is-hidden">
            <p class="title is-5"><u>Aktivitas Studi</u></p>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Pembimbing 1</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" name="mentor_1" value="{{!empty($item)? $item->mentor_1 : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Pembimbing 2</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" name="mentor_2" value="{{!empty($item)? $item->mentor_2 : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Topik Penelitian</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" name="topic" value="{{!empty($item)? $item->topic : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Persentase Penulisan Tugas Akhir<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="number" name="percentage_ta" required="" value="{{!empty($item)? $item->percentage_ta : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Langkah kongkrit semester depan dalam capaian menyelesaikan studi<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <textarea class="textarea" name="follow_up_ta" placeholder="..." rows="4" oninput="inputTextArea()">{{!empty($item)? $item->follow_up_ta : ''}}</textarea>
                            <small class="has-text-danger" id="word_count">Minimal karakter 1/150</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Unggah KHS</label>
                </div>
                <div class="field-body">
                    <div class="box">
                        @if(!empty($item) && !empty($item->study_semester_result))
                        <a href="{{$item->study_semester_result}}?v={{time()}}" target="_blank">Download KHS</a>
                        <input class="input" type="file" name="study_semester_result">
                        @else
                        <input class="input" type="file" name="study_semester_result">
                        @endif
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Unggah Daftar Hadir Bimbingan</label>
                </div>
                <div class="field-body">
                    <div class="box">
                        @if(!empty($item) && !empty($item->study_presence))
                        <a href="{{$item->study_presence}}?v={{time()}}" target="_blank">Download Daftar Hadir Bimbingan</a>
                        <input class="input" type="file" name="study_presence">
                        @else
                        <input class="input" type="file" name="study_presence">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="steps-3" class="is-steps-content is-hidden">
            <p class="title is-5"><u>TOEFL</u></p>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Status TOEFL<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="is_toefl" onclick="onChangeRadioToefl()" {{(!empty($item) && empty($item->toefl->toefl_plan))? 'checked' : '' }} value="1">
                                <b>Sudah</b>
                            </label>
                            <label class="radio">
                                <input type="radio" name="is_toefl" onclick="onChangeRadioToefl()" {{(!empty($item) && !empty($item->toefl->toefl_plan))? 'checked' : '' }} value="2">
                                <b>Belum</b>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="is-toefl-done" class="{{!empty($item)? empty($item->toefl->toefl_plan)? '' : 'is-hidden' : 'is-hidden'}}">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Nilai</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="number" name="toefl_value" value="{{!empty($item)? $item->toefl->toefl_value : ''}}">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Tanggal Tes<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="date" name="toefl_date" required="" value="{{!empty($item)? $item->toefl->toefl_date : ''}}">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Berlaku sampai dengan<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="date" name="toefl_expired_date" required="" value="{{!empty($item)? $item->toefl->toefl_expired_date : ''}}">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Badan Penyelenggara<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="toefl_by" required="" value="{{!empty($item)? $item->toefl->toefl_by : ''}}">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Unggah Bukti Sertifikat<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="box">
                            @if(!empty($item) && !empty($item->toefl->toefl_file))
                            <a href="{{$item->toefl->toefl_file}}?v={{time()}}" target="_blank">Download KHS</a>
                            <input class="input" type="file" name="toefl_file">
                            @else
                            <input class="input" type="file" name="toefl_file">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="is-toefl-not-done" class="{{!empty($item)? !empty($item->toefl->toefl_plan)? '' : 'is-hidden' : 'is-hidden'}}">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Rencana TOEFL<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="date" name="toefl_plan" required="" value="{{!empty($item)? $item->toefl->toefl_plan : ''}}">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="steps-4" class="is-steps-content is-hidden">
            <p class="title is-5"><u>Publikasi</u></p>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Status Publikasi<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="is_publicity" onclick="onChangeRadioPublicity()" {{(!empty($item) && empty($item->publicity->publicity_plan))? 'checked' : '' }} value="1">
                                <b>Sudah</b>
                            </label>
                            <label class="radio">
                                <input type="radio" name="is_publicity" onclick="onChangeRadioPublicity()" {{(!empty($item) && !empty($item->publicity->publicity_plan))? 'checked' : '' }} value="2">
                                <b>Belum</b>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="is-publicity-done" class="{{!empty($item)? empty($item->publicity->publicity_plan)? '' : 'is-hidden' : 'is-hidden'}}">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Kategori<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <select class="input" name="publicity_category">
                                    <option>Pilih</option>
                                    <option {{(!empty($item) && $item->publicity->publicity_category == 'Jurnal')? 'selected' : '' }} value="Jurnal">Jurnal</option>
                                    <option {{(!empty($item) && $item->publicity->publicity_category == 'Prosedings')? 'selected' : '' }} value="Prosedings">Prosedings</option>
                                </select>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Nama Jurnal / Forum Ilmiah / Seminar<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="journal_name" required="" value="{{!empty($item)? $item->journal_name : ''}}">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Progres Publikasi<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <select class="input" name="publicity_progress">
                                    <option>Pilih</option>
                                    <option {{(!empty($item) && $item->publicity->publicity_progress == 'Accepted')? 'selected' : '' }} value="Accepted">Accepted</option>
                                    <option {{(!empty($item) && $item->publicity->publicity_progress == 'Publish')? 'selected' : '' }} value="Publish">Publish</option>
                                    <option {{(!empty($item) && $item->publicity->publicity_progress == 'Submit')? 'selected' : '' }} value="Submit">Submit</option>
                                </select>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Tanggal Submit / Accepted / Publish / Penyelenggaraan<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="date" name="publicity_date" required="" value="{{!empty($item)? $item->publicity->publicity_date : ''}}">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Unggah Bukti Sertifikat<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="box">
                            @if(!empty($item) && !empty($item->publicity->publicity_file))
                            <a href="{{$item->publicity->publicity_file}}?v={{time()}}" target="_blank">Download KHS</a>
                            <input class="input" type="file" name="publicity_file">
                            @else
                            <input class="input" type="file" name="publicity_file">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="is-publicity-not-done" class="{{!empty($item)? !empty($item->publicity->publicity_plan)? '' : 'is-hidden' : 'is-hidden'}}">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Rencana Publikasi<small class="has-text-danger">*</small></label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="date" name="publicity_plan" required="" value="{{!empty($item)? $item->publicity->publicity_plan : ''}}">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="steps-5" class="is-steps-content is-hidden">
            <p class="title is-5"><u>Ujian Akhir</u></p>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Ujian Proposal<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="has_proposal_test" {{(!empty($item) && $item->has_proposal_test == 1)? 'checked' : '' }} value="1">
                                <b>Sudah</b>
                            </label>
                            <label class="radio">
                                <input type="radio" name="has_proposal_test" {{(!empty($item) && $item->has_proposal_test == 2)? 'checked' : '' }} value="2">
                                <b>Belum</b>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Tanggal Ujian Proposal/Rencana Ujian Proposal<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="date" name="proposal_date" required="" value="{{!empty($item)? $item->proposal_date : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Unggah Bukti Ujian Proposal</label>
                </div>
                <div class="field-body">
                    <div class="box">
                        @if(!empty($item) && !empty($item->proposal_file))
                        <a href="{{$item->proposal_file}}?v={{time()}}" target="_blank">Download Bukti Ujian Proposal</a>
                        <input class="input" type="file" name="proposal_file">
                        @else
                        <input class="input" type="file" name="proposal_file">
                        @endif
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Uji Similaritas<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="has_similarity_test" {{(!empty($item) && $item->has_similarity_test == 1)? 'checked' : '' }} value="1">
                                <b>Sudah</b>
                            </label>
                            <label class="radio">
                                <input type="radio" name="has_similarity_test" {{(!empty($item) && $item->has_similarity_test == 2)? 'checked' : '' }} value="2">
                                <b>Belum</b>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Tanggal Uji Similaritas/Rencana Uji Similaritas<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="date" name="evaluation_date" required value="{{!empty($item)? $item->evaluation_date : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Persentase Hasil Penilaian</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="number" name="percentage_evaluation" value="{{!empty($item)? $item->percentage_evaluation : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Unggah Bukti Uji Similaritas</label>
                </div>
                <div class="field-body">
                    <div class="box">
                        @if(!empty($item) && !empty($item->similarity_file))
                        <a href="{{$item->similarity_file}}?v={{time()}}" target="_blank">Download Bukti Uji Similaritas</a>
                        <input class="input" type="file" name="similarity_file">
                        @else
                        <input class="input" type="file" name="similarity_file">
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Tanggal Ujian Akhir/Rencana Ujian Akhir<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="date" name="end_test_date" required value="{{!empty($item)? $item->end_test_date : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Unggah Bukti Ujian Akhir</label>
                </div>
                <div class="field-body">
                    <div class="box">
                        @if(!empty($item) && !empty($item->end_test_file))
                        <a href="{{$item->end_test_file}}?v={{time()}}" target="_blank">Download Bukti Ujian Akhir</a>
                        <input class="input" type="file" name="end_test_file">
                        @else
                        <input class="input" type="file" name="end_test_file">
                        @endif
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Persentase Kelulusan<small class="has-text-danger">*</small></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="number" required="" name="percentage_pass_academic" value="{{!empty($item)? $item->percentage_pass_academic : ''}}">
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Kendala selama Studi</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <textarea class="textarea" name="study_problem" placeholder="..." rows="4">{{!empty($item)? $item->study_problem : ''}}</textarea>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <input class="input" type="hidden" name="step_number" value="1">
        <br>
        <div class="buttons is-centered">
            <button id="btn_next" class="button is-info" type="button" onclick="changeInputStatus()">
                <span>Selanjutnya</span>
            </button>
            <button id="btn_submit" class="button is-success is-hidden" type="submit">
                <span class="icon">
                    <i class="fa fa-save"></i>
                </span>
                <span>Simpan Form</span>
            </button>
        </div>
    </div>
</form>

<script>
    function onChangeRadioToefl(){
        if($('input[name="is_toefl"]:checked').val() == 1){
            $('#is-toefl-done').removeClass('is-hidden'); 
            $('#is-toefl-not-done').addClass('is-hidden');
        }else{
            $('#is-toefl-done').addClass('is-hidden'); 
            $('#is-toefl-not-done').removeClass('is-hidden');
        }
    }
    function onChangeRadioPublicity(){
        if($('input[name="is_publicity"]:checked').val() == 1){
            $('#is-publicity-done').removeClass('is-hidden'); 
            $('#is-publicity-not-done').addClass('is-hidden');
        }else{
            $('#is-publicity-done').addClass('is-hidden'); 
            $('#is-publicity-not-done').removeClass('is-hidden');
        }
    }
</script>
<script>
    function changeInputStatus(){
        var num = $('input[name=step_number]').val();
        var next_num = parseInt(num) + 1;

        $('.is-steps-content').addClass('is-hidden');
        $('#steps-' + next_num).removeClass('is-hidden');
        
        $('.steps-segment').removeClass('is-active');
        $('.steps-segment.is-step-' + next_num).addClass('is-active');

        if(num == 4){
            $('#btn_next').addClass('is-hidden');
            $('#btn_submit').removeClass('is-hidden');
        }else{
            $('input[name=step_number]').val(next_num);
        }
    }

    function inputTextArea(){
        var str = $('textarea[name=follow_up_ta]').val();

        str = str.replace(/(^\s*)|(\s*$)/gi,"");
        str = str.replace(/[ ]{2,}/gi," ");
        str = str.replace(/\n /,"\n");
        var str_count = str.split(' ').length;

        $('#word_count').html(`Minimal kata ${str_count}/150`);

        if(str_count >= 150){
            if($('#word_count').hasClass('has-text-danger')){
                $('#word_count').removeClass('has-text-danger');
                $('#word_count').addClass('has-text-success');
            }
        }else{
            if($('#word_count').hasClass('has-text-success')){
                $('#word_count').removeClass('has-text-success');
                $('#word_count').addClass('has-text-danger');
            }
        }
    }

    $('#form-manage-item').validate({
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
            $('button').addClass('is-loading');
            $('control').addClass('is-loading');
            $('input').attr('readonly', 'readonly');

            var formData = new FormData(form);
            $.ajax({
                url: form.action,
                type: form.method,
                enctype: 'multipart/form-data',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status_code == 200) {
                        iziToast.success({
                            title: 'Succesfully',
                            message: response.message,
                            position: 'topRight'
                        });
                        closeModalHelper();
                        primary_table.ajax.reload(null, false);
                    } else {
                        iziToast.warning({
                            title: 'Oops',
                            message: response.message,
                            position: 'topRight'
                        });
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