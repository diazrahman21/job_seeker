<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecruiterProfileController extends Controller
{
    /**
     * Show the form for editing the profile
     */
    public function edit()
    {
        $company = auth('recruiter')->user();
        return view('recruiter.profile.edit', compact('company'));
    }

    /**
     * Update the company profile
     */
    public function update(Request $request)
    {
        $company = auth('recruiter')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'url'],
            'location' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string', 'max:255'],
            'company_size' => ['required', 'in:1-10,11-50,51-200,201-500,500+'],
            'description' => ['nullable', 'string', 'max:2000'],
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:20'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo && Storage::exists($company->logo)) {
                Storage::delete($company->logo);
            }
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($validated);

        return back()->with('success', 'Profile perusahaan berhasil diperbarui.');
    }

    /**
     * Delete the company account
     */
    public function destroy()
    {
        $company = auth('recruiter')->user();
        $company->delete();

        return redirect('/')->with('success', 'Akun perusahaan berhasil dihapus.');
    }
}
