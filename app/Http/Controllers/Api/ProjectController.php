<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Project;

class ProjectController extends Controller
{
    public function create(Request $request, Project $ser)
    {
        $data = $ser->saveProject($request);
        return response()->json(['message' => 'Save Success', 'data' => $data], 200);
    }

    public function list(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $fields  = ['id', 'name', 'created_at', 'images', 'project_cate_id', 'status', 'show_home'];
        $data = $keyword
            ? Project::where('name', 'LIKE', "%{$keyword}%")->orderBy('id', 'DESC')->get($fields)
            : Project::orderBy('id', 'DESC')->get($fields);

        return response()->json(['data' => $data, 'message' => 'success']);
    }

    public function delete($id)
    {
        $query = Project::find($id);
        if ($query && $query->images) {
            foreach (json_decode($query->images) as $i) {
                $file = public_path(ltrim($i, '/'));
                if (file_exists($file)) {
                    \File::delete($file);
                }
            }
        }
        if ($query) $query->delete();
        return response()->json(['message' => 'Delete Success'], 200);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids ?? [];
        foreach ($ids as $id) {
            $query = Project::find($id);
            if (!$query) continue;
            if ($query->images) {
                foreach (json_decode($query->images) as $i) {
                    $file = public_path(ltrim($i, '/'));
                    if (file_exists($file)) \File::delete($file);
                }
            }
            $query->delete();
        }
        return response()->json(['message' => 'Deleted'], 200);
    }

    public function toggleField(Request $request)
    {
        $project = Project::find($request->id);
        if (!$project) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $field = $request->field;
        if (!in_array($field, ['status', 'show_home', 'project_cate_id'])) {
            return response()->json(['message' => 'Invalid field'], 422);
        }
        $project->$field = $request->value;
        $project->save();
        return response()->json(['message' => 'Updated', 'data' => $project], 200);
    }

    public function edit($id)
    {
        $data = Project::find($id);
        return response()->json(['data' => $data, 'message' => 'success']);
    }
}
