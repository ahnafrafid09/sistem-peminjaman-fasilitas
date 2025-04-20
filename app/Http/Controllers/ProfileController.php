<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validated();

        // dd($user);

        $user->fill([
            'email' => $validated['email'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'alamat' => $validated['alamat'],
            'status' => $validated['status'],
        ]);

        // Reset verifikasi email jika berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Upload KTP jika ada
        if ($request->hasFile('ktp')) {
            $ktp = $request->file('ktp');
            $ktpName = time() . '_' . $ktp->getClientOriginalName();
            $ktpPath = $ktp->storeAs('images/ktp', $ktpName, 'public');

            $ktp = $request->file('ktp');
            $ktpName = time() . '_' . $ktp->getClientOriginalName();
            $ktp->storeAs('public/images/ktp', $ktpName);

            $user->foto_ktp = '/storage/' . $ktpPath;
            $user->ktp_name = $ktp->getClientOriginalName();
        }
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
