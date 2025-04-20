<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\PasswordOtp;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Str;

class OtpForgotPasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;

        // Generate OTP
        $otp = random_int(100000, 999999);
        ; // Generate 6 digit random OTP

        // Save OTP to database
        PasswordOtp::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10), // OTP expired in 10 minutes
        ]);

        // Send OTP via email (Gunakan Mail::to untuk mengirimkan email)
        Mail::to($email)->send(new OtpMail($otp));

        // Return response to view
        return redirect()->back()->with('otp_sent', true);
    }

    // Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $otpRecord = PasswordOtp::where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'OTP tidak valid atau sudah kadaluarsa']);
        }

        // OTP valid, lanjutkan ke halaman reset password
        return redirect()->route('password.reset.custom', ['email' => $otpRecord->email]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Password berhasil diperbarui!');
    }
}
