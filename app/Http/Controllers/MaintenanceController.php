<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Locker;
use App\Models\Maintenance;

class MaintenanceController extends Controller
{
    public function index()
    {
        // locker and user are the relationships defined in the Maintenance model
        $maintenance = Maintenance::with(['locker', 'user'])->latest('id')->get();

        return view('admin.maintenances.index', compact('maintenance'));
    }

    public function create()
    {
        $lockers = Locker::all();

        return view('admin.maintenances.create', compact('lockers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        // user_id is in model's $fillable

        Maintenance::create($validated);

        return redirect()->route('maintenances.index')
            ->with('success', 'Maintenance created successfully.');
    }

    public function show(Maintenance $maintenance)
    {
        $maintenance->load(['locker', 'user']);
        return view('admin.maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        $lockers = Locker::all();

        return view('admin.maintenances.edit', compact('maintenance', 'lockers'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate($this->rules());

        $maintenance->update($validated);

        return redirect()->route('maintenances.index')
            ->with('success', 'Maintenance updated successfully.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenances.index')
            ->with('success', 'Maintenance deleted successfully.');
    }

    private function rules(): array
    {
        return [
            // Rule::exists with the model uses the Locker model's real table name
            'locker_id'    => ['required', Rule::exists(Locker::class, 'id')],
            'issue_des'    => ['required', 'string', 'max:1000'],
            'report_date'  => ['required', 'date'],
            'resolve_date' => ['required', 'date', 'after_or_equal:report_date'],
        ];
    }
}