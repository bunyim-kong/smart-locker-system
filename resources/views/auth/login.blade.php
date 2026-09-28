@extends('layouts.auth')

@section('title', 'Log in')
@section('eyebrow', 'Your space awaits')
@section('heading', 'Sign in')
@section('description', 'Please enter your details to continue.')

@section('content')
    <form action="{{ route('login.store') }}" method="POST" class="flex flex-col gap-5">
        @csrf

        <div class="flex flex-col gap-1.5">
            <label for="email" class="text-sm font-medium text-[var(--color-heading)]">Email address <span aria-hidden="true" class="text-[var(--color-primary)]">*</span></label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email"
                placeholder="you@example.com"
                required
                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                class="h-11 w-full min-w-0 rounded-md border border-[var(--color-border)] bg-[var(--color-card)] px-2.5 py-1 text-base sm:text-sm text-[var(--color-heading)] transition-colors placeholder:text-[var(--color-muted)] hover:border-[var(--color-border-hover)] focus:border-[var(--color-primary)] focus:outline-none focus:ring-3 focus:ring-[var(--color-primary-soft)] aria-invalid:border-[var(--color-danger)]"
            >
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="password" class="text-sm font-medium text-[var(--color-heading)]">Password <span aria-hidden="true" class="text-[var(--color-primary)]">*</span></label>
            <div class="relative">
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                placeholder="Enter your password"
                required
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                class="pr-10 h-11 w-full min-w-0 rounded-md border border-[var(--color-border)] bg-[var(--color-card)] px-2.5 py-1 text-base sm:text-sm text-[var(--color-heading)] transition-colors placeholder:text-[var(--color-muted)] hover:border-[var(--color-border-hover)] focus:border-[var(--color-primary)] focus:outline-none focus:ring-3 focus:ring-[var(--color-primary-soft)] aria-invalid:border-[var(--color-danger)]"
            >
                <button type="button" data-password-toggle aria-controls="password" aria-label="Show password" aria-pressed="false" class="absolute inset-y-0 right-0 flex w-10 cursor-pointer items-center justify-center rounded-md text-[var(--color-body)] hover:text-[var(--color-primary)] focus-visible:outline-2 focus-visible:outline-[var(--color-primary)]">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="2"/>
                        <path d="M21 12c-2.4 4-5.4 6-9 6s-6.6-2-9-6c2.4-4 5.4-6 9-6s6.6 2 9 6Z"/>
                        <path data-eye-slash class="hidden" d="m3 3 18 18"/>
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" class="mt-1 flex w-full cursor-pointer items-center justify-center gap-3 rounded-md bg-[var(--color-btn-primary)] h-11 px-3 text-sm font-semibold text-[var(--color-btn-text)] transition-colors hover:bg-[var(--color-btn-primary-hover)] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[var(--color-primary)]">
            Sign in
        </button>
    </form>

    <p class="text-center text-sm">
        Don't have an account?
        <a href="{{ route('register') }}" class="rounded-sm font-semibold text-[var(--color-primary)] underline-offset-4 hover:text-[var(--color-primary-hover)] hover:underline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[var(--color-primary)]">Create an account</a>
    </p>
@endsection
