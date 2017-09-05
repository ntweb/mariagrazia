<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  \App\Page::with('created_by');

        if ($request->has('q')) {
            $q = $request->get('q');
            $query =   \App\Page::with('created_by')
                                    ->leftJoin('lab_pages_translations', 'lab_pages.id', '=', 'lab_pages_translations.page_id')
                                    ->where('lab_pages_translations.title', 'LIKE', '%'.$q.'%')
                                    ->orWhere('module', 'LIKE', '%'.$q.'%')
                                    ->orWhere('lab_pages.id', '=', $q);
        }

        return $query->paginate(10);
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

        $page = new \App\Page;
        foreach ($request->all() as $lang => $fields) {            
            foreach ($fields as $field => $value) {
                $page->translateOrNew($lang)->$field = $value;
            }
            $page->id_created_by = 1;

            try {
                $page->save();
            } catch (\PDOException $e) {
                return response()->json(trans('labels.save-error'), 500);
            }

            
        }

        return $page;
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
        $page = \App\Page::find($id);
        if (!$page) 
            return response()->json(trans('labels.not-found-error'), 404);

        $data['el'] = $page;
        foreach ($page->translations()->get() as $k => $v) {
             $data['translations'][$v->locale] = $v;
        }
        return $data;
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
    public function destroy($id)
    {
        //
    }
}
