<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comments = Cache::remember('comments', 60*60*24, function () {
            return Comment::latest()->paginate(25);
        });

        return view('comments.index', [
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {

        $fileName = null;
        $imageName = null;
        // Обработка загрузки
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // Открываем изображение
            $img = Image::make(public_path('images') . '/' . $imageName);

            // Изменяем размер по ширине
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Сохраняем измененное изображение
            $img->save(public_path('images') . '/resize_' . $imageName);

        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
        }

        $comment = [
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'url' => $request->get('url'),
            'text' => $request->get('text'),
            'image' => $imageName,
            'file' => $fileName,
        ];
        Comment::create($comment);

        return redirect()->route('comments.index')->with('success', 'Запись успешно создана.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCommentRequest $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function getJson()
    {
        $comments = Comment::all();

        return response()->json(['comments' => $comments]);

    }

}
