<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Evaluation;
use App\Models\EvaluationTOEFL;
use App\Models\EvaluationPublicity;
use App\Models\Login;
use Yajra\Datatables\Datatables;

use Validator;
use DB;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Data Evaluasi', 'link' => 'evaluation']
        );

        return view('pages/evaluation/common-list', compact('breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Data Evaluasi', 'link' => 'evaluation'],
            (object) ['name' => 'New Submit', 'link' => 'evaluation/create']
        );
        
        $item = null;

        return view('pages/evaluation/manage-item', compact('breadcrumb', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }
        DB::beginTransaction();

        try {
            $item = new Evaluation;

            $item->evaluation_code = 'EV-'.time();
            $item->NIK = auth_data()->NIK;
            $item->name = $request->name;
            $item->division = $request->division;
            $item->stage = $request->stage;
            $item->semester = $request->semester;
            $item->study = $request->study;
            $item->institution = $request->institution;
            $item->study_status = $request->study_status;

            if($request->hasFile('study_certificate')){
                $study_certificate = $request->file('study_certificate');
                
                $filename = pathinfo($study_certificate->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($study_certificate->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $study_certificate->move(public_path('uploads/evaluation/study_certificate'), $filename_new);
                $item->study_certificate = '/uploads/evaluation/study_certificate/'.$filename_new;
            }

            $item->mentor_1 = $request->mentor_1;
            $item->mentor_2 = $request->mentor_2;
            $item->topic = $request->topic;
            $item->percentage_ta = $request->percentage_ta;
            $item->follow_up_ta = $request->follow_up_ta;

            if($request->hasFile('study_semester_result')){
                $study_semester_result = $request->file('study_semester_result');
                
                $filename = pathinfo($study_semester_result->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($study_semester_result->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $study_semester_result->move(public_path('uploads/evaluation/study_semester_result'), $filename_new);
                $item->study_semester_result = '/uploads/evaluation/study_semester_result/'.$filename_new;
            }

            if($request->hasFile('study_presence')){
                $study_presence = $request->file('study_presence');
                
                $filename = pathinfo($study_presence->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($study_presence->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $study_presence->move(public_path('uploads/evaluation/study_presence'), $filename_new);
                $item->study_presence = '/uploads/evaluation/study_presence/'.$filename_new;
            }

            $item->has_proposal_test = $request->has_proposal_test;
            $item->proposal_date = $request->proposal_date;

            if($request->hasFile('proposal_file')){
                $proposal_file = $request->file('proposal_file');
                
                $filename = pathinfo($proposal_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($proposal_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $proposal_file->move(public_path('uploads/evaluation/proposal_file'), $filename_new);
                $item->proposal_file = '/uploads/evaluation/proposal_file/'.$filename_new;
            }

            $item->has_similarity_test = $request->has_similarity_test;
            $item->evaluation_date = $request->evaluation_date;
            $item->percentage_evaluation = $request->percentage_evaluation;

            if($request->hasFile('similarity_file')){
                $similarity_file = $request->file('similarity_file');
                
                $filename = pathinfo($similarity_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($similarity_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $similarity_file->move(public_path('uploads/evaluation/similarity_file'), $filename_new);
                $item->similarity_file = '/uploads/evaluation/similarity_file/'.$filename_new;
            }

            $item->end_test_date = $request->end_test_date;

            if($request->hasFile('end_test_file')){
                $end_test_file = $request->file('end_test_file');
                
                $filename = pathinfo($end_test_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($end_test_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $end_test_file->move(public_path('uploads/evaluation/end_test_file'), $filename_new);
                $item->end_test_file = '/uploads/evaluation/end_test_file/'.$filename_new;
            }
            $item->percentage_pass_academic = $request->percentage_pass_academic;
            $item->study_problem = $request->study_problem;

            $item->save();

            if($evaluation_toefl = EvaluationTOEFL::find($item->evaluation_id)){
            }else{
                $evaluation_toefl = new EvaluationTOEFL;
            }
            $evaluation_toefl->evaluation_id = $item->evaluation_id;
            $evaluation_toefl->toefl_plan = $request->toefl_plan;
            $evaluation_toefl->toefl_value = $request->toefl_value;
            $evaluation_toefl->toefl_date = $request->toefl_date;
            $evaluation_toefl->toefl_expired_date = $request->toefl_expired_date;
            $evaluation_toefl->toefl_by = $request->toefl_by;

            if($request->hasFile('toefl_file')){
                $toefl_file = $request->file('toefl_file');
                
                $filename = pathinfo($toefl_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($toefl_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $toefl_file->move(public_path('uploads/evaluation/toefl_file'), $filename_new);
                $evaluation_toefl->toefl_file = '/uploads/evaluation/toefl_file/'.$filename_new;
            }
            $evaluation_toefl->save();

            if($evaluation_publicity = EvaluationPublicity::find($item->evaluation_id)){
            }else{
                $evaluation_publicity = new EvaluationPublicity;
            }
            $evaluation_publicity->evaluation_id = $item->evaluation_id;
            $evaluation_publicity->publicity_plan = $request->publicity_plan;
            $evaluation_publicity->publicity_category = $request->publicity_category;
            $evaluation_publicity->journal_name = $request->journal_name;
            $evaluation_publicity->publicity_progress = $request->publicity_progress;
            $evaluation_publicity->publicity_date = $request->publicity_date;

            if($request->hasFile('publicity_file')){
                $publicity_file = $request->file('publicity_file');
                
                $filename = pathinfo($publicity_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($publicity_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $publicity_file->move(public_path('uploads/evaluation/publicity_file'), $filename_new);
                $evaluation_publicity->publicity_file = '/uploads/evaluation/publicity_file/'.$filename_new;
            }
            $evaluation_publicity->save();

            DB::commit();

            return success_response('Sukses mensubmit evaluasi');
        } catch (\Exception $e) {
            DB::rollback();

            return error_response($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  String  $dt
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $dt = null){
        if(check_admin()){
            $list_data = Evaluation::query();
        }else{
            $list_data = Evaluation::byUser(auth_data()->NIK);
        }

        return Datatables::of($list_data)
                ->editColumn('study_status', function($item){
                    return $item->studyStatusToText();
                })
                ->editColumn('has_proposal_test', function($item){
                    return $item->hasProposalTestToText();
                })
                ->editColumn('has_similarity_test', function($item){
                    return $item->hasSimilarityTestToText();
                })
                ->addColumn('action', function($item){
                    $data = array(
                        'id' => $item->evaluation_id
                    );
                    return $data;
                })
                ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Data Evaluasi', 'link' => 'evaluation'],
            (object) ['name' => 'Revisi dan Submit Kembali', 'link' => 'evaluation/'.$id.'/edit']
        );
        $item = Evaluation::with('toefl', 'publicity')->findOrFail($id);

        return view('pages/evaluation/manage-item', compact('breadcrumb', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $item = Evaluation::findOrFail($id);
            $item->name = $request->name;
            $item->division = $request->division;
            $item->stage = $request->stage;
            $item->semester = $request->semester;
            $item->study = $request->study;
            $item->institution = $request->institution;
            $item->study_status = $request->study_status;

            if($request->hasFile('study_certificate')){
                $study_certificate = $request->file('study_certificate');
                
                $filename = pathinfo($study_certificate->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($study_certificate->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $study_certificate->move(public_path('uploads/evaluation/study_certificate'), $filename_new);
                $item->study_certificate = '/uploads/evaluation/study_certificate/'.$filename_new;
            }

            $item->mentor_1 = $request->mentor_1;
            $item->mentor_2 = $request->mentor_2;
            $item->topic = $request->topic;
            $item->percentage_ta = $request->percentage_ta;
            $item->follow_up_ta = $request->follow_up_ta;

            if($request->hasFile('study_semester_result')){
                $study_semester_result = $request->file('study_semester_result');
                
                $filename = pathinfo($study_semester_result->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($study_semester_result->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $study_semester_result->move(public_path('uploads/evaluation/study_semester_result'), $filename_new);
                $item->study_semester_result = '/uploads/evaluation/study_semester_result/'.$filename_new;
            }

            if($request->hasFile('study_presence')){
                $study_presence = $request->file('study_presence');
                
                $filename = pathinfo($study_presence->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($study_presence->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $study_presence->move(public_path('uploads/evaluation/study_presence'), $filename_new);
                $item->study_presence = '/uploads/evaluation/study_presence/'.$filename_new;
            }

            $item->has_proposal_test = $request->has_proposal_test;
            $item->proposal_date = $request->proposal_date;

            if($request->hasFile('proposal_file')){
                $proposal_file = $request->file('proposal_file');
                
                $filename = pathinfo($proposal_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($proposal_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $proposal_file->move(public_path('uploads/evaluation/proposal_file'), $filename_new);
                $item->proposal_file = '/uploads/evaluation/proposal_file/'.$filename_new;
            }

            $item->has_similarity_test = $request->has_similarity_test;
            $item->evaluation_date = $request->evaluation_date;
            $item->percentage_evaluation = $request->percentage_evaluation;

            if($request->hasFile('similarity_file')){
                $similarity_file = $request->file('similarity_file');
                
                $filename = pathinfo($similarity_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($similarity_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $similarity_file->move(public_path('uploads/evaluation/similarity_file'), $filename_new);
                $item->similarity_file = '/uploads/evaluation/similarity_file/'.$filename_new;
            }

            $item->end_test_date = $request->end_test_date;

            if($request->hasFile('end_test_file')){
                $end_test_file = $request->file('end_test_file');
                
                $filename = pathinfo($end_test_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($end_test_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $end_test_file->move(public_path('uploads/evaluation/end_test_file'), $filename_new);
                $item->end_test_file = '/uploads/evaluation/end_test_file/'.$filename_new;
            }
            $item->percentage_pass_academic = $request->percentage_pass_academic;
            $item->study_problem = $request->study_problem;
            $item->save();

            if($evaluation_toefl = EvaluationTOEFL::find($item->evaluation_id)){
            }else{
                $evaluation_toefl = new EvaluationTOEFL;
            }
            $evaluation_toefl->evaluation_id = $item->evaluation_id;
            $evaluation_toefl->toefl_plan = $request->toefl_plan;
            $evaluation_toefl->toefl_value = $request->toefl_value;
            $evaluation_toefl->toefl_date = $request->toefl_date;
            $evaluation_toefl->toefl_expired_date = $request->toefl_expired_date;
            $evaluation_toefl->toefl_by = $request->toefl_by;

            if($request->hasFile('toefl_file')){
                $toefl_file = $request->file('toefl_file');
                
                $filename = pathinfo($toefl_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($toefl_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $toefl_file->move(public_path('uploads/evaluation/toefl_file'), $filename_new);
                $evaluation_toefl->toefl_file = '/uploads/evaluation/toefl_file/'.$filename_new;
            }
            $evaluation_toefl->save();

            if($evaluation_publicity = EvaluationPublicity::find($item->evaluation_id)){
            }else{
                $evaluation_publicity = new EvaluationPublicity;
            }
            $evaluation_publicity->evaluation_id = $item->evaluation_id;
            $evaluation_publicity->publicity_plan = $request->publicity_plan;
            $evaluation_publicity->publicity_category = $request->publicity_category;
            $evaluation_publicity->journal_name = $request->journal_name;
            $evaluation_publicity->publicity_progress = $request->publicity_progress;
            $evaluation_publicity->publicity_date = $request->publicity_date;

            if($request->hasFile('publicity_file')){
                $publicity_file = $request->file('publicity_file');
                
                $filename = pathinfo($publicity_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($publicity_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
        
                $path = $publicity_file->move(public_path('uploads/evaluation/publicity_file'), $filename_new);
                $evaluation_publicity->publicity_file = '/uploads/evaluation/publicity_file/'.$filename_new;
            }
            $evaluation_publicity->save();

            DB::commit();

            return success_response('Sukses merevisi evaluasi');
        } catch (\Exception $e) {
            DB::rollback();

            return error_response($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
