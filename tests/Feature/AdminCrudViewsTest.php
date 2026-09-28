<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\Locker;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminCrudViewsTest extends TestCase
{
    use LazilyRefreshDatabase;

    public static function pages(): array
    {
        return [
            ['admin.locations.index'], ['admin.locations.create'], ['admin.locations.edit'],
            ['user.locations.show'], ['admin.lockers.index'], ['admin.lockers.create'], ['admin.lockers.edit'],
        ];
    }

    #[DataProvider('pages')]
    public function test_admin_pages_render_with_working_links(string $route): void
    {
        $location = $this->location();
        $locker = Locker::create(['name' => 'L-001', 'status' => 'Available', 'location_id' => $location->id]);
        $this->actingAs(User::factory()->create(['role' => 'admin']));
        $parameters = str_ends_with($route, '.edit') || str_ends_with($route, '.show')
            ? (str_contains($route, 'locations') ? $location : $locker) : [];

        $this->get(route($route, $parameters))->assertOk();
    }

    public function test_location_counts_and_free_filter_use_real_lockers(): void
    {
        $location = $this->location();
        Location::create(['name' => 'Empty site', 'address' => 'Other address', 'map_link' => 'https://example.com/map']);
        Locker::create(['name' => 'L-001', 'status' => 'Available', 'location_id' => $location->id]);
        $this->actingAs(User::factory()->create(['role' => 'admin']));

        $this->get(route('admin.locations.index', ['free' => 1, 'search' => 'Library']))
            ->assertSee('Library')->assertSee('1 free')->assertDontSee('Empty site');
    }

    public function test_locker_search_and_status_filter(): void
    {
        $location = $this->location();
        Locker::create(['name' => 'Free locker', 'status' => 'Available', 'location_id' => $location->id]);
        Locker::create(['name' => 'Busy locker', 'status' => 'In Use', 'location_id' => $location->id]);
        $this->actingAs(User::factory()->create(['role' => 'admin']));

        $this->get(route('admin.lockers.index', ['search' => 'Library', 'status' => 'Available']))
            ->assertSee('Free locker')->assertDontSee('Busy locker');
    }

    public static function resources(): array
    {
        return [['locations'], ['lockers']];
    }

    #[DataProvider('resources')]
    public function test_admin_can_create_update_and_delete(string $resource): void
    {
        $location = $this->location();
        $data = $resource === 'locations'
            ? ['name' => 'New site', 'address' => 'New address', 'map_link' => 'https://example.com/map']
            : ['name' => 'New locker', 'status' => 'Available', 'location_id' => $location->id];
        $this->actingAs(User::factory()->create(['role' => 'admin']));

        $this->post(route("admin.$resource.store"), $data)->assertRedirectToRoute("admin.$resource.index");
        $this->assertDatabaseHas($resource, $data);
        $model = $resource === 'locations' ? Location::where('name', $data['name'])->firstOrFail() : Locker::where('name', $data['name'])->firstOrFail();
        $data['name'] = 'Updated name';
        $this->put(route("admin.$resource.update", $model), $data)->assertRedirectToRoute("admin.$resource.index");
        $this->assertDatabaseHas($resource, $data);
        $this->delete(route("admin.$resource.destroy", $model))->assertRedirectToRoute("admin.$resource.index");
        $this->assertModelMissing($model);
    }

    #[DataProvider('resources')]
    public function test_regular_users_cannot_open_admin_lists(string $resource): void
    {
        $this->actingAs(User::factory()->create(['role' => 'user']));

        $this->get(route("admin.$resource.index"))->assertForbidden();
    }

    #[DataProvider('resources')]
    public function test_guests_are_redirected_to_login(string $resource): void
    {
        $this->get(route("admin.$resource.index"))->assertRedirectToRoute('login');
    }

    public function test_admin_navigation_shows_current_profile_and_logout_form(): void
    {
        $this->actingAs(User::factory()->create(['name' => 'Kong Bunyim', 'role' => 'admin']));

        $this->get(route('admin.dashboard'))
            ->assertSee('Kong Bunyim')
            ->assertSee('KB')
            ->assertSee(route('user.profile'))
            ->assertSee(route('admin.locations.index'))
            ->assertSee(route('admin.lockers.index'))
            ->assertSee('action="'.route('user.logout').'" method="POST"', false)
            ->assertDontSee('Setting')
            ->assertDontSee('components/sidebar.css')
            ->assertDontSee('components/header.css');
    }

    public function test_admin_can_log_out(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']));

        $this->post(route('user.logout'))->assertRedirectToRoute('login');

        $this->assertGuest();
    }

    private function location(): Location
    {
        return Location::create(['name' => 'Library', 'address' => 'Library address', 'map_link' => 'https://example.com/map']);
    }
}
