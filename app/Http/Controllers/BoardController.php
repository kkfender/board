<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\Board;
use App\Models\Prefecture;
use App\Models\LocalName;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $localNames = LocalName::get()->toArray();
        $prefectures = Prefecture::get()->toArray();
        $boards = Board::with('prefecture')->orderBy('id', 'desc')->get()->toArray();

        return view('boards.index', compact('prefectures', 'localNames', 'boards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder)
    {
        $localName = LocalName::get()->toArray();
        $prefecture = Prefecture::get()->toArray();

        $form = $formBuilder->create(\App\Forms\SubmissionForm::class, [
            'method' => 'POST',
            'url'    => route('boards.store'),
        ]);
        return view('boards.create', compact('form', 'prefecture', 'localName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $board = new Board();

        $board->name  = $request->input('name');
        $board->title = $request->input('title');
        $board->body  = $request->input('body');
        $board->email = $request->input('email');
        $board->prefecture_id = $request->input('prefecture_id');
        $board->operation_key = $request->input('operation_key');

        $board->save();

        return redirect ('boards');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $board = Board::with('prefecture')->find($id)->toArray();
        return view('boards.show', compact('board'));
    }

    public function preEdit(FormBuilder $formBuilder, string $id)
    {
        $form = $formBuilder->create(\App\Forms\PreEditForm::class, [
            'method' => 'GET',
            'url'    => route('boards.edit', $id),
        ]);

        return view('boards.preEdit',compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormBuilder $formBuilder, Request $request)
    {
        $isKey = Board::where('id', $request->input('id'))
                        ->where('operation_key', $request->input('operation_key'))
                        ->first();

        if (is_null($isKey))
        {
            return  back()->with('messages', '編集削除キーが正しくありません');
        }

        $form = $formBuilder->create(\App\Forms\SubmissionForm::class, [
            'method' => 'POST',
            'url'    => route('boards.update', $request->input('id')),
        ]);
        return view('boards.edit', compact('form'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $board = Board::find($id);

        $board->name  = $request->input('name');
        $board->title = $request->input('title');
        $board->body  = $request->input('body');
        $board->email = $request->input('email');
        $board->prefecture_id = $request->input('prefecture_id');
        $board->operation_key = $request->input('operation_key');

        $board->save();

        return view('boards.show', compact('board'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
