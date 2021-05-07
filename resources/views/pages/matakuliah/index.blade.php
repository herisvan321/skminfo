@extends("index")

@section("mainhome")
<div class="row quick-action-toolbar">
    <div class="col-md-12 grid-margin">
    <div class="card">
        <div class="card-header d-block d-md-flex">
        <h5 class="mb-0">Inputkan Mata Kuliah</h5>
        <p class="ml-auto mb-0"><i class="icon-bulb"></i></p>
        </div>
        @if($ckondisi == "view")
        <form action="{{ route('home.matakuliah.save', ['save']) }}" method="post" >
        @elseif($ckondisi == "show" ||$ckondisi == "show-delete" )
        <form action="{{ route('home.matakuliah.action', ['update', base64_encode($v->id_pekuliahan)]) }}" method="post" >
          @method("PUT")
        @endif
        @csrf
        <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
        @if($ckondisi == "view")
        <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
            <input type="text" class="form-control" placeholder="Enter Kode Matakuliah" required="required" name="kode_matkul">
        </div>
        <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
            <input type="text" class="form-control" placeholder="Enter judul Matakuliah" required="required" name="title">
        </div>
        <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
        <button type="submit" class="btn px-0"><i class="icon-book-open mr-2"></i> Simpan</button>
        </div> 
        @elseif($ckondisi == "show" ||$ckondisi == "show-delete" )
        <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
            <input type="text" class="form-control" placeholder="Enter Kode Matakuliah" required="required" name="kode_matkul" value="{{ $v->kode_matkul }}">
        </div>
        <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
            <input type="text" class="form-control" placeholder="Enter judul Matakuliah" required="required" name="title" value="{{ $v->title_perkuliahan }}">
        </div>
        <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
        <button type="submit" class="btn px-0"><i class="icon-book-open mr-2"></i> Update</button>
        </div> 
        @endif
            
        </div>
        </form>
    </div>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Bordered table</h4>
                    <p class="card-description"> Add class <code>.table-bordered</code>
                    </p>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Kode MataKuliah </th>
                          <th> MataKuliah </th>
                          <th> semester </th>
                          <th>  </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($i as $key => $v)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td> {{ $v->kode_matkul }}</td>
                          <td> {{ $v->title_perkuliahan }}</td>
                          <td>
                            @php($semester = DB::table("semester")->where("id_semester", $v->id_semester)->first())
                            {{ $semester->title_semester }}
                          </td>
                          <td> 
                            <a href="{{ route('home.matakuliah.action', ['show', base64_encode($v->id_pekuliahan)])  }}" class="btn btn-primary">Edit</a>
                          </td>
                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
@endsection