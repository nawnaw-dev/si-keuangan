@extends('layouts.app')

@section('title', 'Koin Kene - Register')

@section('content')
<div class="min-h-screen bg-white flex items-center justify-center px-4">
  <div class="w-full max-w-md">
    <div class="rounded-2xl border border-white/20 bg-gradient-to-b from-[#123458] to-[#2770BE] backdrop-blur-md p-8 shadow-xl">

      <!-- Header -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-white">Koin Kene</h1>
        <p class="mt-2 text-sm text-white/80">Create your account</p>
      </div>

      <!-- Form -->
      <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Email -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-semibold text-white/90">Your Email</label>
          <input
            id="email"
            name="email"
            type="email"
            required
            autocomplete="off"
            class="mt-2 w-full rounded-lg border border-white/20 bg-[#D9D9D9] px-4 py-2 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400/30 outline-none"
            placeholder="your@gmail.com"
          />
          @error('email')
            <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-6">
          <label for="password" class="block text-sm font-semibold text-white/90">Your Password</label>
          <input
            id="password"
            name="password"
            type="password"
            required
            autocomplete="off"
            class="mt-2 w-full rounded-lg border border-white/20 bg-[#D9D9D9] px-4 py-2 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400/30 outline-none"
            placeholder="password"
          />
          @error('password')
            <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
          @enderror
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="w-full rounded-lg bg-[#2770BE] px-4 py-2.5 font-semibold text-white hover:bg-[#2364A8] focus:ring-2 focus:ring-blue-400/40"
        >
          Register
        </button>
      </form>

      <!-- Footer links -->
      <div class="mt-6 text-center">
        <p class="text-sm text-white/80">
          Already have an account?
          <a href="{{ route('login') }}" class="font-semibold text-white hover:text-gray-200 underline-offset-2 hover:underline">Sign in</a>
        </p>
      </div>

      <!-- Terms note -->
      <p class="mt-6 text-center text-xs text-white/60">
        By registering, you agree to Koin Kene Terms of Service
      </p>
    </div>
  </div>
</div>
@endsection
