@extends('layouts.app')

@section('title', 'My Profile - Smart Locker')

@section('content')
<section class="mx-auto w-full max-w-2xl px-6 pt-[130px] pb-20 max-md:px-5">

    <div class="rounded-2xl border-2 border-[var(--color-border)] bg-[var(--color-card)] p-8 shadow-[0_8px_25px_rgba(15,23,42,0.05)]">

        <div class="flex flex-col items-center text-center">
            <span class="flex h-20 w-20 items-center justify-center rounded-full bg-[var(--color-heading)] text-2xl font-semibold text-white">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) }}
            </span>

            <h1 class="mt-4 text-xl font-extrabold text-[var(--color-heading)]">
                {{ auth()->user()->name }}
            </h1>

            <p class="mt-1 text-sm text-[var(--color-muted)]">
                {{ auth()->user()->email }}
            </p>

            <span class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-[var(--color-primary-light)] px-3 py-1 text-xs font-bold text-[var(--color-primary)]">
                {{ auth()->user()->isAdmin() ? 'Admin' : 'User' }}
            </span>
        </div>

        <div class="mt-8 border-t border-[var(--color-border)] pt-6">
            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-[var(--color-muted)]">Name</dt>
                    <dd class="mt-1 font-semibold text-[var(--color-heading)]">{{ auth()->user()->name }}</dd>
                </div>
                <div>
                    <dt class="text-[var(--color-muted)]">Email</dt>
                    <dd class="mt-1 font-semibold text-[var(--color-heading)]">{{ auth()->user()->email }}</dd>
                </div>
                <div>
                    <dt class="text-[var(--color-muted)]">Member since</dt>
                    <dd class="mt-1 font-semibold text-[var(--color-heading)]">{{ auth()->user()->created_at->format('M d, Y') }}</dd>
                </div>
            </dl>
        </div>

        <form action="{{ route('user.logout') }}" method="POST" class="mt-8">
            @csrf
            <button type="submit"
                class="flex w-full items-center justify-center gap-2 rounded-[10px] border-0 bg-[var(--color-danger)] px-4 py-3 text-sm font-semibold text-white transition duration-200 hover:opacity-90">
                <svg class="h-4 w-4 stroke-current stroke-2" viewBox="0 0 24 24" fill="none">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <path d="M16 17l5-5-5-5"></path>
                    <path d="M21 12H9"></path>
                </svg>
                Log out
            </button>
        </form>

    </div>
</section>
@endsection