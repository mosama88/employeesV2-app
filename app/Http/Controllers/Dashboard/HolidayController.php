<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HolidayRequest;

class HolidayController extends Controller
{

    public function index()
    {
        $holidays = Holiday::orderBy('created_at', 'desc')->get();
        return view('dashboard.holidays.index', compact('holidays'));
    }

    public function create()
    {
        return view('dashboard.holidays.add',);
    }

    public function store(HolidayRequest $request)
    {
        try{
            $holiday = new Holiday();
            $holiday->name = $request->name;
            $holiday->from = $request->from;
            $holiday->to = $request->to;
            $holiday->save();
            session()->flash('success', 'تم أضافة العطلة بنجاح');
            return redirect()->route('dashboard.holidays.index');
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $holiday = Holiday::find($id);
        return view('dashboard.holidays.edit', ['holiday'=>$holiday ]);
    }


    public function update(HolidayRequest $request)
    {
        $holiday = Holiday::findOrFail($request->id);
        $holiday->name = $request->name;
        $holiday->from = $request->from;
        $holiday->to = $request->to;
        $holiday->save();
        session()->flash('success', 'تم تعديل العطلة بنجاح');
        return redirect()->route('dashboard.holidays.index');
    }



    public function destroy(Request $request, $id)
{
    try {
        Holiday::findOrFail($request->id)->delete();
        return response()->json(['success' => 'Holiday deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to delete holiday', 'message' => $e->getMessage()], 500);
    }
}

}
