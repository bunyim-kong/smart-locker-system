<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Locker System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            500: '#0d6efd',
                            600: '#0b5ed7',
                            700: '#0a53be',
                            900: '#0a2a5e',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">

    <!-- ================= NAVBAR ================= -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-lg bg-brand-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <path d="M12 4v16M3 10h18M3 15h18"/>
                    </svg>
                </div>
                <div class="leading-none">
                    <span class="font-extrabold text-brand-900 text-lg">SMART</span>
                    <span class="font-extrabold text-brand-500 text-lg">LOCKER</span>
                    <p class="text-[10px] tracking-[0.3em] text-brand-500 font-semibold">SYSTEM</p>
                </div>
            </a>

            <!-- Nav links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="#" class="hover:text-brand-600">Home</a>
                <a href="#locations" class="hover:text-brand-600">Locations</a>
                <a href="#flow" class="hover:text-brand-600">How it Works</a>
                <a href="#history" class="hover:text-brand-600">History</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="#login" class="text-sm font-medium text-brand-600 hover:text-brand-700">Login</a>
                <a href="#register" class="bg-brand-500 hover:bg-brand-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Register
                </a>
            </div>
        </div>
    </header>

    <!-- ================= HERO ================= -->
    <section class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <span class="inline-block text-xs font-semibold tracking-wider text-brand-600 bg-brand-50 px-3 py-1 rounded-full mb-4">
                SMART LOCKER SYSTEM
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-brand-900 leading-tight">
                Secure. Smart.<br>
                <span class="text-brand-500">Always Available.</span>
            </h1>
            <p class="mt-5 text-slate-600 leading-relaxed">
                Find the nearest locker, reserve it in seconds, and unlock it with a unique code. 
                Simple, safe, and fully automated.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#register" class="bg-brand-500 hover:bg-brand-600 text-white font-medium px-6 py-3 rounded-lg transition">
                    Get Started
                </a>
                <a href="#locations" class="border border-slate-300 hover:border-brand-500 hover:text-brand-600 font-medium px-6 py-3 rounded-lg transition">
                    Find a Locker
                </a>
            </div>
        </div>

        <!-- Locker illustration (pure SVG, no external image) -->
        <div class="relative">
            <div class="absolute -inset-6 bg-brand-100 rounded-full blur-3xl opacity-40"></div>
            <svg viewBox="0 0 400 320" class="relative w-full drop-shadow-xl">
                <rect x="120" y="60" width="160" height="220" rx="12" fill="#0b5ed7"/>
                <rect x="128" y="68" width="144" height="204" rx="8" fill="#e8f0fe"/>
                <!-- doors grid -->
                <g fill="#ffffff" stroke="#cbd5e1" stroke-width="1.5">
                    <rect x="140" y="80" width="55" height="55" rx="4"/>
                    <rect x="205" y="80" width="55" height="55" rx="4"/>
                    <rect x="140" y="145" width="55" height="55" rx="4"/>
                    <rect x="140" y="210" width="55" height="55" rx="4"/>
                </g>
                <!-- open door with box -->
                <rect x="205" y="145" width="55" height="55" rx="4" fill="#0d6efd"/>
                <rect x="215" y="165" width="35" height="25" rx="3" fill="#fbbf24"/>
                <!-- keypad -->
                <rect x="215" y="90" width="35" height="35" rx="4" fill="#0a2a5e"/>
                <circle cx="232" cy="100" r="3" fill="#22c55e"/>
                <g fill="#94a3b8">
                    <circle cx="225" cy="110" r="2"/>
                    <circle cx="232" cy="110" r="2"/>
                    <circle cx="239" cy="110" r="2"/>
                    <circle cx="225" cy="117" r="2"/>
                    <circle cx="232" cy="117" r="2"/>
                    <circle cx="239" cy="117" r="2"/>
                </g>
                <!-- wifi waves -->
                <g fill="none" stroke="#0d6efd" stroke-width="4" stroke-linecap="round">
                    <path d="M290 100 a20 20 0 0 1 20 20"/>
                    <path d="M290 88 a32 32 0 0 1 32 32"/>
                    <path d="M290 76 a44 44 0 0 1 44 44"/>
                </g>
                <!-- map pin -->
                <g transform="translate(60,140)">
                    <path d="M20 0 C9 0 0 9 0 20 c0 14 20 36 20 36 s20 -22 20 -36 C40 9 31 0 20 0z" fill="#0d6efd"/>
                    <circle cx="20" cy="20" r="7" fill="#ffffff"/>
                </g>
            </svg>
        </div>
    </section>

    <!-- ================= HOW IT WORKS (Flow) ================= -->
    <section id="flow" class="max-w-6xl mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-brand-900">How It Works</h2>
            <p class="text-slate-600 mt-2">From opening the app to releasing your locker — a smooth journey.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Step cards -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 font-bold flex items-center justify-center mb-4">1</div>
                <h3 class="font-bold text-brand-900 mb-1">Register / Login</h3>
                <p class="text-sm text-slate-600">Create an account or sign in to access the dashboard.</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 font-bold flex items-center justify-center mb-4">2</div>
                <h3 class="font-bold text-brand-900 mb-1">Search Location</h3>
                <p class="text-sm text-slate-600">Pick a location by name, address, or map view.</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 font-bold flex items-center justify-center mb-4">3</div>
                <h3 class="font-bold text-brand-900 mb-1">Select Locker</h3>
                <p class="text-sm text-slate-600">Choose an available locker and confirm reservation.</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 font-bold flex items-center justify-center mb-4">4</div>
                <h3 class="font-bold text-brand-900 mb-1">Use Locker</h3>
                <p class="text-sm text-slate-600">Enter your unique code and unlock your locker.</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 font-bold flex items-center justify-center mb-4">5</div>
                <h3 class="font-bold text-brand-900 mb-1">Release Locker</h3>
                <p class="text-sm text-slate-600">Confirm release — locker becomes available again.</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 font-bold flex items-center justify-center mb-4">6</div>
                <h3 class="font-bold text-brand-900 mb-1">Usage History</h3>
                <p class="text-sm text-slate-600">Review all your past locker sessions anytime.</p>
            </div>
        </div>
    </section>

    <!-- ================= DASHBOARD PREVIEW ================= -->
    <section class="bg-white border-y border-slate-200">
        <div class="max-w-6xl mx-auto px-6 py-16">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-brand-900">Dashboard Preview</h2>
                <p class="text-slate-600 mt-2">Your control center for every locker.</p>
            </div>

            <div class="bg-slate-50 rounded-2xl border border-slate-200 p-6">
                <!-- Top stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-xl border border-slate-200 p-4">
                        <p class="text-xs text-slate-500">Available</p>
                        <p class="text-2xl font-bold text-green-600">12</p>
                    </div>
                    <div class="bg-white rounded-xl border border-slate-200 p-4">
                        <p class="text-xs text-slate-500">In Use</p>
                        <p class="text-2xl font-bold text-red-500">5</p>
                    </div>
                    <div class="bg-white rounded-xl border border-slate-200 p-4">
                        <p class="text-xs text-slate-500">Maintenance</p>
                        <p class="text-2xl font-bold text-amber-500">2</p>
                    </div>
                    <div class="bg-white rounded-xl border border-slate-200 p-4">
                        <p class="text-xs text-slate-500">Total Lockers</p>
                        <p class="text-2xl font-bold text-brand-600">19</p>
                    </div>
                </div>

                <!-- Locations table -->
                <div id="locations" class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-100 text-slate-600 text-left">
                            <tr>
                                <th class="px-4 py-3 font-semibold">Location</th>
                                <th class="px-4 py-3 font-semibold">Address</th>
                                <th class="px-4 py-3 font-semibold">Availability</th>
                                <th class="px-4 py-3 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr>
                                <td class="px-4 py-3 font-medium text-brand-900">ABC Mall</td>
                                <td class="px-4 py-3 text-slate-600">123 Main St.</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-2 text-green-600">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span> Available
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="#" class="text-brand-600 hover:underline font-medium">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-medium text-brand-900">City Library</td>
                                <td class="px-4 py-3 text-slate-600">45 Park Ave.</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-2 text-red-500">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span> In Use
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="#" class="text-brand-600 hover:underline font-medium">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-medium text-brand-900">Central Station</td>
                                <td class="px-4 py-3 text-slate-600">8 Railway Rd.</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-2 text-amber-500">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span> Maintenance
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="#" class="text-brand-600 hover:underline font-medium">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= ASSIGNED LOCKER + RELEASE ================= -->
    <section class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-8">
        <!-- Assigned locker card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h3 class="font-bold text-brand-900 text-lg mb-4">Locker Assigned</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-500">Locker</span>
                    <span class="font-semibold text-brand-900">L-023</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Locker Code</span>
                    <span class="font-mono font-semibold tracking-widest text-brand-600">XXXXXX</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Location</span>
                    <span class="font-semibold text-brand-900">ABC Mall</span>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button class="flex-1 bg-brand-500 hover:bg-brand-600 text-white text-sm font-medium py-2.5 rounded-lg transition">
                    Unlock
                </button>
                <button class="flex-1 border border-slate-300 hover:border-red-400 hover:text-red-500 text-slate-700 text-sm font-medium py-2.5 rounded-lg transition">
                    Release
                </button>
            </div>
        </div>

        <!-- Usage history -->
        <div id="history" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h3 class="font-bold text-brand-900 text-lg mb-4">Usage History</h3>
            <ul class="divide-y divide-slate-100 text-sm">
                <li class="py-3 flex justify-between">
                    <div>
                        <p class="font-medium text-brand-900">L-023 · ABC Mall</p>
                        <p class="text-xs text-slate-500">Sep 12, 2026 · 10:24 AM</p>
                    </div>
                    <span class="text-green-600 font-medium">Released</span>
                </li>
                <li class="py-3 flex justify-between">
                    <div>
                        <p class="font-medium text-brand-900">L-011 · City Library</p>
                        <p class="text-xs text-slate-500">Sep 10, 2026 · 02:11 PM</p>
                    </div>
                    <span class="text-green-600 font-medium">Released</span>
                </li>
                <li class="py-3 flex justify-between">
                    <div>
                        <p class="font-medium text-brand-900">L-008 · Central Station</p>
                        <p class="text-xs text-slate-500">Sep 08, 2026 · 08:45 AM</p>
                    </div>
                    <span class="text-green-600 font-medium">Released</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-brand-900 text-slate-300">
        <div class="max-w-6xl mx-auto px-6 py-10 flex flex-col md:flex-row justify-between gap-6">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="font-extrabold text-white text-lg">SMART</span>
                    <span class="font-extrabold text-brand-500 text-lg">LOCKER</span>
                </div>
                <p class="text-xs tracking-[0.3em] text-brand-500 font-semibold">SYSTEM</p>
            </div>
            <div class="flex gap-8 text-sm">
                <a href="#" class="hover:text-white">Help</a>
                <a href="#" class="hover:text-white">Privacy</a>
                <a href="#" class="hover:text-white">Terms</a>
            </div>
        </div>
        <div class="border-t border-brand-700">
            <p class="max-w-6xl mx-auto px-6 py-4 text-xs text-slate-400">© 2026 Smart Locker System. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>