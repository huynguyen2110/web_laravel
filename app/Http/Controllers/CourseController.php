<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('q');
        $data = Course::where('name','like','%'.$search.'%')
            ->paginate(2);
        $data->appends(['q' => $search]);

        return view('course.index', [
            'data' => $data,
            'search' => $search,
        ]);

    }

    public function create()
    {
        return view('course.create');
    }

    public function store(StoreRequest $request)
    {
//        $object = new Course();
//        $object->fill($request->except('_token'));
//        $object->save();

        Course::create($request->validated());

        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        return view('course.edit', [
            'each' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *

     */
    public function update(UpdateRequest $request, Course $course)
    {

//        Course::where('id', $course->id)->update(
//            $request->except([
//                '_token',
//                '_method',
//            ])
//        );
        $course->update(
            $request->except([
                '_token',
                '_method',
            ])
        );


//        $course->fill($request->except(['_token','_method']));
//        $course->save();

        return redirect()->route('courses.index');
    }


    public function destroy(DestroyRequest $request, $course)
    {
//        $course->delete();
//        dd($course);
        Course::destroy($course);
//        Course::where('id', $course) ->delete();
        return redirect()->route('courses.index');
    }
}
