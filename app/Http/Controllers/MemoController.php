<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memos = Memo::all();
        return view('memo.index', compact('memos'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content'  => ['required', 'string'],
            'priority' => ['required', 'integer', 'in:1,2,3'],
            'deadline' => ['required', 'date'],
        ]);

        $request->merge(['user_id' => Auth::id()]);
        Memo::create($request->all());
        return redirect()->route('memo.index')->with('status', 'メモを作成しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $memo = Memo::find($id);
        return view('memo.edit', compact('memo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content'  => ['required', 'string'],
            'priority' => ['required', 'integer', 'in:1,2,3'],
            'deadline' => ['required', 'date'],
        ]);

        $memo = Memo::find($id);
        $memo->content = $request->input('content'); // $request->contentは予約語で使用できないためinput()を使用
        $memo->priority = $request->priority;
        $memo->deadline = $request->deadline;
        $memo->save();
        return redirect()->route('memo.index')->with('status', 'メモを更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memo = Memo::find($id);
        $memo->delete();
        return redirect()->route('memo.index')->with('status', 'メモを削除しました！');
    }
}
