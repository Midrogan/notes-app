<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function fetchAll()
    {
        $tags = DB::table('tags')
        ->leftJoin('tags_types', 'tags.tags_type_id', '=', 'tags_types.id')
        ->select('tags.id', 'tags.name', 'tags_types.type')
        ->where('author', Auth::user()->name)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json([
            'tags' => $tags
        ]);
    }

    public function fetchTagsTypes()
    {  
        $tagsTypes = TagsType::all();

        return response()->json([
            'tagsTypes' => $tagsTypes
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } 
        else 
        {
            $tag = new Tag;
            $tag->name = htmlspecialchars($request->input('name'));
            $tag->tags_type_id = htmlspecialchars($request->input('type'));
            $tag->author = Auth::user()->name;
            $tag->save();
            return response()->json([
                'status' => 200,
                'message' => 'Категория успешно создана',
            ]);
        }  
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        $type = Tag::find($tag['id'])->tagsType;

        if($tag)
        {
            return response()->json([
                'status' => 200,
                'tag' => $tag,
                'type' => $type,
            ]); 
        } 
        else 
        {
            return response()->json([
                'status' => 404,
                'message' => 'Категория не найдена',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } 
        else 
        {
            $tag = Tag::find($id);
            
            if($tag)
            {
                $tag->name = htmlspecialchars($request->input('name'));
                $tag->tags_type_id = htmlspecialchars($request->input('type'));
                $tag->update();
                
                return response()->json([
                    'status' => 200,
                    'message' => 'Категория успешно обновлена',
                ]);
            } 
            else 
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Категория не найдена',
                ]);
            }

        }  
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Категория успешно удалена',
        ]);
    }
}
