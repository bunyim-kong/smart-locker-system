@extends('layouts.admin')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/pages/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="dash">
        <div class="dash-container">
            {{-- Stat cards --}}
            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">TOTAL LOCKERS</span>
                        <span class="stat-badge badge-success">+8 this month</span>
                    </div>
                    <div class="stat-value">2,480</div>
                    <div class="stat-sub">Across 12 locations</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">ACTIVE USERS</span>
                        <span class="stat-badge badge-success">+124 this month</span>
                    </div>
                    <div class="stat-value">1,847</div>
                    <div class="stat-sub">Currently registered</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">UTILIZATION RATE</span>
                        <span class="stat-badge badge-warning">-2.1% vs last month</span>
                    </div>
                    <div class="stat-value">78.4%</div>
                    <div class="stat-sub">Avg. across locations</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">OPEN TICKETS</span>
                        <span class="stat-badge badge-danger">5 urgent</span>
                    </div>
                    <div class="stat-value">23</div>
                    <div class="stat-sub">Maintenance requests</div>
                </div>
            </div>

            {{-- Chart + Recent Activity --}}
            <div class="mid-grid">

                {{-- Locker Utilization chart --}}
                <div class="panel">
                    <h2 class="panel-title">Locker Utilization</h2>
                    <p class="panel-sub">Average occupancy rate over the past 7 days</p>

                    <div class="chart-wrap">
                        <svg viewBox="0 0 700 260" preserveAspectRatio="none">
                            @foreach ([0, 25, 50, 75, 100] as $i => $pct)
                                <line x1="40" y1="{{ 230 - $i * 50 }}" x2="700" y2="{{ 230 - $i * 50 }}"
                                    stroke="var(--color-border)" stroke-dasharray="4 4" stroke-width="1" />
                                <text x="0" y="{{ 234 - $i * 50 }}" fill="var(--color-muted)" font-size="11">{{ $pct }}%</text>
                            @endforeach

                            <path d="M40,80 L120,72 L200,65 L280,60 L360,75 L440,80 L520,63 L600,72 L680,58 L680,230 L40,230 Z"
                                fill="var(--color-primary-light)" opacity="0.9" />

                            <polyline
                                points="40,80 120,72 200,65 280,60 360,75 440,80 520,63 600,72 680,58"
                                fill="none" stroke="var(--color-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />

                            @foreach ([[40,80],[120,72],[200,65],[280,60],[360,75],[440,80],[520,63],[600,72],[680,58]] as $p)
                                <circle cx="{{ $p[0] }}" cy="{{ $p[1] }}" r="3.5" fill="var(--color-primary)" />
                            @endforeach

                            @foreach (['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $i => $day)
                                <text x="{{ 120 + $i * 90 }}" y="252" text-anchor="middle" fill="var(--color-muted)" font-size="11">{{ $day }}</text>
                            @endforeach
                        </svg>
                    </div>
                </div>

                {{-- Recent Activity --}}
                <div class="panel">
                    <h2 class="panel-title">Recent Activity</h2>

                    <ul class="activity-list">
                        @php
                            $activity = [
                                ['color' => 'dot-primary', 'text' => 'Locker B-14 assigned to Maya Chen', 'time' => '2 min ago'],
                                ['color' => 'dot-success', 'text' => 'Maintenance ticket #2847 resolved',  'time' => '15 min ago'],
                                ['color' => 'dot-primary', 'text' => 'New user registered: Tom Reeves',    'time' => '45 min ago'],
                                ['color' => 'dot-muted',   'text' => 'Location Downtown Hub updated',      'time' => '1 hour ago'],
                                ['color' => 'dot-danger',  'text' => 'Locker A-07 flagged for repair',     'time' => '3 hours ago'],
                            ];
                        @endphp

                        @foreach ($activity as $item)
                            <li class="activity-item">
                                <span class="activity-dot {{ $item['color'] }}"></span>
                                <div>
                                    <p class="activity-text">{{ $item['text'] }}</p>
                                    <p class="activity-time">{{ $item['time'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Locations Overview table --}}
            <div class="panel">
                <h2 class="panel-title">Locations Overview</h2>

                <div class="table-wrap">
                    <table class="loc-table">
                        <thead>
                            <tr>
                                <th>LOCATION NAME</th>
                                <th>ADDRESS</th>
                                <th>TOTAL</th>
                                <th>IN USE</th>
                                <th>AVAILABLE</th>
                                <th>UTILIZATION %</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $locations = [
                                    ['name' => 'Downtown Hub', 'address' => '102 Broadway, Suite A', 'total' => 450, 'in_use' => 380, 'available' => 70, 'utilization' => 84.4, 'status' => 'Active'],
                                    ['name' => 'Westside Plaza', 'address' => '4050 Grand Ave, Lobby', 'total' => 320, 'in_use' => 290, 'available' => 30, 'utilization' => 90.6, 'status' => 'Active'],
                                    ['name' => 'Tech District', 'address' => '18 Innovation Way', 'total' => 600, 'in_use' => 420, 'available' => 180, 'utilization' => 70.0, 'status' => 'Active'],
                                    ['name' => 'Metro Transit Center', 'address' => '82 Station Square', 'total' => 510, 'in_use' => 310, 'available' => 200, 'utilization' => 60.7, 'status' => 'Maintenance'],
                                    ['name' => 'Southside Campus', 'address' => '12 College Dr, Hall C', 'total' => 600, 'in_use' => 510, 'available' => 90, 'utilization' => 85.0, 'status' => 'Active'],
                                ];
                            @endphp

                            @foreach ($locations as $loc)
                                <tr>
                                    <td class="loc-name">{{ $loc['name'] }}</td>
                                    <td class="loc-address">{{ $loc['address'] }}</td>
                                    <td>{{ $loc['total'] }}</td>
                                    <td>{{ $loc['in_use'] }}</td>
                                    <td class="loc-address">{{ $loc['available'] }}</td>
                                    <td>
                                        <div class="util-cell">
                                            <span class="util-pct">{{ number_format($loc['utilization'], 1) }}%</span>
                                            <span class="util-bar">
                                                <span class="util-bar-fill" style="width: {{ $loc['utilization'] }}%"></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($loc['status'] === 'Active')
                                            <span class="status-pill status-active">Active</span>
                                        @else
                                            <span class="status-pill status-maintenance">Maintenance</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    
</body>
</html>


@endsection