<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Locker;
use App\Models\Maintenance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Maintenance::with(['locker.location', 'user']);

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function (Builder $query) use ($search): void {
                $query->where('issue_des', 'like', "%{$search}%")
                    ->orWhereHas('locker', fn (Builder $query): Builder => $query->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('locker.location', fn (Builder $query): Builder => $query->where('name', 'like', "%{$search}%"));
            });
        }

        $maintenances = $query->latest('id')->paginate(15)->withQueryString();

        return view('admin.maintenances.index', compact('maintenances'));
    }

    public function create(): View
    {
        $lockers = Locker::with('location')->orderBy('name')->get();

        return view('admin.maintenances.create', compact('lockers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $validated['user_id'] = $request->user()->id;
        Maintenance::create($validated);

        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance created successfully.');
    }

    public function show(Maintenance $maintenance): View
    {
        $maintenance->load(['locker.location', 'user']);

        return view('admin.maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance): View
    {
        $lockers = Locker::with('location')->orderBy('name')->get();

        return view('admin.maintenances.edit', compact('maintenance', 'lockers'));
    }

    public function update(Request $request, Maintenance $maintenance): RedirectResponse
    {
        $maintenance->update($request->validate($this->rules()));

        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance updated successfully.');
    }

    public function destroy(Maintenance $maintenance): RedirectResponse
    {
        $maintenance->delete();

        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance deleted successfully.');
    }

    private function rules(): array
    {
        return [
            'locker_id' => ['required', 'integer', Rule::exists(Locker::class, 'id')],
            'issue_des' => ['required', 'string', 'max:255'],
            'report_date' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
            'resolve_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:report_date', 'before_or_equal:today'],
        ];
    }
}
