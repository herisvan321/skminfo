@extends("index")

@section("mainhome")

@if($ckondisi == "inputdata")
@php($nilai = 0)
@php($cid = base64_decode($id))
@php($ceksemester  = DB::table('perkuliahan')->where("id_pekuliahan", $cid)->first())
@foreach($i as $key => $v)
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
    <div class="card-body">
    <h4 class="card-title">{{ $v->title_menu }}</h4>
    </p>
         <table  class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Dokumen</th>
                    <th>Data</th>
                    <th>Tanggal Update</th>
                    <th>Tanggal Komentar</th>
                    <th>Komentar</th>
                </tr>
            </thead>
            <tbody>
            
            @for($a = 0; $a < $v->jlm_list; $a++)
                <tr>
                    <td>{{ $a + 1 }}</td>
                    @php($nilai = $a + 1)
                    <td>
                        @if($v->title_menu == "RPS")
                            <label for="">Dokumen RPS</label>
                        @else
                            <label for="">Pertemuan {{ $a + 1 }}</label>
                        @endif
                    </td>
                    <td>
                        
                        @php($data = DB::table("content")->where("id_user", Auth::user()->id)->where("no_content", $nilai)->where("id_list", $v->id_list)->where("id_semester", $ceksemester->id_semester)->where("id_perkuliahan", $cid)->first())
                        @if(@count((array) $data) < 1)
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#myModal{{ $v->id_list  }}{{ $nilai }}"> <i class=" icon-plus"></i>  Input disini</button>
                        @else
                        <button class="btn btn-success"  data-toggle="modal" data-target="#myModal{{ $v->id_list  }}{{ $nilai }}"> <i class="icon-pencil"></i>  Update</button>
                        @endif
                    </td>
                    <td>
                        @if(@count( (array) $data) > 0)
                        <i class="icon-calendar"></i> <label for="" >  {{ date("d-m-Y", strtotime($data->tgl_update)) }}</label>
                        @endif
                    </td>
                    <td>
                        @if(@count( (array) $data) > 0)
                            @if($data->tgl_comment != NULL)
                               <i class="icon-calendar"></i> <label for="" >  {{ date("d-m-Y H:i:s", strtotime($data->tgl_comment)) }}</label>
                            @endif
                        @endif
                    </td>
                    @if(@count( (array) $data) > 0)
                        @if($data->tgl_comment != NULL)
                            <td class="{{ $data->notif == 1 ? 'table-danger' : ''}}">
                                <center><a href="{{ route("home.perangkat.action", ['show', base64_encode($data->id_content)]) }}">Lihat</a></center>
                            </td>
                        @endif
                    @else
                    <td></td>
                    @endif
                </tr>
                <div class="modal" id="myModal{{ $v->id_list  }}{{ $nilai }}">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Input link 
                        @if($v->id_list == 1)
                        RPS
                        @elseif($v->id_list == 2)
                        SAP
                        @elseif($v->id_list == 3)
                        BAHAN AJAR
                        @endif
                        {{ $nilai }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        @if(@count( (array) $data) > 0)
                        <form action="{{route('home.perangkat.action',['update-inputdata',base64_encode($data->id_content)])}}" method="post">
                        @method("PUT")
                        @else
                        <form action="{{route('home.perangkat.action',['save-inputdata',$id])}}" method="post">
                        @endif
                        @csrf
                            <input type="hidden" name="id_list" value="{{ $v->id_list  }}">
                            <input type="hidden" name="no_content" value="{{ $nilai }}">
                            <div class="row">
                                <div class="col-md-8">
                                    @if(@count( (array) $data) > 0)
                                    <input type="text" name="file_link" class="form-control" placeholder="Enter Link" value="{{ $data->file_link }}">
                                    @else
                                    <input type="text" name="file_link" class="form-control" placeholder="Enter Link">
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                    </div>
                </div>
                </div>
            @endfor
            </tbody>
         </table>
    </div>
</div>
</div>
@endforeach
@elseif($ckondisi == "show")
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Basic form elements</h4>
        <p class="card-description"> Basic form elements </p>
        <table class="table ">
            <tr>
              <td>File Ke</td>
              <td>: {{ $i->no_content }}</td>
            </tr>
            <tr>
              <td>File Link</td>
              <td>: <a href="{!! $i->file_link !!}" target="_blank">Lihat File</a></td>
            </tr>
            <tr>
              <td>Tanggal Update</td>
              <td>: {!! $i->tgl_update !!}</td>
            </tr>
            <tr>
              <td>Tanggal Comment</td>
              <td>: {!! $i->tgl_comment !!}</td>
            </tr>
            <tr>
              <td style="vertical-align: top;">Comment</td>
              <td>
                {{ $i->comment }} <br><br>
                <input type="submit" value="Back" class="btn btn-primary" onclick="self.history.back()">
              </td>
            </tr>
          </table>
        </div>
    </div>
</div>

@endif
@endsection