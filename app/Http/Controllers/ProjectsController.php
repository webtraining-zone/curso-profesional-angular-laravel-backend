<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

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
}
