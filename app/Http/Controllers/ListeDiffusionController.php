<?php

namespace App\Http\Controllers;

use App\CategorieProgrammeTv;
use App\ListeDiffusion;
use App\ProgrammeTv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class ListeDiffusionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function list(Request $request, $date)
    {
        $date = Date::now()->format('Y-m-d');
        $datas = ListeDiffusion::whereDate('date_diffusion',Date::now()->format('Y-m-d'))->get();

        //dd($datas);
        return view('admin.listediffusion.index', compact('datas','date'));
    }

    public function search(Request $request)
    {
        $date = Date::now()->format('Y-m-d');
        //dd($request->date_diffusion);
        $datas = ListeDiffusion::whereDate('date_diffusion',$request->date_diffusion)->get();
        //dd($datas);
        return redirect()->route('liste_diffusion.list',compact('datas','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $date = Date::now()->format('Y-m-d');
        $categories = CategorieProgrammeTv::get();
        $programmes = ProgrammeTv::get();
        return view('admin.listediffusion.create', compact('categories','programmes','date'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $programmeTvs = ProgrammeTv::get($request->id);
        $date =  Date::createFromTimeString($request->date_diffusion)->format("Y-m-d");
        $start_date = Date::createFromTimeString($request->date_diffusion);
        $end_date = Date::createFromTimeString($request->date_diffusion)->addSeconds($programmeTvs->duree);
        $dates = ListeDiffusion::whereDate('date_diffusion',$date)
            ->where('date_diffusion','<=',$end_date)
            ->where('date_diffusion','>=',$start_date)->get();
        if(!empty($dates))
        {
            return redirect()->back()->with('danger','Une emission est déja programmée à cette heure');
        }
        $validator = Validator::make($request->all(),
            [
                'title'=>'unique:liste_diffusions'
            ]);
        if($validator->fails())
        {
            return redirect()->back()->withInput()->with('error','Cette liste existe deja');
        }
        else
        {
            ListeDiffusion::create(
                [
                    'title'=>$request->title,
                    'categorie_programme_tv_id'=>$request->categorie_programme_id,
                    'programme_tv_id'=>$request->programme_tv_id,
                    'date_diffusion'=>$request->date_diffusion,
                ]
            );

            return redirect()->back()->with('success','Liste de diffusion enregistrée avec succès');

        }
    }


    public function videoJour($channel)
    {
        $date = Date::now()->format('Y-m-d');
        $datas = ListeDiffusion::where('categorie_programme_tv_id',$channel)
            ->whereDate('date_diffusion',$date)->get();
        return response()->json($datas);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = ListeDiffusion::findOrFail($id);
        $categories = CategorieProgrammeTv::get();
        $programmes = ProgrammeTv::get();
        return view('admin.listediffusion.edit', compact('data','categories','programmes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = ListeDiffusion::findOrFail($id);
        $data->title = $request->title;
        $data->date_diffusion = $request->date_diffusion;
        $data->categorie_programme_tv_id = $request->categorie_programme_id;
        $data->programme_tv_id = $request->programme_tv_id;
        $data->save();
        return redirect()->back()->with('success','Liste de diffusion modifiée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ListeDiffusion $id)
    {
        $id->delete();
        return redirect()->back()->with('error','Liste de diffusion supprimée avec succes');

    }
}
