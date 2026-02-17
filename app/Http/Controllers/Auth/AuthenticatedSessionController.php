<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Helpers\CaptchaHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        // Generate captcha baru
        CaptchaHelper::generate();
        
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi captcha
        if (!CaptchaHelper::validate($request->input('captcha'))) {
            CaptchaHelper::generate(); // Generate captcha baru
            return back()->withErrors(['captcha' => 'Kode CAPTCHA salah. Silakan coba lagi.'])->withInput($request->only('email', 'remember'));
        }
        
        $request->authenticate();

        $request->session()->regenerate();
        
        CaptchaHelper::clear();

        return redirect()->intended(route('beranda', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
