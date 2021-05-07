<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MatakuliahModel;
use App\SemesterModel;
use App\MenuModel;
use App\ContentModel;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user->level == 0){
            return redirect("/home/admin");
        }
        $semester = SemesterModel::orderBy("id_semester", "desc")->first();
        $i = MatakuliahModel::where("id_user", $user->id)->where("id_semester", $semester->id_semester)->get();

        if(@count($i) < 1){
            return redirect("/home/matakuliah");
        }
        

        return view('pages.index');
    }

    public function mataKuliah(Request $r,  $kondisi = FALSE, $id = FALSE){
        $id_user = Auth::user()->id;
        $semester = SemesterModel::orderBy("id_semester", "desc")->first();
        $cid = base64_decode($id);

        $ckondisi = "view";

        $v = "";

        if($kondisi == "save"){
           $i = new MatakuliahModel();
           $i->id_user = $id_user;
           $i->id_semester = $semester->id_semester;
           $i->title_perkuliahan = $r->title;
           $i->kode_matkul = $r->kode_matkul;
           $i->save();
           return back()->with("sukses", "data berhasil disimpan!");
        }elseif($kondisi == "show"){
            $v = MatakuliahModel::find($cid);
            $ckondisi = "show";
            // return $i;
        }elseif($kondisi == "show-delete"){
            $i = MatakuliahModel::find($cid);
            $ckondisi = "show-delete";
        }elseif($kondisi == "update"){
            $i = MatakuliahModel::find($cid);
            $i->title_perkuliahan = $r->title;
            $i->kode_matkul = $r->kode_matkul;
            $i->update();
            return redirect('/home/matakuliah')->with("sukses", "data berhasil diupdate!");
        }

        // view data
        $i = MatakuliahModel::where("id_user", $id_user)->orderBy("id_pekuliahan", "desc")->paginate(21);
        // end view data
        // Auth::logout();
        return view("pages.matakuliah.index", compact('i', 'ckondisi', 'v'));
    }
    public function inputData(Request $r,  $kondisi = FALSE, $id = FALSE){
        $id_user = Auth::user()->id;
        $semester = SemesterModel::orderBy("id_semester", "desc")->first();
        $cid = base64_decode($id);

        if ($kondisi == "inputdata" ) {
            $i = MenuModel::All ();
            $ckondisi = "inputdata";
            return view("pages.dataInput.home", compact('i','id', 'semester', 'ckondisi'));
        }elseif($kondisi == "show"){
            $i = ContentModel::find($cid);
            $i->notif = 0;
            $i->update();
            $ckondisi = "show";
            return view("pages.dataInput.home", compact('i','id', 'semester', 'ckondisi'));
        }elseif ($kondisi == "save-inputdata"){
            $i = New ContentModel();
            $i ->no_content = $r->no_content;
            $i ->id_user = $id_user;
            $i ->id_list = $r->id_list;
            $i ->id_semester = $semester->id_semester;
            $i ->id_perkuliahan = $cid;
            $i ->file_link = $r->file_link;
            $i ->tgl_update = date('Y-m-d');
            $i ->notif = 0;
            $i ->save();
            return back ()->with("sukses", "data berhasil disimpan!");

        } elseif ($kondisi == "update-inputdata"){
            $i = ContentModel::find($cid);
            $i->file_link = $r->file_link;
            $i->tgl_update = date('Y-m-d');
            $i->update();
            return back ()->with("sukses", "data berhasil diupdate!");

        }
        $i = MatakuliahModel::where("id_user", $id_user)->orderBy("id_pekuliahan", "desc")->paginate(21);
        // end view data
        return view("pages.dataInput.index", compact('i'));
    }
}
