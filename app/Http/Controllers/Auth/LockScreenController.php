<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LockScreenController extends Controller
{
    public function showLockScreen()
    {
        return view('dashboard.admin.lockscreen');
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            // Password is correct, unlock the screen
            return redirect()->intended('/'); // Or wherever you want to redirect the user
        } else {
            // Password is incorrect
            return back()->withErrors(['password' => 'كلمة المرور غير صحيحة.']);
        }
    }
}

