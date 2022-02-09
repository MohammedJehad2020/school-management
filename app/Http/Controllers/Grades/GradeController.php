<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();

        return view('pages.Grades.Grades', [
            'grades' => $grades,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrades $request)
    {

        // if(Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()){
        //     return redirect()->back()->withErrors(trans('grades_trans.exists'));
        // }

        try {

            $validated = $request->validated();

            $grade = new Grade();
            $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $grade->Notes = $request->Notes;
            $grade->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGrades $request)
    {
        try {

            $validated = $request->validated();
            $id = $request->id;
            $grade = Grade::findOrFail($id);

            $grade->update([
                $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
                $grade->Notes = $request->Notes,
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //     get all classrooms that relation with grade
        $classrooms = Classroom::where('Grade_id', $request->id)->pluck('Grade_id');

        if ($classrooms->count() == 0) {
            $id = $request->id;
            $grade = Grade::findOrFail($id)->delete();

            toastr()->error(trans('messages.Delete'));
            return redirect()->route('grades.index');
        } else {
            toastr()->error(trans('Grades_trans.delete_Grade_Error'));
            return redirect()->route('grades.index');

        }
    }
}
