@extends('layouts.app')

@section('tittle', 'Home - Smart Locker')

@section('content')
    <section class="hero-section">
        <div class="hero-blob hero-blob-top"></div>
        <div class="hero-blob hero-blob-bottom"></div>

        <svg class="wifi-decoration" viewBox="0 0 120 120" fill="none">
            <path d="M20 60a30 30 0 0 1 30 30" />
            <path d="M20 40a50 50 0 0 1 50 50" />
            <path d="M20 20a70 70 0 0 1 70 70" />
        </svg>

        <div class="hero-content">

            <span class="hero-badge">
                🚀 19 LOCKERS · 3 LOCATIONS · LIVE NOW
            </span>

            <h1>
                Find a locker.<br>
                <span>Store it. Forget it.</span>
            </h1>

            <p>
                Search nearby locations, see live locker availability,
                and reserve in seconds — no keys, no waiting.
            </p>

            <div class="search-wrapper">

                <div class="search-box">

                    <div class="search-input-wrapper">
                        <svg viewBox="0 0 24 24" fill="none">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="M21 21l-4.3-4.3"></path>
                        </svg>

                        <input
                            type="text"
                            placeholder="Search by location name, city, or address..."
                        >
                    </div>

                    <button class="primary-button">
                        Search
                    </button>

                </div>

                <div class="quick-filters">
                    <span>Popular:</span>

                    <button>Near me</button>
                    <button>ABC Mall</button>
                    <button>Central Station</button>
                    <button>City Library</button>
                </div>

            </div>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,60 C240,100 480,20 720,40 C960,60 1200,100 1440,60 L1440,100 L0,100 Z"></path>
        </svg>
    </section>

    <section class="stats-section">

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-label available">
                    <span></span>
                    Available
                </div>
                <strong>12</strong>
            </div>

            <div class="stat-card">
                <div class="stat-label in-use">
                    <span></span>
                    In Use
                </div>
                <strong>5</strong>
            </div>

            <div class="stat-card">
                <div class="stat-label maintenance">
                    <span></span>
                    Maintenance
                </div>
                <strong>2</strong>
            </div>

            <div class="stat-card">
                <div class="stat-label locations">
                    <span></span>
                    Locations
                </div>
                <strong>3</strong>
            </div>

        </div>

    </section>

    <section class="locations-section">

        <div class="section-heading">

            <div>
                <span class="section-label">LOCATIONS</span>
                <h2>Locations near you</h2>
                <p>Showing 3 nearby locker stations</p>
            </div>

            <div class="sort-wrapper">
                <span>Sort:</span>

                <select>
                    <option>Nearest</option>
                    <option>Most available</option>
                    <option>A-Z</option>
                </select>
            </div>

        </div>


        <div class="location-list">

            <!-- ABC Mall -->
            <article class="location-card">

                <div class="location-main">

                    <div class="location-header">

                        <div class="location-title">

                            <div class="location-icon">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="2.5"></circle>
                                </svg>
                            </div>

                            <div>
                                <h3>ABC Mall</h3>
                                <p>123 Main St. · 0.8 km away</p>
                            </div>

                        </div>

                        <span class="status-badge open">
                            <span></span>
                            Open
                        </span>

                    </div>


                    <div class="locker-pills">

                        <span class="locker-pill available">
                            <span></span>
                            8 Available
                        </span>

                        <span class="locker-pill in-use">
                            <span></span>
                            3 In Use
                        </span>

                        <span class="locker-pill maintenance">
                            <span></span>
                            1 Maintenance
                        </span>

                    </div>


                    <div class="availability">

                        <div class="availability-info">
                            <span>Availability</span>
                            <strong>8 / 12 lockers free</strong>
                        </div>

                        <div class="progress-bar">
                            <div style="width: 67%;"></div>
                        </div>

                    </div>

                </div>


                <div class="location-action">

                    <span>Starting from</span>

                    <strong>Free</strong>

                    <small>first 2 hours</small>

                    <a href="/locations/abc-mall" class="location-button">
                        View Lockers
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14"></path>
                            <path d="m13 6 6 6-6 6"></path>
                        </svg>
                    </a>

                </div>

            </article>


            <!-- City Library -->
            <article class="location-card">

                <div class="location-main">

                    <div class="location-header">

                        <div class="location-title">

                            <div class="location-icon">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="2.5"></circle>
                                </svg>
                            </div>

                            <div>
                                <h3>City Library</h3>
                                <p>45 Park Ave. · 1.4 km away</p>
                            </div>

                        </div>

                        <span class="status-badge full">
                            <span></span>
                            Full
                        </span>

                    </div>


                    <div class="locker-pills">

                        <span class="locker-pill available">
                            <span></span>
                            0 Available
                        </span>

                        <span class="locker-pill in-use">
                            <span></span>
                            4 In Use
                        </span>

                    </div>


                    <div class="availability">

                        <div class="availability-info">
                            <span>Availability</span>
                            <strong>0 / 4 lockers free</strong>
                        </div>

                        <div class="progress-bar">
                            <div class="empty" style="width: 0%;"></div>
                        </div>

                    </div>

                </div>


                <div class="location-action">

                    <span>Starting from</span>

                    <strong>Free</strong>

                    <small>first 2 hours</small>

                    <button class="location-button disabled" disabled>
                        Notify Me
                    </button>

                </div>

            </article>


            <!-- Central Station -->
            <article class="location-card">

                <div class="location-main">

                    <div class="location-header">

                        <div class="location-title">

                            <div class="location-icon">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="2.5"></circle>
                                </svg>
                            </div>

                            <div>
                                <h3>Central Station</h3>
                                <p>8 Railway Rd. · 2.1 km away</p>
                            </div>

                        </div>

                        <span class="status-badge maintenance">
                            <span></span>
                            Maintenance
                        </span>

                    </div>


                    <div class="locker-pills">

                        <span class="locker-pill available">
                            <span></span>
                            4 Available
                        </span>

                        <span class="locker-pill in-use">
                            <span></span>
                            2 In Use
                        </span>

                        <span class="locker-pill maintenance">
                            <span></span>
                            1 Maintenance
                        </span>

                    </div>


                    <div class="availability">

                        <div class="availability-info">
                            <span>Availability</span>
                            <strong>4 / 7 lockers free</strong>
                        </div>

                        <div class="progress-bar">
                            <div style="width: 57%;"></div>
                        </div>

                    </div>

                </div>


                <div class="location-action">

                    <span>Starting from</span>

                    <strong>Free</strong>

                    <small>first 2 hours</small>

                    <a href="/locations/central-station" class="location-button">
                        View Lockers
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14"></path>
                            <path d="m13 6 6 6-6 6"></path>
                        </svg>
                    </a>

                </div>

            </article>

        </div>


        <div class="view-all">
            <a href="/locations">
                View all locations

                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M5 12h14"></path>
                    <path d="m13 6 6 6-6 6"></path>
                </svg>
            </a>
        </div>

    </section>

    <section class="map-section">

        <div class="map-container">

            <div class="map-content">

                <span class="section-label light">
                    📍 LIVE MAP
                </span>

                <h2>See every locker on the map</h2>

                <p>
                    Zoom in on any location to see individual lockers,
                    their size, and current status — all in real time.
                </p>

                <ul>

                    <li>
                        <span>✓</span>
                        Pinpoint exact locker position
                    </li>

                    <li>
                        <span>✓</span>
                        Filter by size (small, medium, large)
                    </li>

                    <li>
                        <span>✓</span>
                        Reserve from the map instantly
                    </li>

                </ul>

            </div>


            <div class="map-preview">

                <div class="map-grid"></div>

                <div class="map-road horizontal"></div>
                <div class="map-road vertical"></div>

                <div class="map-pin pin-blue"></div>
                <div class="map-pin pin-green"></div>
                <div class="map-pin pin-yellow"></div>

                <div class="map-popup">

                    <div class="popup-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"></path>
                            <circle cx="12" cy="10" r="2.5"></circle>
                        </svg>
                    </div>

                    <div class="popup-info">
                        <strong>ABC Mall</strong>
                        <span>8 of 12 lockers available</span>
                    </div>

                    <a href="/locations/abc-mall">
                        Open →
                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class="how-section">

        <div class="how-heading">

            <span class="section-label">
                HOW IT WORKS
            </span>

            <h2>Three taps and you're done</h2>

            <p>
                No app download. No account needed for one-time use.
            </p>

        </div>


        <div class="steps-grid">

            <article class="step-card">

                <div class="step-number">
                    1
                </div>

                <h3>Find a Locker</h3>

                <p>
                    Search by location or use the map to spot
                    the closest available locker.
                </p>

            </article>


            <article class="step-card">

                <div class="step-number">
                    2
                </div>

                <h3>Get Your Code</h3>

                <p>
                    Reserve the locker and receive a 6-digit
                    one-time code instantly.
                </p>

            </article>


            <article class="step-card">

                <div class="step-number">
                    3
                </div>

                <h3>Store & Go</h3>

                <p>
                    Enter the code on the locker keypad,
                    drop your stuff, and go.
                </p>

            </article>

        </div>


        <div class="guide-button">
            <a href="/how-to-use">
                Read the full guide

                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M5 12h14"></path>
                    <path d="m13 6 6 6-6 6"></path>
                </svg>
            </a>
        </div>

    </section>

    <section class="trust-section">

        <div class="trust-grid">

            <div class="trust-card">

                <div class="trust-icon green">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 3 20 6v5c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-3Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </div>

                <div>
                    <strong>Encrypted Codes</strong>
                    <span>One-time use only</span>
                </div>

            </div>


            <div class="trust-card">

                <div class="trust-icon blue">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                </div>

                <div>
                    <strong>24/7 Access</strong>
                    <span>Anytime, any day</span>
                </div>

            </div>


            <div class="trust-card">

                <div class="trust-icon yellow">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="m8 12 2.5 2.5L16 9"></path>
                    </svg>
                </div>

                <div>
                    <strong>Free First 2 Hours</strong>
                    <span>No card required</span>
                </div>

            </div>

        </div>

    </section>
@endsection