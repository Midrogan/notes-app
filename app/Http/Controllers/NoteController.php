<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function notes()
    {   
        return view('pages.notes');
    }

    public function fetchAll()
    {
        // $notes = Note::shortNote(
        //     Note::where('author', Auth::user()->name)->orderBy('created_at', 'desc')
        //     ->with('tags')
        //     ->get()
        // );

        $notes = Note::shortNote(
            Note::where('author', Auth::user()->name)->orderBy('created_at', 'desc')
            ->with('tags.tagsType')
            ->get()
        );


        return response()->json([
            'notes' => $notes
        ]);
    }

    // public function fetchByTag($id)
    // {
    //     $notes = Note::shortNote(
    //         Note::where('author', Auth::user()->name)->orderBy('created_at', 'desc')
    //         ->with('tags')
    //         ->get()
    //     );


    //     return response()->json([
    //         'notes' => $notes
    //     ]);
    // }

    public function fetchDeleted()
    {
        // $notes = Note::shortNote(Note::where('author', Auth::user()->name)->onlyTrashed()->get());

        $notes = Note::shortNote(
            Note::where('author', Auth::user()->name)->onlyTrashed()->orderBy('deleted_at', 'desc')
            ->with('tags.tagsType')
            ->get()
        );

        return response()->json([
            'notes' => $notes
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
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
            $note = new Note;
            $note->title = htmlspecialchars($request->input('title'));
            $note->subtitle = htmlspecialchars($request->input('subtitle'));
            $note->content = htmlspecialchars($request->input('content'));
            $note->author = Auth::user()->name;
            $note->save();

            $note = Note::find($note->id);
            $note->tags()->attach($request->input('tags'));

            return response()->json([
                'status' => 200,
                'message' => 'Заметка успешно создана',
            ]);
        }  
    }

    public function edit($id)
    {
        $note = Note::find($id);
        if($note)
        {
            $note->tags;
            return response()->json([
                'status' => 200,
                'note' => $note,
            ]); 
        } 
        else 
        {
            return response()->json([
                'status' => 404,
                'message' => 'Заметка не найдена',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
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
            $note = Note::find($id);
            
            if($note)
            {
                $note->title = htmlspecialchars($request->input('title'));
                $note->subtitle = htmlspecialchars($request->input('subtitle'));
                $note->content = htmlspecialchars($request->input('content'));
                $note->update();

                
                $note->tags()->detach($note->tags);
                $note->tags()->attach($request->input('tags'));

                
                return response()->json([
                    'status' => 200,
                    'message' => 'Заметка успешно обновлена',
                ]);
            } 
            else 
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Заметка не найдена',
                ]);
            }

        }  
    }

    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Заметка успешно удалена',
        ]);
    }
}
