<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ClienteSenaController extends Controller
{
    private const CATALOG = [
        'cursos' => [
            'title' => 'Cursos',
            'description' => 'Explora los cursos y programas registrados en AdminSena.',
            'api' => 'courses',
            'fields' => ['name' => 'Nombre del curso', 'code' => 'Código'],
        ],
        'areas' => [
            'title' => 'Áreas de formación',
            'description' => 'Conoce las áreas y sus descripciones.',
            'api' => 'areas',
            'fields' => ['name' => 'Nombre', 'description' => 'Descripción'],
        ],
        'centros' => [
            'title' => 'Centros de formación',
            'description' => 'Encuentra los centros de formación SENA y sus ciudades.',
            'api' => 'training-centers',
            'fields' => ['name' => 'Centro', 'city' => 'Ciudad o regional'],
        ],
        'equipos' => [
            'title' => 'Equipos',
            'description' => 'Consulta los equipos registrados y su disponibilidad.',
            'api' => 'computers',
            'fields' => ['serial' => 'Número de serie', 'brand' => 'Marca', 'status' => 'Estado'],
        ],
        'instructores' => [
            'title' => 'Instructores',
            'description' => 'Conoce a los instructores y sus áreas de especialidad.',
            'api' => 'teachers',
            'fields' => ['name' => 'Nombre completo', 'specialty' => 'Especialidad'],
        ],
        'aprendices' => [
            'title' => 'Aprendices',
            'description' => 'Consulta la comunidad de aprendices y sus fichas.',
            'api' => 'apprentices',
            'fields' => ['name' => 'Nombre completo', 'ficha' => 'Número de ficha'],
        ],
    ];

    public function home(): View
    {
        $courses = $this->apiCollection('courses');
        $areaRecords = $this->apiCollection('areas');
        $centerRecords = $this->apiCollection('training-centers');
        $computerRecords = $this->apiCollection('computers');
        $teacherRecords = $this->apiCollection('teachers');
        $apprenticeRecords = $this->apiCollection('apprentices');
        $featuredCourses = $courses->sortByDesc('id')->take(3)->values();
        $areas = $areaRecords->sortBy('name')->take(4)->values();
        $centers = $centerRecords->sortBy('name')->take(3)->values();
        $computers = $computerRecords->sortBy('serial')->take(4)->values();
        $teachers = $teacherRecords->sortBy('name')->take(4)->values();
        $apprentices = $apprenticeRecords->sortBy('name')->take(4)->values();

        return view('clientesena.home', [
            'courseCount' => $courses->count(),
            'areaCount' => $areaRecords->count(),
            'centerCount' => $centerRecords->count(),
            'computerCount' => $computerRecords->count(),
            'teacherCount' => $teacherRecords->count(),
            'apprenticeCount' => $apprenticeRecords->count(),
            'featuredCourses' => $featuredCourses,
            'areas' => $areas,
            'centers' => $centers,
            'computers' => $computers,
            'teachers' => $teachers,
            'apprentices' => $apprentices,
        ]);
    }

    public function categories(): View
    {
        return view('clientesena.categories.index', [
            'categories' => $this->apiCollection('categories')->sortBy('name')->values(),
            'courses' => $this->apiCollection('courses')->sortBy('name')->values(),
        ]);
    }

    public function publications(): View
    {
        $publications = collect();

        $this->apiCollection('courses')->sortByDesc('id')->take(12)->each(function (object $course) use ($publications): void {
            $publications->push([
                'title' => $course->name,
                'type' => 'Curso',
                'resource' => 'cursos',
                'id' => $course->id,
                'excerpt' => "Conoce el curso {$course->name} y consulta su código de formación {$course->code}.",
                'sort' => $course->created_at ?? $course->id,
            ]);
        });

        $this->apiCollection('areas')->sortByDesc('id')->take(8)->each(function (object $area) use ($publications): void {
            $publications->push([
                'title' => $area->name,
                'type' => 'Área de formación',
                'resource' => 'areas',
                'id' => $area->id,
                'excerpt' => $area->description ?: "Descubre los programas y cursos relacionados con {$area->name}.",
                'sort' => $area->created_at ?? $area->id,
            ]);
        });

        $this->apiCollection('training-centers')->sortByDesc('id')->take(8)->each(function (object $center) use ($publications): void {
            $publications->push([
                'title' => $center->name,
                'type' => 'Centro de formación',
                'resource' => 'centros',
                'id' => $center->id,
                'excerpt' => "Conoce el centro de formación ubicado en {$center->city}.",
                'sort' => $center->created_at ?? $center->id,
            ]);
        });

        return view('clientesena.publications.index', [
            'publications' => $publications->sortByDesc('sort')->values(),
        ]);
    }

    public function catalog(string $resource, Request $request): View
    {
        $config = $this->catalogConfig($resource);
        $records = $this->apiCollection($config['api']);
        $search = trim((string) $request->query('buscar', ''));

        if ($search !== '') {
            $records = $records->filter(function (object $record) use ($config, $search): bool {
                foreach (array_keys($config['fields']) as $field) {
                    if (stripos((string) ($record->{$field} ?? ''), $search) !== false) {
                        return true;
                    }
                }

                return false;
            });
        }

        return view('clientesena.catalog.index', [
            'resource' => $resource,
            'config' => $config,
            'records' => new LengthAwarePaginator(
                $records->sortBy(array_key_first($config['fields']))
                    ->forPage(LengthAwarePaginator::resolveCurrentPage(), 12)
                    ->values(),
                $records->count(),
                12,
                LengthAwarePaginator::resolveCurrentPage(),
                ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()],
            ),
            'search' => $search,
        ]);
    }

    public function show(string $resource, int $record): View
    {
        $config = $this->catalogConfig($resource);
        $item = $this->apiCollection($config['api'])
            ->firstWhere('id', $record);
        abort_if($item === null, 404);

        return view('clientesena.catalog.show', [
            'resource' => $resource,
            'config' => $config,
            'record' => $item,
        ]);
    }

    public function about(): View
    {
        return view('clientesena.about');
    }

    public function contact(): View
    {
        return view('clientesena.contact');
    }

    /** @return array{title: string, description: string, api: string, fields: array<string, string>} */
    private function catalogConfig(string $resource): array
    {
        abort_unless(isset(self::CATALOG[$resource]), 404);

        return self::CATALOG[$resource];
    }

    private function apiCollection(string $endpoint): Collection
    {
        $response = Http::acceptJson()
            ->connectTimeout(3)
            ->timeout(8)
            ->get(rtrim((string) config('clientesena.api_url'), '/').'/'.$endpoint);

        $response->throw();
        $data = $response->json();

        if (! is_array($data) || ! array_is_list($data)) {
            throw new \UnexpectedValueException("La API de AdminSena devolvió una respuesta inválida para {$endpoint}.");
        }

        return collect($data)->map(static fn (array $record): object => (object) $record);
    }
}
