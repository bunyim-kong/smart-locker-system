<?php

namespace Tests\Feature;

use App\Models\History;
use App\Models\Location;
use App\Models\Locker;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LockerUsageTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_confirmation_assigns_locker_and_encrypts_code(): void
    {
        $locker = $this->locker();
        $user = User::factory()->create();
        $this->actingAs($user)->post(route('user.lockers.start', $locker), ['user_id' => 999, 'access_code' => '111111'])
            ->assertRedirectToRoute('user.lockers.index');
        $usage = History::sole();
        $this->assertSame($user->id, $usage->user_id);
        $this->assertSame('In Use', $locker->fresh()->status);
        $this->assertMatchesRegularExpression('/^\d{6}$/', $usage->access_code);
        $this->assertNotSame($usage->access_code, $usage->getRawOriginal('access_code'));
        $this->assertArrayNotHasKey('access_code', $usage->toArray());
        $this->assertNull($usage->end_time);
        $this->get(route('user.lockers.index'))->assertSee($usage->access_code)->assertHeader('Cache-Control', 'no-store, private');
    }

    public function test_duplicate_confirmation_preserves_one_session_and_code(): void
    {
        $locker = $this->locker();
        $this->actingAs(User::factory()->create())->post(route('user.lockers.start', $locker));
        $code = History::sole()->access_code;

        $this->post(route('user.lockers.start', $locker))->assertRedirectToRoute('user.lockers.index');

        $this->assertDatabaseCount('histories', 1);
        $this->assertSame($code, History::sole()->access_code);
    }

    public static function unavailableStatuses(): array
    {
        return [['In Use'], ['Maintenance']];
    }

    #[DataProvider('unavailableStatuses')]
    public function test_unavailable_lockers_cannot_be_assigned(string $status): void
    {
        $locker = $this->locker($status);
        $this->actingAs(User::factory()->create());

        $this->post(route('user.lockers.start', $locker))->assertSessionHasErrors('locker');

        $this->assertDatabaseCount('histories', 0);
        $this->assertSame($status, $locker->fresh()->status);
    }

    public function test_other_user_cannot_claim_view_code_or_finish_session(): void
    {
        $locker = $this->locker();
        $this->actingAs(User::factory()->create())->post(route('user.lockers.start', $locker));
        $usage = History::sole();
        $this->actingAs(User::factory()->create());

        $this->post(route('user.lockers.start', $locker))->assertSessionHasErrors('locker');
        $this->get(route('user.lockers.index'))->assertDontSee($usage->access_code);
        $this->get(route('user.lockers.show', $locker))->assertDontSee($usage->access_code)->assertDontSee('Confirm use');
        $this->post(route('user.lockers.finish', $usage))->assertForbidden();

        $this->assertNull($usage->fresh()->end_time);
        $this->assertDatabaseCount('histories', 1);
    }

    public function test_user_cannot_hold_two_lockers(): void
    {
        $first = $this->locker();
        $second = $this->locker();
        $this->actingAs(User::factory()->create())->post(route('user.lockers.start', $first));

        $this->post(route('user.lockers.start', $second))->assertSessionHasErrors('locker');

        $this->assertSame('Available', $second->fresh()->status);
        $this->assertDatabaseCount('histories', 1);
    }

    public function test_finish_clears_code_and_stale_finish_does_not_release_new_session(): void
    {
        $locker = $this->locker();
        $this->actingAs(User::factory()->create())->post(route('user.lockers.start', $locker));
        $usage = History::sole();

        $this->post(route('user.lockers.finish', $usage))->assertRedirectToRoute('user.lockers.index');

        $this->assertSame('Available', $locker->fresh()->status);
        $this->assertNotNull($usage->fresh()->end_time);
        $this->assertNull($usage->fresh()->access_code);
        $this->post(route('user.lockers.start', $locker))->assertRedirectToRoute('user.lockers.index');
        $this->post(route('user.lockers.finish', $usage))->assertRedirectToRoute('user.lockers.index');
        $this->assertSame('In Use', $locker->fresh()->status);
        $this->assertSame(1, History::whereNull('end_time')->count());
    }

    public function test_location_links_to_confirmation_without_reserving_on_get(): void
    {
        $locker = $this->locker();
        $this->actingAs(User::factory()->create());

        $this->get(route('user.locations.show', $locker->location))->assertSee(route('user.lockers.show', $locker));
        $this->get(route('user.lockers.show', $locker))->assertSee('Confirm use');

        $this->assertDatabaseCount('histories', 0);
        $this->assertSame('Available', $locker->fresh()->status);
    }

    public function test_guests_cannot_start_or_finish_usage(): void
    {
        $locker = $this->locker();
        $this->post(route('user.lockers.start', $locker))->assertRedirectToRoute('login');
        $this->post('/locker-usage/1/finish')->assertRedirectToRoute('login');
        $this->assertDatabaseCount('histories', 0);
    }

    public function test_admin_cannot_reset_or_delete_an_assigned_locker(): void
    {
        $locker = $this->locker();
        $this->actingAs(User::factory()->create())->post(route('user.lockers.start', $locker));
        $this->actingAs(User::factory()->create(['role' => 'admin']));

        $this->put(route('admin.lockers.update', $locker), ['name' => $locker->name, 'status' => 'Available', 'location_id' => $locker->location_id])->assertSessionHasErrors('status');
        $this->delete(route('admin.lockers.destroy', $locker))->assertSessionHasErrors('locker');

        $this->assertSame('In Use', $locker->fresh()->status);
        $this->assertNull(History::sole()->end_time);
    }

    private function locker(string $status = 'Available'): Locker
    {
        $location = Location::create(['name' => 'Library', 'address' => 'Main street', 'map_link' => 'https://example.com/map']);

        return Locker::create(['name' => 'L-01', 'status' => $status, 'location_id' => $location->id]);
    }
}
