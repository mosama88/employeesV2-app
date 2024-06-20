<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // تحديث كلمة المرور
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        // إعداد جلسة رسالة النجاح
        return back()->with('success', 'تم تغيير كلمة المرور بنجاح.');
    }
}
