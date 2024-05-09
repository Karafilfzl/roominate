<?php
// Inside app/Http/Controllers/CourseController.php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function show($id)
    {
        return Course::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $course = Course::create($validated);
        return response()->json(course, 201);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return response()->json(course, 200);
    }

    public function destroy($id)
    {
        Course::destroy(id);
        return response()->json(null, 204);
    }
}
