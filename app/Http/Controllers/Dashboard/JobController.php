<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\JobRequest;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::get();
        return view('dashboard.jobs.index', compact('jobs'));
    }


    public function create()
    {
        $jobs = Job::get();
        return view('dashboard.jobs.add',compact('jobs'));
    }

    public function store(JobRequest $request)
    {
        try {
            $job = new Job();
            $job->name = $request->name;

            $job->save();

            // Return a JSON response indicating success
            return response()->json(['success' => true, 'message' => 'تم أضافة الوظيفه بنجاح', 'job' => $job]);
        } catch (\Exception $e) {
            // Return a JSON response indicating failure
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء أضافة الوظيفه']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $job = Job::get();

        return view('dashboard.jobs.edit', ['job'=>$job  ]);
    }


    public function update(JobRequest $request)
    {
        try {
        $job = Job::findOrFail($request->id);
        $job->name = $request->name;
        $job->save();
        session()->flash('success', 'تم تعديل الوظيفه بنجاح');
        return redirect()->route('dashboard.jobs.index');
    }
    catch (\Exception $e) {
            // Return a JSON response indicating failure
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء حذف الوظيفه']);
        }
    
    }

    public function destroy(Request $request)
    {
        try {
            // Find the job grade by its ID and delete it
            Job::findOrFail($request->id)->delete();

            // Return a JSON response indicating success
            return response()->json(['success' => true, 'message' => 'تم حذف الوظيفه بنجاح']);
        } catch (\Exception $e) {
            // Return a JSON response indicating failure
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء حذف الوظيفه']);
        }
    }}
