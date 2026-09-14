@extends('layouts.app')

@section('title', 'Locations - Smart Locker')

@section('content')
    <section class="page-hero">
        <div class="hero-blob hero-blob-top"></div>
        <div class="hero-blob hero-blob-bottom"></div>

        <div class="container page-hero-content">
            <span class="hero-badge">
                📍 3 LOCATIONS · LIVE AVAILABILITY
            </span>

            <h1>
                All Locations
            </h1>

            <p>
                Browse every Smart Locker location, check live availability,
                and reserve your locker in seconds.
            </p>
        </div>

        <svg class="hero-wave" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,60 C240,100 480,20 720,40 C960,60 1200,100 1440,60 L1440,100 L0,100 Z"></path>
        </svg>
    </section>

    <section class="container locations-section">

        <div class="section-heading">

            <div>
                <span class="section-label">LOCATIONS</span>
                <h2>All locations</h2>
                <p>3 locations available across the city</p>
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

                    <a href="/location-detail" class="location-button">
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

                    <a href="/location-detail" class="location-button">
                        View Lockers
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14"></path>
                            <path d="m13 6 6 6-6 6"></path>
                        </svg>
                    </a>
                </div>
            </article>

        </div>

    </section>
@endsection