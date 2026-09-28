<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\Locker;
use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminMaintenanceTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_create_update_and_delete_without_changing_locker_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $other = User::factory()->create();
        $locker = $this->locker();
        $data = ['locker_id' => $locker->id, 'issue_des' => 'Broken handle', 'report_date' => '2026-01-01', 'resolve_date' => '2026-01-02'];
        $this->actingAs($admin);

        $this->post(route('admin.maintenances.store'), $data + ['user_id' => $other->id])
            ->assertRedirectToRoute('admin.maintenances.index');
        $maintenance = Maintenance::sole();
        $this->assertSame($admin->id, $maintenance->user_id);
        $this->assertSame('2026-01-02', $maintenance->resolve_date->toDateString());
        $this->assertSame('Available', $locker->fresh()->status);

        $this->actingAs(User::factory()->create(['role' => 'admin']));
        $data['resolve_date'] = '2026-01-03';
        $this->put(route('admin.maintenances.update', $maintenance), $data + ['user_id' => $other->id])
            ->assertRedirectToRoute('admin.maintenances.index');
        $this->assertSame('2026-01-03', $maintenance->fresh()->resolve_date->toDateString());
        $this->assertSame($admin->id, $maintenance->fresh()->user_id);
        $this->assertSame('Available', $locker->fresh()->status);

        $this->delete(route('admin.maintenances.destroy', $maintenance))->assertRedirectToRoute('admin.maintenances.index');
        $this->assertModelMissing($maintenance);
        $this->assertSame('Available', $locker->fresh()->status);
    }

    public function test_pages_show_real_locker_reporter_dates_and_escape_the_issue(): void
    {
        $maintenance = $this->maintenance(['issue_des' => '<script>alert(1)</script>']);
        $this->actingAs($maintenance->user);

        $this->get(route('admin.maintenances.index'))->assertSee('L-001')->assertSee('Library')->assertSee('02 Jan 2026')
            ->assertSee('<script>alert(1)</script>')->assertDontSee('<script>alert(1)</script>', false);
        $this->get(route('admin.maintenances.create'))->assertSee('L-001')->assertSee('Library');
        $this->get(route('admin.maintenances.edit', $maintenance))->assertSee('2026-01-01')->assertSee('L-001');
        $this->get(route('admin.maintenances.show', $maintenance))->assertSee($maintenance->user->name)
            ->assertSee('01 Jan 2026')->assertSee('02 Jan 2026')->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_search_matches_locker_location_and_issue_and_pagination_keeps_search(): void
    {
        $report = $this->maintenance(['issue_des' => 'Broken handle']);
        $this->maintenance(['issue_des' => 'Repaired latch']);
        $this->actingAs($report->user);

        $this->get(route('admin.maintenances.index', ['search' => 'Library']))->assertSee('Broken handle')->assertSee('Repaired latch');
        $this->get(route('admin.maintenances.index', ['search' => 'L-001']))->assertSee('Broken handle')->assertSee('Repaired latch');
        $this->get(route('admin.maintenances.index', ['search' => 'Broken']))->assertSee('Broken handle')->assertDontSee('Repaired latch');
        $this->get(route('admin.maintenances.index', ['search' => 'missing']))->assertSee('No maintenance records found.');
        for ($index = 0; $index < 15; $index++) {
            Maintenance::create(['locker_id' => $report->locker_id, 'user_id' => $report->user_id, 'issue_des' => 'Broken label', 'report_date' => '2026-01-01', 'resolve_date' => '2026-01-02']);
        }
        $this->get(route('admin.maintenances.index', ['search' => 'Broken']))
            ->assertSee('search=Broken', false)->assertSee('page=2', false);
    }

    public static function invalidData(): array
    {
        return [
            'missing locker' => ['locker_id', null],
            'unknown locker' => ['locker_id', 999999],
            'missing issue' => ['issue_des', ''],
            'long issue' => ['issue_des', str_repeat('x', 256)],
            'invalid date' => ['report_date', 'not-a-date'],
            'missing date' => ['report_date', null],
            'future report' => ['report_date', '2099-01-01'],
            'missing resolution' => ['resolve_date', null],
            'early resolution' => ['resolve_date', '2025-12-31'],
            'future resolution' => ['resolve_date', '2099-01-01'],
            'invalid resolution' => ['resolve_date', 'not-a-date'],
        ];
    }

    #[DataProvider('invalidData')]
    public function test_invalid_reports_are_not_saved(string $field, mixed $value): void
    {
        $maintenance = $this->maintenance();
        $this->actingAs($maintenance->user);
        $data = ['locker_id' => $maintenance->locker_id, 'issue_des' => 'Broken handle', 'report_date' => '2026-01-01', 'resolve_date' => '2026-01-02'];
        $data[$field] = $value;

        $this->post(route('admin.maintenances.store'), $data)->assertSessionHasErrors($field);
        $this->put(route('admin.maintenances.update', $maintenance), $data)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('maintenances', 1);
        $this->assertSame('Broken handle', $maintenance->fresh()->issue_des);
        $this->assertSame('2026-01-02', $maintenance->fresh()->resolve_date->toDateString());
    }

    public static function protectedEndpoints(): array
    {
        return [
            ['GET', 'index'], ['GET', 'create'], ['POST', 'store'],
            ['GET', 'show'], ['GET', 'edit'], ['PUT', 'update'], ['DELETE', 'destroy'],
        ];
    }

    #[DataProvider('protectedEndpoints')]
    public function test_guests_and_regular_users_cannot_access_maintenance(string $method, string $action): void
    {
        $maintenance = $this->maintenance();
        $url = route('admin.maintenances.'.$action, in_array($action, ['index', 'create', 'store']) ? [] : $maintenance);

        $this->call($method, $url)->assertRedirectToRoute('login');
        $this->actingAs(User::factory()->create())->call($method, $url)->assertForbidden();

        $this->assertDatabaseCount('maintenances', 1);
        $this->assertModelExists($maintenance);
    }

    public function test_missing_records_return_not_found(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']));

        $this->get(route('admin.maintenances.show', 999999))->assertNotFound();
        $this->get(route('admin.maintenances.edit', 999999))->assertNotFound();
        $this->put(route('admin.maintenances.update', 999999))->assertNotFound();
        $this->delete(route('admin.maintenances.destroy', 999999))->assertNotFound();
    }

    public function test_locker_with_maintenance_records_cannot_be_deleted(): void
    {
        $maintenance = $this->maintenance();
        $this->actingAs($maintenance->user);

        $this->delete(route('admin.lockers.destroy', $maintenance->locker))->assertSessionHasErrors('locker');

        $this->assertModelExists($maintenance->locker);
        $this->assertModelExists($maintenance);
    }

    private function locker(): Locker
    {
        $location = Location::create(['name' => 'Library', 'address' => 'Main street', 'map_link' => 'https://example.com/map']);

        return Locker::create(['name' => 'L-001', 'status' => 'Available', 'location_id' => $location->id]);
    }

    /** @param array<string, mixed> $attributes */
    private function maintenance(array $attributes = []): Maintenance
    {
        return Maintenance::create(array_merge([
            'locker_id' => $this->locker()->id,
            'user_id' => User::factory()->create(['role' => 'admin'])->id,
            'issue_des' => 'Broken handle',
            'report_date' => '2026-01-01',
            'resolve_date' => '2026-01-02',
        ], $attributes));
    }
}
