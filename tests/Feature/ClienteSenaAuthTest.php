<?php

namespace Tests\Feature;

use App\Models\ClienteSenaUser;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class ClienteSenaAuthTest extends TestCase
{
    private string $testEmail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testEmail = 'cliente-'.Str::uuid().'@example.test';

        config(['database.connections.adminsena' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]]);
        DB::purge('adminsena');

        Schema::connection('adminsena')->create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        ClienteSenaUser::query()->where('email', $this->testEmail)->delete();

        parent::tearDown();
    }

    public function test_client_can_register_login_and_logout_with_an_adminsena_account(): void
    {
        $this->get('/cliente-sena/registro')
            ->assertOk()
            ->assertSee('Crea tu cuenta');

        $this->post('/cliente-sena/registro', [
            'name' => 'Cliente de prueba',
            'email' => $this->testEmail,
            'password' => 'clave-segura-123',
            'password_confirmation' => 'clave-segura-123',
        ])->assertRedirect(route('clientesena.home'));

        $user = ClienteSenaUser::query()->where('email', $this->testEmail)->firstOrFail();
        $this->assertSame('Cliente de prueba', $user->name);
        $this->assertTrue(Hash::check('clave-segura-123', $user->password));
        $this->assertSame('adminsena', $user->getConnectionName());
        $this->assertTrue(DB::connection('adminsena')->table('users')->where('email', $this->testEmail)->exists());
        $this->assertAuthenticatedAs($user);

        $this->post('/cliente-sena/logout')
            ->assertRedirect(route('clientesena.home'));
        $this->assertGuest();

        $this->get('/cliente-sena/login')
            ->assertOk()
            ->assertSee('Inicia sesión');

        $this->from('/cliente-sena/login')
            ->post('/cliente-sena/login', [
                'email' => $this->testEmail,
                'password' => 'clave-incorrecta',
            ])
            ->assertRedirect('/cliente-sena/login')
            ->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->post('/cliente-sena/login', [
            'email' => $this->testEmail,
            'password' => 'clave-segura-123',
        ])->assertRedirect(route('clientesena.home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_client_registration_requires_a_confirmed_password_and_unique_email(): void
    {
        ClienteSenaUser::query()->create([
            'name' => 'Cliente existente',
            'email' => $this->testEmail,
            'password' => Hash::make('clave-segura-123'),
        ]);

        $this->from('/cliente-sena/registro')
            ->post('/cliente-sena/registro', [
                'name' => 'Otro cliente',
                'email' => $this->testEmail,
                'password' => 'otra-clave-123',
                'password_confirmation' => 'no-coincide',
            ])
            ->assertRedirect('/cliente-sena/registro')
            ->assertSessionHasErrors(['email', 'password']);

        $this->assertGuest();
        $this->assertSame(1, ClienteSenaUser::query()->where('email', $this->testEmail)->count());
    }

    public function test_customer_pages_do_not_link_to_the_admin_panel(): void
    {
        Http::fake([
            '*/courses' => Http::response([]),
            '*/areas' => Http::response([]),
            '*/training-centers' => Http::response([]),
            '*/computers' => Http::response([]),
            '*/teachers' => Http::response([]),
            '*/apprentices' => Http::response([]),
        ]);

        $this->get('/cliente-sena')
            ->assertOk()
            ->assertDontSee('Admin Sena ↗');

        $this->get('/cliente-sena/contacto')
            ->assertOk()
            ->assertDontSee('Abrir AdminSena')
            ->assertDontSee('Admin Sena ↗');
    }
}
