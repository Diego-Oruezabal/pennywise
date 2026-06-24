<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


it('shows the login screen', function () {
    $response = $this->get(route('login'));

    $response->assertOk();
    $response->assertStatus(200);

    $response->assertSee('Iniciar Sesión');
    $response->assertSee('Password');

    $response->assertSeeInOrder([
        'Iniciar Sesión',
         'Password']);

});

it('logs in a verified user successfully', function () {

    User::factory()->create([
        'email' => 'isabel@hotmail.com',
        'password' => bcrypt('11111111Aa+'),
        'email_verified_at' => now()
    ]);
    $response = $this->post(route('login.store'), [

        'email' => 'isabel@hotmail.com',
        'password' => '11111111Aa+',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
});

it('does not log in with invalid credentials', function () {

    User::factory()->create([
        'email' => 'isabel@hotmail.com',
        'password' => bcrypt('11111111Aa+'),

    ]);
    $response = $this->from(route('login'))->post(route('login.store'), [

        'email' => 'isabel@hotmail.com',
        'password' => 'incorrect-password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('error', 'Credenciales incorrectas. Por favor, inténtalo de nuevo.');

    $this->assertGuest();

});

it('prevents unverified user from accessing dashboard', function () {

    User::factory()->create([
        'email' => 'isabel@hotmail.com',
        'password' => bcrypt('11111111Aa+'),

    ]);
    $response = $this->post(route('login.store'), [

        'email' => 'isabel@hotmail.com',
        'password' => '11111111Aa+',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();

    $dasboardResponse = $this->get(route('dashboard'));
    $dasboardResponse->assertRedirect(route('verification.notice'));
});

it('does not allow access to dashboard if email is not verified', function () {

    $user = User::factory()->create([
        'email_verified_at ' => 'null'
    ]);


    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertRedirect(route('verification.notice'));
});

it('allow access to dashboard if email is verified', function () {

    $user = User::factory()->create([
        'email_verified_at ' => now()
    ]);


    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();
});

it('fails login if user does not exist', function () {

    $response = $this->from(route('login'))
                    ->post(route('login.store'), [

                        'email' => 'noexiete@hotmail.com',
                        'password' => '11111111Aa+',
                    ]);
    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors([

        'email' => 'El correo electrónico no está registrado.',
    ]);

    $this->assertGuest();
});

