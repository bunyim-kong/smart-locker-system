@extends('layouts.app')

@section('title', 'Lockers - Smart Locker')

@section('content')

    {{-- HERO --}}
    <section class="page-hero">
        <div class="hero-blob hero-blob-top"></div>
        <div class="hero-blob hero-blob-bottom"></div>

        <div class="container page-hero-content">
            <span class="hero-badge">🔒 ABC MALL · LOCKER LIST</span>
            <h1>Available lockers</h1>
            <p>Select an available locker below to reserve it.</p>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,60 C240,100 480,20 720,40 C960,60 1200,100 1440,60 L1440,100 L0,100 Z"></path>
        </svg>
    </section>


    {{-- STATS + FILTERS + LIST --}}
    <section class="container location-detail-section">

        {{-- Stats --}}
        <div class="location-stats-grid">

            <div class="stat-card">
                <div class="stat-label available"><span></span>Available</div>
                <strong>8</strong>
            </div>

            <div class="stat-card">
                <div class="stat-label in-use"><span></span>In Use</div>
                <strong>3</strong>
            </div>

            <div class="stat-card">
                <div class="stat-label maintenance"><span></span>Maintenance</div>
                <strong>1</strong>
            </div>

            <div class="stat-card">
                <div class="stat-label locations"><span></span>Total Lockers</div>
                <strong>12</strong>
            </div>

        </div>


        {{-- Filters --}}
        <div class="lockers-filter-bar">
            <div class="filter-group">
                <span>Filter by size:</span>
                <button class="filter-chip active">All</button>
                <button class="filter-chip">Small</button>
                <button class="filter-chip">Medium</button>
                <button class="filter-chip">Large</button>
            </div>
            <div class="filter-group">
                <span>Status:</span>
                <button class="filter-chip active">All</button>
                <button class="filter-chip">Available</button>
                <button class="filter-chip">In Use</button>
            </div>
        </div>


        {{-- Locker grid --}}
        <div class="lockers-grid">

            <!-- Locker 1 - Available -->
            <article class="locker-card available">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 1</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status available"><span></span>Available</span>
                    <button class="locker-reserve-btn">Reserve</button>
                </div>
            </article>

            <!-- Locker 2 - Available -->
            <article class="locker-card available">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 2</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#2</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status available"><span></span>Available</span>
                    <button class="locker-reserve-btn">Reserve</button>
                </div>
            </article>

            <!-- Locker 3 - In Use -->
            <article class="locker-card in-use">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 3</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#3</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status in-use"><span></span>In Use</span>
                    <button class="locker-reserve-btn disabled" disabled>Unavailable</button>
                </div>
            </article>

            <!-- Locker 4 - Available -->
            <article class="locker-card available">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 4</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#4</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status available"><span></span>Available</span>
                    <button class="locker-reserve-btn">Reserve</button>
                </div>
            </article>

            <!-- Locker 5 - Maintenance -->
            <article class="locker-card maintenance">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 5</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#5</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status maintenance"><span></span>Maintenance</span>
                    <button class="locker-reserve-btn disabled" disabled>Unavailable</button>
                </div>
            </article>

            <!-- Locker 6 - Available -->
            <article class="locker-card available">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 6</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#6</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status available"><span></span>Available</span>
                    <button class="locker-reserve-btn">Reserve</button>
                </div>
            </article>

            <!-- Locker 7 - In Use -->
            <article class="locker-card in-use">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 7</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#7</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status in-use"><span></span>In Use</span>
                    <button class="locker-reserve-btn disabled" disabled>Unavailable</button>
                </div>
            </article>

            <!-- Locker 8 - Available -->
            <article class="locker-card available">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 8</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#8</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status available"><span></span>Available</span>
                    <button class="locker-reserve-btn">Reserve</button>
                </div>
            </article>

            <!-- Locker 9 - Available -->
            <article class="locker-card available">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 9</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#9</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status available"><span></span>Available</span>
                    <button class="locker-reserve-btn">Reserve</button>
                </div>
            </article>

            <!-- Locker 10 - In Use -->
            <article class="locker-card in-use">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 10</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#10</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status in-use"><span></span>In Use</span>
                    <button class="locker-reserve-btn disabled" disabled>Unavailable</button>
                </div>
            </article>

            <!-- Locker 11 - Available -->
            <article class="locker-card available">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 11</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#11</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status available"><span></span>Available</span>
                    <button class="locker-reserve-btn">Reserve</button>
                </div>
            </article>

            <!-- Locker 12 - Available -->
            <article class="locker-card available">
                <div class="locker-card-header">
                    <span class="locker-code">Locker 12</span>
                </div>
                <div class="locker-card-body">
                    <div class="locker-visual">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 3v18"></path>
                        </svg>
                    </div>
                    <div class="locker-info">
                        <div class="locker-info-row"><span>Locker ID</span><strong>#12</strong></div>
                        <div class="locker-info-row"><span>Location ID</span><strong>#1</strong></div>
                        <div class="locker-info-row"><span>Price</span><strong>Free first 2h</strong></div>
                    </div>
                </div>
                <div class="locker-card-footer">
                    <span class="locker-status available"><span></span>Available</span>
                    <button class="locker-reserve-btn">Reserve</button>
                </div>
            </article>

        </div>

    </section>

@endsection