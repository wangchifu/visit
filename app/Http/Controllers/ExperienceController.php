<?php

namespace App\Http\Controllers;

use App\Experience;
use App\Http\Requests\ExperienceRequest;
use App\Matchmaking;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($matchmaking)
    {
        $experience = Experience::where('matchmaking_id',$matchmaking)
            ->where('user_id',auth()->user()->id)
            ->first();
        if(empty($experience)){
            return redirect()->route('experiences.create',$matchmaking);
        }else{
            return redirect()->route('experiences.edit',$experience);
        }
    }

    public function guest_index()
    {
        $experiences = Experience::orderBy('id','DESC')
            ->paginate(10);
        $data= [
          'experiences'=>$experiences,
        ];
        return view('experiences.guest_index',$data);
    }

    public function guest_show(Experience $experience)
    {
        $folder = storage_path('app/public/experiences/'.$experience->id);
        $files = get_files($folder);

        $data= [
            'experience'=>$experience,
            'files'=>$files,
        ];
        return view('experiences.guest_show',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Matchmaking $matchmaking)
    {
        $data = [
            'matchmaking'=>$matchmaking,
        ];
        return view('experiences.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //檢查檔案
        $i = 1 ;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];

            if($i>4 or substr($info['mime-type'],0,5) != "image"){
                $words = "一次上傳超過四個檔案，或是有檔案非圖檔！";
                return view('layouts.alert',compact('words'));
            }
            $i++;
            }
        }


        $att['matchmaking_id'] = $request->input('matchmaking_id');
        $att['experience'] = $request->input('experience');
        $att['user_id'] = auth()->user()->id;

        $experience = Experience::create($att);

        $folder = 'experiences/'.$experience->id;

        //處理檔案上傳
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];

                $file->storeAs('public/' . $folder, $info['original_filename']);

            }
        }
        $page = $request->input('page');

        return redirect($page);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Experience $experience)
    {
        $folder = storage_path('app/public/experiences/'.$experience->id);
        $files = get_files($folder);


        $data = [
            'experience'=>$experience,
            'files'=>$files,
        ];
        return view('experiences.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Experience $experience)
    {
        //檢查檔案
        $i = 1 ;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];

                if($i>4 or substr($info['mime-type'],0,5) != "image"){
                    $words = "一次上傳超過四個檔案，或是有檔案非圖檔！";
                    return view('layouts.alert',compact('words'));
                }
                $i++;
            }
        }

        $att['experience'] = $request->input('experience');

        $experience->update($att);

        $folder = 'experiences/'.$experience->id;

        //處理檔案上傳
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];

                $file->storeAs('public/' . $folder, $info['original_filename']);

            }
        }
        $page = $request->input('page');

        return redirect($page);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        if($experience->user_id == auth()->user()->id){
            $experience->delete();

            delete_dir(storage_path('app/public/experiences/'.$experience->id));
        }
        return redirect()->route('back.index');
    }

    public function del_file()
    {
        
    }

    public function all()
    {
        $experiences = Experience::orderBy('id','DESC')->paginate(10);
        $data = [
            'experiences'=>$experiences,
        ];

        return view('experiences.admin_show_all',$data);
    }

    public function admin_destroy(Experience $experience)
    {

        $experience->delete();

        delete_dir(storage_path('app/public/experiences/'.$experience->id));

        return redirect()->route('experience_all');
    }
}
