<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Info;
use App\Models\Memo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $infos = Info::all();

        $memos = Memo::where('user_id', Auth::user()->id)->get();

        return view('admin.index', [
            'infos' => $infos,
            'memos' => $memos,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!empty($request->info_submit)) {
            try {
                DB::transaction(function () use ($request) {
                    Info::create([
                        'user' => Auth::user()->name,
                        'contents' => $request->contents,
                        'date' => $request->date,
                    ]);
                });
            } catch (Throwable $e) {
                Log::error($e);
                throw $e;
            }

            return to_route('admin.index')->with(['message' => '業務連絡を追加しました。']);
        } elseif (!empty($request->memo_submit)) {

            try {
                DB::transaction(function () use ($request) {
                    Memo::create([
                        'user_id' => Auth::user()->id,
                        'memo' => $request->memo,
                        'date' => $request->date,
                    ]);
                });
            } catch (Throwable $e) {
                Log::error($e);
                throw $e;
            }

            return to_route('admin.index')->with(['message' => '自分メモを追加しました。']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if (!empty($request->info_delete)) {
            Info::find($id)->delete();

            return redirect()->route('admin.index')->with(['message' => '業務連絡１件削除しました。']);

        } elseif ($request->memo_complete) {
            Memo::find($id)->delete();

            return redirect()->route('admin.index')->with(['message' => '完了しました。']);
        }
    }
}
