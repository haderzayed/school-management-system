<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\classroom;
use App\Models\grade;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class GradesController extends Controller
{
    use ResponseTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $grades=grade::all();
        return view('pages.grades.grades-index',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
       return view('pages.grades.grades-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $data=$request->validate([
            'stage_name_ar'=>'required' ,
            'stage_name_en'=>'required',
            'notes'=>'string|nullable',
        ]);

        if(grade::where('name->ar',$data['stage_name_ar'])->orWhere('name->en',$data['stage_name_en'])->exists()){

            return redirect()->back()->withErrors(trans('main_trans.exists'));
        }
        try {
            grade::create([
                'name' => ['en' => $data['stage_name_en'], 'ar' => $data['stage_name_ar']],
                'notes' => $data['notes'],
            ]);
            toastr()->success(trans('main_trans.Added Succsesufly'));
            return redirect()->route('grades.index');
        }catch (\Exception $e){
            toastr()->error(trans('main_trans.sorry error'));
            return back();
        }
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $grade=grade::find($id);
        return view('pages.grades.grades-edit',compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        try{
            $data=$request->validate([
                'stage_name_ar'=>'required' ,
                'stage_name_en'=>'required',
                'notes'=>'string|nullable',
            ]);
            $Grade=grade::findOrFail($id);
            if(!$Grade ){
                toastr()->error(trans('sorry this grade not found'));
                return back();
            }
            grade::where('id',$id)->update([
                'name' => ['en' => $data['stage_name_en'], 'ar' => $data['stage_name_ar']],
                'notes' => $data['notes'],
            ]);
            toastr()->success(trans('main_trans.Update Succsesufly'));
            return redirect()->route('grades.index');

        }catch (\Exception $e){

            toastr()->error(trans('sorry error'));

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $Grade=grade::findOrFail($id);
            if(!$Grade ){
                toastr()->error(trans('sorry this grade not found'));
                return back();
            }

            $classrooms=classroom::where('grade_id',$id)->get();
            if(!$classrooms){
            grade::destroy($id);
            toastr()->success(trans('main_trans.Delete Succsesufly'));
            return redirect()->route('grades.index');
            }
            return redirect()->back()->withErrors(trans('grades_trans.sorry this grade have classrooms, delete classrooms first'));
        }catch (\Exception $exception){
            toastr()->error(trans('sorry error'));
            return back();
        }

    }
}
