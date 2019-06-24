<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data = [
//            'user_id' => 1,
//            'slug' => 'pre-order-awesomeinterview-a-new-course-for-you-to-be-accepted-everywhere',
//            'en' => [
//                'title' => 'AwesomeInterview!, a complete online workshop for you to be accepted everywhere',
//                'description' => 'Master the whole interview process to apply to any tech company'
//            ],
//            'es' => [
//                'title' => 'AwesomeInterview!, un taller online para que te acepten en todos lados',
//                'description' => 'Conviértete en un profesional de las entrevistas para aplicar en la empresa tecnológica que gustes'
//            ],
//        ];
//
//        $project = Project::create($data);
//
//        dd($project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'user_id' => 1,
            'slug' => 'pre-order-awesomeinterview-a-new-course-for-you-to-be-accepted-everywhere',
            'en' => [
                'title' => 'AwesomeInterview!, a complete online workshop for you to be accepted everywhere',
                'description' => 'Master the whole interview process to apply to any tech company'
            ],
            'es' => [
                'title' => 'AwesomeInterview!, un taller online para que te acepten en todos lados',
                'description' => 'Conviértete en un profesional de las entrevistas para aplicar en la empresa tecnológica que gustes'
            ],
        ];

        $project = Project::create($data);

        return $project;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // API methods
    public function getAll(Request $request)
    {
        if ($request->isJson()) {
            return Project::all();
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function getProjectBySlug(Request $request, Project $project)
    {
        if ($request->isJson()) {
            $locale = $request->header('x-api-locale');
            if ($locale !== NULL) {
                // If $locale is something doesn't exist we will return the default locale
                return $project->translate($locale, true);
            }
            // Else just return all the translations
            return $project;
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function getProjectById(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                $project = Project::findOrFail($id);
                $locale = $request->header('x-api-locale');
                if ($locale !== NULL) {
                    // If $locale is something doesn't exist we will return the default locale
                    return $project->translate($locale, true);
                }

                // Else just return all the translations
                return $project;
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function createProject(Request $request)
    {
        if ($request->isJson()) {
            $data = $request->json()->all();
            $userExists = User::where("id", $data['user_id'])->exists();

            if ($userExists === FALSE) {
                return response()->json(['error' => 'Invalid parameters'], 406);
            }

            /*
            This object:
            {
                "user_id": 1,
                "title": "AwesomeInterview!, a complete online workshop for you to be accepted everywhere",
                "description": "Master the whole interview process to apply to any tech company",
                "translations": [
                    {
                        "locale": "en",
                        "title": "AwesomeInterview!, a complete online workshop for you to be accepted everywhere",
                        "description": "Master the whole interview process to apply to any tech company"
                    },
                    {
                        "locale": "es",
                        "title": "AwesomeInterview!, un taller online para que te acepten en todos lados",
                        "description": "Conviértete en un profesional de las entrevistas para aplicar en la empresa tecnológica que gustes"
                    }
                ]
            }

            Will be converted to:
            [
                'user_id' => 1,
                'slug' => 'pre-order-awesomeinterview-a-new-course-for-you-to-be-accepted-everywhere',
                'en' => [
                    'title' => 'AwesomeInterview!, a complete online workshop for you to be accepted everywhere',
                    'description' => 'Master the whole interview process to apply to any tech company'
                ],
                'es' => [
                    'title' => 'AwesomeInterview!, un taller online para que te acepten en todos lados',
                    'description' => 'Conviértete en un profesional de las entrevistas para aplicar en la empresa tecnológica que gustes'
                ],
            ];
            */

            $translations = $data['translations'];

            $dataToBeSaved = [
                'user_id' => $data['user_id'],
                'thumbnail' =>  $data['thumbnail'],
                'image' =>  $data['image'],
//              'slug' is automatically set!
            ];

            foreach ($translations as $translation) {
                $dataToBeSaved [$translation["locale"]] = [
                    'title' => $translation["title"],
                    'description' => $translation["description"],
                ];
            }

            $project = Project::create($dataToBeSaved);

            return response()->json($project, 201);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function deleteProject(Request $request, $id)
    {
        if ($request->isJson()) {
            try {
                $project = Project::findOrFail($id);
                $project->delete();
                return response()->json($project, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'No content'], 406);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401, []);
        }
    }

    public function getCurrentUserProjects()
    {
        $user = Auth::user();
        $projects = $user->projects()->get();

        return response()->json($projects, 200);
    }
}
