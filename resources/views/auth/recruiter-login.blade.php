@extends('layouts.app')
@section('content')
<div class="mx-auto max-w-md mt-12">
    <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm hover:shadow-md transition-all duration-200">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Login Rekruter</h1>
            <p class="text-slate-600 mt-2">Masuk ke akun perusahaan Anda</p>
        </div>
        
        <form method="post" action="{{ route('recruiter.login') }}" class="space-y-5">
            @csrf
            
            <x-input 
                name="email" 
                type="email"
                label="Email"
                placeholder="your@company.com" 
                :error="$errors->first('email')"
                required
            />
            
            <x-input 
                name="password" 
                type="password"
                label="Password"
                placeholder="••••••••" 
                :error="$errors->first('password')"
                required
            />
            
            <x-button type="submit" variant="primary" size="lg" class="w-full">
                <span class="flex items-center gap-2 justify-center">
                    <x-icon name="arrow-right-on-rectangle" class="w-5 h-5" />
                    Masuk
                </span>
            </x-button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-slate-600">Belum punya akun? 
                <a href="{{ route('recruiter.register') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                    Daftar di sini
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
