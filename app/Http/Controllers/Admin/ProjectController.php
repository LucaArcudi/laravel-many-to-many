<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{

    public $validationRules = [
        'title' => ['required', 'min:2', 'max:50', 'unique:projects'],
        'description' => ['required', 'min:5'],
        'date' => ['required'],
        'type_id' => ['required', 'exists:types,id'],
        'technologies' => 'array|exists:technologies,id'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);
        $data['slug'] = Str::slug($data['title']);

        // dd($data);

        $newProject = new Project();
        $newProject->fill($data);
        // dd($newProject);
        $newProject->save();
        $newProject->technologies()->sync($data['technologies']);

        return redirect()->route('admin.projects.show', $newProject->id)->with('message', "$newProject->title has been created")->with('alert-type', 'primary');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validationRules['title'] = ['required', 'min:2', 'max:50', Rule::unique('projects')->ignore($id)];
        $data = $request->validate($this->validationRules);
        $data['slug'] = Str::slug($data['title']);

        $updatedProject = Project::findOrFail($id);
        $updatedProject->update($data);
        $updatedProject->technologies()->sync($data['technologies']);

        return redirect()->route('admin.projects.show', $updatedProject->id)->with('message', "Successfully modified")->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->technologies()->sync([]);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "$project->title has been deleted")->with('alert-type', 'danger');
    }

    public function clearType(Project $project)
    {
        $type = $project->type;
        $project->type_id = null;
        $project->update();

        return redirect()->route('admin.types.show', compact('type'));
    }
}
