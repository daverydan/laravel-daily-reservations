<?php

use App\Models\Activity;
use App\Models\User;
use App\Notifications\RegisteredToActivityNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegisterActivityTest extends TestCase
{
    use RefreshDatabase;

    protected User $guide;

    protected function setUp(): void
    {
        parent::setUp();

        $this->guide = User::factory()->guide()->create();
    }

    public function test_shows_register_button_if_user_hasnt_registered_to_activity()
    {
        $user = User::factory()->create();
        $activity = Activity::factory()->create([
            'guide_id' => $this->guide->id,
        ]);

        $response = $this->actingAs($user)->get(route('activity.show', $activity));

        $response->assertSeeText('Register to Activity');
    }

    public function test_shows_already_registered_when_user_is_registered_to_activity()
    {
        $user = User::factory()->create();
        $activity = Activity::factory()->create([
            'guide_id' => $this->guide->id,
        ]);
        $user->activities()->attach($activity);

        $response = $this->actingAs($user)->get(route('activity.show', $activity));

        $response->assertSeeText('You have already registered.');
        $response->assertDontSeeText('Register to Activity');
    }

    public function test_authenticated_user_can_register_to_activity()
    {
        Notification::fake();

        $user = User::factory()->create();
        $activity = Activity::factory()->create([
            'guide_id' => $this->guide->id,
        ]);

        $response = $this->actingAs($user)->post(route('activities.register', $activity));

        Notification::assertSentTo($user, RegisteredToActivityNotification::class);

        $response->assertRedirect(route('my-activity.show'));

        $this->assertCount(1, $user->activities()->get());
    }

    public function test_authenticated_user_cannot_register_twice_to_activity()
    {
        Notification::fake();

        $user = User::factory()->create();
        $activity = Activity::factory()->create([
            'guide_id' => $this->guide->id,
        ]);

        $response = $this->actingAs($user)->post(route('activities.register', $activity));
        $response->assertRedirect(route('my-activity.show'));

        $r = $this->actingAs($user)->post(route('activities.register', $activity));
        $r->assertStatus(409);

        $this->assertCount(1, $user->activities()->get());

        Notification::assertSentTimes(RegisteredToActivityNotification::class, 1);
    }

    public function test_guest_gets_redirected_to_register_page()
    {
        $activity = Activity::factory()->create([
            'guide_id' => $this->guide->id,
        ]);

        $response = $this->post(route('activities.register', $activity));

        $response->assertRedirect(route('register').'?activity='.$activity->id);
    }

    // public function test_guest_registers_to_activity()
    // {
    //     Notification::fake();

    //     $activity = Activity::factory()->create();

    //     $response = $this->withSession(['activity' => $activity->id])->post(route('register'), [
    //         'name' => 'Test User',
    //         'email' => 'test@test.com',
    //         'password' => 'password',
    //         'password_confirmation' => 'password',
    //     ]);

    //     Notification::assertSentTo(User::find(1), RegisteredToActivityNotification::class);

    //     $response->assertRedirect(route('my-activity.show'));
    // }

    public function test_guest_registers_to_activity()
    {
        Notification::fake();

        $activity = Activity::factory()->create([
            'guide_id' => $this->guide->id,
        ]);

        $response = $this->withSession(['activity' => $activity->id])->post(route('register'), [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        Notification::assertSentTo(User::where('email', 'test@test.com')->first(), RegisteredToActivityNotification::class);

        $response->assertRedirect(route('my-activity.show'));
    }
}
