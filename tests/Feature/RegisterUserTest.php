<?php

use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use App\Notifications\VerifyEmail;

uses(RefreshDatabase::class);

it('shows the registration screen', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
    $response->assertStatus(200);

    $response->assertSee('Iniciar Sesión');
    $response->assertSee('Password');

    $response->assertSeeInOrder([
        'Iniciar Sesión',
         'Password']);

});

//Probar registro de usuario, que se cree el usuario y que se dispare el evento Registered
it('registers a new user as unverifed and dispatches the registered event', function () {

    //$this->withoutExceptionHandling();

    Event::fake();

    $response = $this->post(route('register.store'), [
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => '11111111Aa+',
        'password_confirmation' => '11111111Aa+',
    ]);

    $response->assertRedirect(route('verification.notice'));

    $user = User::where('email', 'test@test.com')->first();

    expect($user)->not->toBeNull();
    expect($user->name)->toBe('Test User');
    expect($user->hasVerifiedEmail())->toBeFalse();

    Event::assertDispatched(Registered::class);

});

//Probar la validación de campos requeridos al enviar un formulario vacío
it('should validate required fields when the request body is empty', function () {

    $response = $this->post(route('register.store'), []);

    $response->assertSessionHasErrors([
        'name',
        'email',
        'password'
    ]);
});

//Probar usuarios duplicados, que no se pueda registrar un usuario con el mismo correo electrónico
it('prevents duplicate email addresses', function () {

    User::factory()->create([
       'email' => 'test@test.com'
    ]);

     $response = $this->post(route('register.store'), [
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => '11111111Aa+',
        'password_confirmation' => '11111111Aa+',
    ]);

    $response->assertRedirect();

    $response->assertSessionHasErrors([

        'email' => 'El correo electrónico ya está en uso.',

    ]);
});

//Envío de email despues de que usuario se registre
it('sends a verification email after registration', function () {

     Notification::fake();

    $response = $this->post(route('register.store'), [
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => '11111111Aa+',
        'password_confirmation' => '11111111Aa+',
    ]);

    $user = User::where('email', 'test@test.com')->first();

    Notification::assertSentTo($user, VerifyEmail::class);

});
