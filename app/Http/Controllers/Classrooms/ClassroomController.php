<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::all();
        $grades = Grade::all();

        return view('pages.Classrooms.Classrooms', [
            'classrooms' => $classrooms,
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
    public function store(StoreClassroom $request)
    {

        $List_Classes = $request->List_Classes;

        try {

            $validated = $request->validated();

            foreach ($List_Classes as $List_Class) {
                $My_Classes = new Classroom();
                $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
                $My_Classes->Grade_id = $List_Class['Grade_id'];
                $My_Classes->save();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom $classroom 
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClassroom $request)
    {
        try{
            $validated = $request->validated();
            $id = $request->id;
            $classroom = Classroom::findOrFail($id);

            $classroom->update([
                $classroom->Name_Class = ['ar' => $request->Name, 'en' => $request->Name_en],
                $classroom->Grade_id = $request->Grade_id,
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('classrooms.index');

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $classroom = Classroom::findOrFail($id)->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('classrooms.index');

    }

    public function delete_all(Request $request){
        $all_ids = $request->delete_all_id;

        $delete_all_ids = explode(',', $all_ids);

        Classroom::whereIn('id', $delete_all_ids)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('classrooms.index');

    }

    public function filter_classes(Request $request){

        $grades = Grade::all();

        $search = Classroom::select('*')->where('Grade_id', '=', $request->Grade_id)->get();

        return view('pages.Classrooms.Classrooms', [
            'grades' => $grades,
        ])->withDetails($search);
    }


}
