<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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
        $notes = Note::shortNote(
            Note::where('author', Auth::user()->name)
            ->where('archived', 0)
            ->orderBy('created_at', 'desc')
            ->with('tags.tagsType')
            ->get()
        );

        foreach ($notes as $note) {
            if ($note['photo'] !== NULL) {
                
                $url = '';
                $url = Storage::disk('s3')->temporaryUrl(
                    'images/' . $note->filename, now()->addMinutes(5)
                );                
       
                $note['photo'] = $url;
                
                // $url = '';
                // $url = Storage::disk('public')->url('images/' . $note['photo']);
                // $note['photo'] = $url;
                
            }
        }

        
        
        return response()->json([
            'notes' => $notes,
        ]);
    }

    public function fetchDeleted()
    {
        $notes = Note::shortNote(
            Note::where('author', Auth::user()->name)
                ->onlyTrashed()
                ->orderBy('deleted_at', 'desc')
                ->with('tags.tagsType')
                ->get()
        );

        foreach ($notes as $note) {
            if ($note['photo'] !== NULL) {
                $url = '';
                $url = Storage::disk('s3')->temporaryUrl(
                    'images/' . $note->filename, now()->addMinutes(5)
                );                
       
                $note['photo'] = $url;
            }
        }

        return response()->json([
            'notes' => $notes
        ]);
    }

    public function fetchArchived()
    {
        $notes = Note::shortNote(
            Note::where('author', Auth::user()->name)
                ->where('archived', 1)
                ->orderBy('deleted_at', 'desc')
                ->with('tags.tagsType')
                ->get()
        );

        foreach ($notes as $note) {
            if ($note['photo'] !== NULL) {
                $url = '';
                $url = Storage::disk('s3')->temporaryUrl(
                    'images/' . $note->filename, now()->addMinutes(5)
                );                
       
                $note['photo'] = $url;
            }
        }

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
            $fileName = NULL;
            $url = NULL;
            if($request->hasFile('photo'))
            {
                $path = $request->file('photo')->store('images', 's3');

                $fileName = basename($path);
                $url = Storage::disk('s3')->url($path);
                // $fileName = '';
                // $photo = $request->file('photo');
                // $fileName = time() . "." . $photo->getClientOriginalExtension();
                // Image::make($photo)->save(storage_path('app/public/images/' . $fileName));
            }

            
            $note = new Note;
            $note->filename = $fileName;
            $note->photo = $url;
            $note->title = htmlspecialchars($request->input('title'));
            $note->subtitle = htmlspecialchars($request->input('subtitle'));
            $note->content = htmlspecialchars($request->input('content'));
            $note->archived = htmlspecialchars($request->input('archive'));
            $note->author = Auth::user()->name;
            $note->save();

            // $note = Note::find($note->id);
            $note->tags()->attach($request->input('tags'));

            return response()->json([
                'status' => 200,
                'message' => 'Заметка успешно создана',
            ]);
        }  
    }

    public function edit($id)
    {
        $note = Note::withTrashed()->find($id);
        if($note)
        {
            if ($note['photo'] !== NULL) {
                $url = '';
                $url = Storage::disk('s3')->temporaryUrl(
                    'images/' . $note->filename, now()->addMinutes(5)
                );                
       
                $note['photo'] = $url;
                // $url = Storage::disk('public')->url('images/' . $note['photo']);
                // $note['photo'] = $url;
            }
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
                $note->archived = htmlspecialchars($request->input('archive'));
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

    public function restore($id)
    {
        $note = Note::onlyTrashed()->find($id); //->onlyTrashed()
        $note->restore();

        return response()->json([
            'status' => 200,
            'message' => 'Заметка успешно восстановлена',
        ]);
    }

    public function forseDestroy($id)
    {
        $note = Note::onlyTrashed()->find($id);
        $note->forceDelete();
        $note->tags()->detach($note->tags);

        return response()->json([
            'status' => 200,
            'message' => 'Заметка успешно удалена навсегда',
        ]);
    }
}
