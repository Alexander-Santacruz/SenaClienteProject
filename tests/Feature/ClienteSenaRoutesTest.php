<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ClienteSenaRoutesTest extends TestCase
{
    public function test_client_routes_read_the_adminsena_api(): void
    {
        config(['clientesena.api_url' => 'http://adminsena.test/api']);

        $course = ['id' => 7, 'name' => 'Curso de prueba', 'code' => 'PR-007', 'created_at' => '2025-01-01T00:00:00.000000Z'];
        $area = ['id' => 3, 'name' => 'Área de prueba', 'description' => 'Descripción de prueba', 'created_at' => '2025-01-02T00:00:00.000000Z'];
        $center = ['id' => 5, 'name' => 'Centro de prueba', 'city' => 'Bogotá', 'created_at' => '2025-01-03T00:00:00.000000Z'];
        $computer = ['id' => 8, 'serial' => 'EQ-008', 'brand' => 'Lenovo', 'status' => 'Disponible'];
        $teacher = ['id' => 9, 'name' => 'Instructora de prueba', 'email' => 'instructora@example.test', 'specialty' => 'Programación'];
        $apprentice = ['id' => 10, 'name' => 'Aprendiz de prueba', 'email' => 'aprendiz@example.test', 'ficha' => 'FICHA-010'];

        Http::fake([
            'http://adminsena.test/api/categories' => Http::response([['id' => 2, 'name' => 'Tecnología']]),
            'http://adminsena.test/api/courses' => Http::response([$course]),
            'http://adminsena.test/api/areas' => Http::response([$area]),
            'http://adminsena.test/api/training-centers' => Http::response([$center]),
            'http://adminsena.test/api/computers' => Http::response([$computer]),
            'http://adminsena.test/api/teachers' => Http::response([$teacher]),
            'http://adminsena.test/api/apprentices' => Http::response([$apprentice]),
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('ClienteSena')
            ->assertSee('Explora la oferta del SENA');

        $home = $this->get('/cliente-sena')
            ->assertOk()
            ->assertSee('ClienteSena')
            ->assertSee('Explora la oferta del SENA')
            ->assertSee('Cursos de formación')
            ->assertSee('Equipos')
            ->assertSee('Instructores')
            ->assertSee('Aprendices');

        $home->assertSee(e($course['name']));
        $this->get('/cliente-sena/datos/cursos')
            ->assertOk()
            ->assertSee(e($course['name']));
        $this->get("/cliente-sena/datos/cursos/{$course['id']}")
            ->assertOk()
            ->assertSee(e($course['name']));

        $this->get('/cliente-sena/categorias')
            ->assertOk()
            ->assertSee('Tecnología');
        $this->get('/categories')
            ->assertRedirect('/cliente-sena/categorias');
        $this->get('/category/create')
            ->assertRedirect('/cliente-sena/categorias');
        $this->get('/category/1')
            ->assertRedirect('/cliente-sena/categorias');
        $this->post('/category', ['name' => 'No debe crearse desde el portal cliente'])
            ->assertNotFound();
        $this->get('/cliente-sena/publicaciones')->assertOk();
        $this->get('/cliente-sena/datos/areas')
            ->assertOk()
            ->assertSee(e($area['name']));
        $this->get('/cliente-sena/datos/centros')
            ->assertOk()
            ->assertSee(e($center['name']));
        $this->get('/cliente-sena/datos/equipos')
            ->assertOk()
            ->assertSee(e($computer['serial']))
            ->assertSee(e($computer['brand']))
            ->assertSee(e($computer['status']));
        $this->get("/cliente-sena/datos/equipos/{$computer['id']}")
            ->assertOk()
            ->assertSee(e($computer['serial']));
        $this->get('/cliente-sena/datos/instructores')
            ->assertOk()
            ->assertSee(e($teacher['name']))
            ->assertSee(e($teacher['specialty']))
            ->assertDontSee(e($teacher['email']));
        $this->get("/cliente-sena/datos/instructores/{$teacher['id']}")
            ->assertOk()
            ->assertSee(e($teacher['name']))
            ->assertDontSee(e($teacher['email']));
        $this->get('/cliente-sena/datos/aprendices')
            ->assertOk()
            ->assertSee(e($apprentice['name']))
            ->assertSee(e($apprentice['ficha']))
            ->assertDontSee(e($apprentice['email']));
        $this->get("/cliente-sena/datos/aprendices/{$apprentice['id']}")
            ->assertOk()
            ->assertSee(e($apprentice['name']))
            ->assertDontSee(e($apprentice['email']));
        $this->get('/cliente-sena/nosotros')->assertOk();
        $this->get('/cliente-sena/contacto')->assertOk();
        $this->get('/cliente-sena/datos/no-existe')->assertNotFound();
        $this->get('/cliente-sena/datos/cursos?buscar=prueba')
            ->assertOk()
            ->assertSee(e($course['name']));

        Http::assertSent(fn (ClientRequest $request): bool => $request->url() === 'http://adminsena.test/api/courses');
        Http::assertSent(fn (ClientRequest $request): bool => $request->url() === 'http://adminsena.test/api/computers');
        Http::assertSent(fn (ClientRequest $request): bool => $request->url() === 'http://adminsena.test/api/teachers');
        Http::assertSent(fn (ClientRequest $request): bool => $request->url() === 'http://adminsena.test/api/apprentices');
    }
}
