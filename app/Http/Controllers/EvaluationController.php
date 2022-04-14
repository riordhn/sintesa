<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Evaluation;
use Yajra\Datatables\Datatables;

use Validator;

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

        if($request->hasFile('proposal_proof')){
            $proposal_proof = $request->file('proposal_proof');
            
            $filename = pathinfo($proposal_proof->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($proposal_proof->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $proposal_proof->move(public_path('uploads/evaluation/proposal_proof'), $filename_new);
            $item->proposal_proof = '/uploads/evaluation/proposal_proof/'.$filename_new;
        }

        $item->has_similarity_test = $request->has_similarity_test;
        $item->evaluation_date = $request->evaluation_date;
        $item->percentage_evaluation = $request->percentage_evaluation;

        if($request->hasFile('similarity_proof')){
            $similarity_proof = $request->file('similarity_proof');
            
            $filename = pathinfo($similarity_proof->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($similarity_proof->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $similarity_proof->move(public_path('uploads/evaluation/similarity_proof'), $filename_new);
            $item->similarity_proof = '/uploads/evaluation/similarity_proof/'.$filename_new;
        }

        $item->percentage_end_test = $request->percentage_end_test;
        $item->end_test_date = $request->end_test_date;

        if($request->hasFile('end_test_proof')){
            $end_test_proof = $request->file('end_test_proof');
            
            $filename = pathinfo($end_test_proof->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($end_test_proof->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $end_test_proof->move(public_path('uploads/evaluation/end_test_proof'), $filename_new);
            $item->end_test_proof = '/uploads/evaluation/end_test_proof/'.$filename_new;
        }
        $item->percentage_pass_academic = $request->percentage_pass_academic;

        $item->save();

        return success_response('Sukses mensubmit evaluasi');
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
        $item = Evaluation::findOrFail($id);

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

        if($request->hasFile('proposal_proof')){
            $proposal_proof = $request->file('proposal_proof');
            
            $filename = pathinfo($proposal_proof->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($proposal_proof->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $proposal_proof->move(public_path('uploads/evaluation/proposal_proof'), $filename_new);
            $item->proposal_proof = '/uploads/evaluation/proposal_proof/'.$filename_new;
        }

        $item->has_similarity_test = $request->has_similarity_test;
        $item->evaluation_date = $request->evaluation_date;
        $item->percentage_evaluation = $request->percentage_evaluation;

        if($request->hasFile('similarity_proof')){
            $similarity_proof = $request->file('similarity_proof');
            
            $filename = pathinfo($similarity_proof->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($similarity_proof->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $similarity_proof->move(public_path('uploads/evaluation/similarity_proof'), $filename_new);
            $item->similarity_proof = '/uploads/evaluation/similarity_proof/'.$filename_new;
        }

        $item->percentage_end_test = $request->percentage_end_test;
        $item->end_test_date = $request->end_test_date;

        if($request->hasFile('end_test_proof')){
            $end_test_proof = $request->file('end_test_proof');
            
            $filename = pathinfo($end_test_proof->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($end_test_proof->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $end_test_proof->move(public_path('uploads/evaluation/end_test_proof'), $filename_new);
            $item->end_test_proof = '/uploads/evaluation/end_test_proof/'.$filename_new;
        }
        $item->percentage_pass_academic = $request->percentage_pass_academic;
        $item->save();

        return success_response('Sukses merevisi evaluasi');
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
