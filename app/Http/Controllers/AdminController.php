<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MatakuliahModel;
use App\SemesterModel;
use App\MenuModel;
use App\ContentModel;
use Hash;
use Auth;

class AdminController extends Controller
{
    public function index(){
        return view("pages.admin.index");
    }
    public function dataAkun(Request $r,$kondisi = FALSE,  $id = FALSE){
        $id_user = Auth::user()->id;
        $cid = base64_decode($id);

        $v = "";
        // return $kondisi;

        if($kondisi == "save"){
           $i = new User();
           $i->name = $r->name;
           $i->email = $r->nidn."@stkip.com";
           $i->password = Hash::make($r->password);
           $i->level = 1;
           $i->save();
           return back()->with("sukses", "data berhasil disimpan!");
        }elseif($kondisi == "form"){
            $ckondisi = "save";
            return view("pages.admin.datasemester.action", compact("ckondisi"));
        }elseif($kondisi == "show"){
            $v = User::find($cid);
            $ckondisi = "show";
            return view("pages.admin.datasemester.action", compact("v","ckondisi"));
        }elseif($kondisi == "show-delete"){
            $v = User::find($cid);
            $ckondisi = "show-delete";
            return view("pages.admin.datasemester.action", compact("v","ckondisi"));
        }elseif($kondisi == "update"){
            $i = User::find($cid);
            $i->name = $r->name;
            if($r->password != ""){
                $i->password = Hash::make($r->password);
            }
            $i->update();
            return redirect('/home/admin/new-account')->with("sukses", "data berhasil diupdate!");
        }elseif($kondisi == "delete"){
            $i = User::find($cid);
            $i->delete();
            return redirect('/home/admin/new-account')->with("sukses", "data berhasil dihapus!");
        }

        $i = User::where("level", "!=", 0)->orderBy("id", "desc")->get();
        return view("pages.admin.account.index", compact("i"));
    } 
    public function dataSemester(Request $r,  $kondisi = FALSE, $id = FALSE){
        $id_user = Auth::user()->id;
        $cid = base64_decode($id);

        $v = "";
        // return $kondisi;

        if($kondisi == "save"){
           $i = new SemesterModel();
           $i->title_semester = $r->semester;
           $i->save();
           return back()->with("sukses", "data berhasil disimpan!");
        }elseif($kondisi == "form"){
            $ckondisi = "save";
            return view("pages.admin.datasemester.action", compact("ckondisi"));
        }elseif($kondisi == "show"){
            $i = SemesterModel::find($cid);
            $ckondisi = "show";
            return view("pages.admin.datasemester.action", compact("i","ckondisi"));
            // return $i;
        }elseif($kondisi == "show-delete"){
            $i = SemesterModel::find($cid);
            $ckondisi = "show-delete";
            return view("pages.admin.datasemester.action", compact("i","ckondisi"));
        }elseif($kondisi == "update"){
            $i = SemesterModel::find($cid);
            $i->title_semester = $r->semester;
            $i->update();
            return redirect('/home/admin/data-semester')->with("sukses", "data berhasil diupdate!");
        }

        $i = SemesterModel::orderBy("id_semester", "desc")->get();
        return view("pages.admin.datasemester.index", compact("i"));
    }
    public function perangkatPembelajaran(Request $r,  $kondisi = FALSE, $id = FALSE){
        $i = MatakuliahModel::join('users', 'perkuliahan.id_user', '=', 'users.id')
                            ->join("semester", "perkuliahan.id_semester", "=", "semester.id_semester")
                            ->orderBy("perkuliahan.id_pekuliahan", "desc")->get();
        $selected = 0;
        if($r->semester != ""){
            $selected = $r->semester;
            $i = MatakuliahModel::join('users', 'perkuliahan.id_user', '=', 'users.id')
            ->join("semester", "perkuliahan.id_semester", "=", "semester.id_semester")
            ->orderBy("semester.id_semester", "desc")
            ->where("perkuliahan.id_semester", $selected)
            ->orderBy("perkuliahan.id_pekuliahan", "desc")
            ->get();
        }
        // return $i;

        $id_user = Auth::user()->id;
        $cid = base64_decode($id);

        $v = "";
        // return $kondisi;

        if($kondisi == "save"){
           $i = new SemesterModel();
           $i->title_semester = $r->title;
           $i->save();
           return back()->with("sukses", "data berhasil disimpan!");
        }elseif($kondisi == "form"){
            return view("pages.admin.perangkat.action");
        }elseif($kondisi == "form-matakuliah"){
            $ceksemester = MatakuliahModel::find($cid);

            $i = MenuModel::all();
            $idata = [];
            foreach($i as $key => $vi){
                $idata[$key] = $vi;
                $content = ContentModel::join('users', 'content.id_user', '=', 'users.id')
                ->join("semester", "content.id_semester", "=", "semester.id_semester")
                ->join("perkuliahan", "content.id_perkuliahan", "=", "perkuliahan.id_pekuliahan")
                ->where("content.id_list", $vi->id_list)
                ->where("content.id_perkuliahan", $cid)
                ->where("content.id_semester", $ceksemester->id_semester)
                ->orderBy("content.tgl_update", "desc")
                ->get();
                $idata[$key]->data_content = $content;
            }
            // return $i;
            $ckondisi = "form-matakuliah";
            return view("pages.admin.perangkat.action", compact("i", "ckondisi"));
        }elseif($kondisi == "show"){
            $data = [];
            $i = ContentModel::find($cid);
            $ckondisi = "show";
            return view("pages.admin.perangkat.action", compact("i", "ckondisi"));
        }elseif($kondisi == "show-delete"){
            $i = User::find($cid);
            $ckondisi = "show-delete";
        }elseif($kondisi == "update"){
            $i = ContentModel::find($cid);
            $i->comment = $r->comment;
            $i->tgl_comment = date(now());
            $i->notif = 1;
            $i->update();
            return redirect('/home/admin/perangkat-pembelajaran/action/form-matakuliah/'. base64_encode($i->id_perkuliahan))->with("sukses", "data berhasil diupdate!");
        }

        $semester = SemesterModel::orderBy("id_semester", "desc")->limit(10)->get();
        
        return view("pages.admin.perangkat.index", compact("i", "semester", "selected"));
    }
}
