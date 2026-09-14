@extends('layouts.app')

@section('title', 'Locker - Smart Locker')

@section('content')

    {{-- HERO --}}
    <section class="page-hero assigned-hero">
        <div class="hero-blob hero-blob-top"></div>
        <div class="hero-blob hero-blob-bottom"></div>

        <div class="container page-hero-content">
            <span class="hero-badge">✅ LOCKER ASSIGNED</span>
            <h1>Your locker is ready</h1>
            <p>Enter the code below on the locker keypad to open it.</p>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,60 C240,100 480,20 720,40 C960,60 1200,100 1440,60 L1440,100 L0,100 Z"></path>
        </svg>
    </section>


    {{-- CODE CARD --}}
    <section class="container assigned-section">

        <div class="assigned-card">

            <div class="assigned-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect x="4" y="10" width="16" height="11" rx="2"></rect>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                </svg>
            </div>

            <span class="assigned-label">YOUR ONE-TIME CODE</span>

            <div class="code-display">
                <span>4</span><span>8</span><span>1</span>
                <span>9</span><span>2</span><span>6</span>
            </div>

            <p class="code-hint">This code is valid for one use only. Do not share it.</p>

            <div class="assigned-info">
                <div class="assigned-info-row">
                    <span>Locker</span>
                    <strong>Locker 1</strong>
                </div>
                <div class="assigned-info-row">
                    <span>Locker ID</span>
                    <strong>#1</strong>
                </div>
                <div class="assigned-info-row">
                    <span>Location</span>
                    <strong>ABC Mall</strong>
                </div>
                <div class="assigned-info-row">
                    <span>Status</span>
                    <strong>In Use</strong>
                </div>
                <div class="assigned-info-row">
                    <span>Expires</span>
                    <strong>2 hours from now</strong>
                </div>
            </div>

        </div>

        <div class="assigned-actions">
            <button class="confirm-btn secondary">Use Locker</button>
            <button class="confirm-btn danger">Release Locker</button>
        </div>

    </section>


    {{-- RELEASE SECTION --}}
    <section class="container confirm-section">

        <div class="confirm-card warning-card">

            <div class="confirm-card-header">
                <span class="confirm-label">RELEASE LOCKER</span>
                <span class="locker-status in-use">
                    <span></span>
                    In Use
                </span>
            </div>

            <div class="confirm-details">
                <div class="confirm-row">
                    <span>Locker</span>
                    <strong>Locker 1</strong>
                </div>
                <div class="confirm-row">
                    <span>Locker ID</span>
                    <strong>#1</strong>
                </div>
                <div class="confirm-row">
                    <span>Location</span>
                    <strong>ABC Mall</strong>
                </div>
                <div class="confirm-row">
                    <span>Assigned At</span>
                    <strong>Today · 14:32</strong>
                </div>
                <div class="confirm-row">
                    <span>Duration</span>
                    <strong>32 minutes</strong>
                </div>
            </div>

            <div class="warning-box">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 9v4"></path>
                    <path d="M12 17h.01"></path>
                    <path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"></path>
                </svg>
                <p>
                    Once released, the locker becomes available to others.
                    Any items left behind will be removed.
                </p>
            </div>

            <div class="confirm-actions">
                <button class="confirm-btn secondary">Cancel</button>
                <button class="confirm-btn danger">Confirm Release</button>
            </div>

        </div>

    </section>

@endsection