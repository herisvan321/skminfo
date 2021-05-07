@extends("index")

@section("mainhome")
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pilih Semester</h4>
        <div class="row">
          <div class="col-md-3">
            <form action="{{ route('home.admin.perangkat.pembelajaran') }}" method="POST" >
              @csrf
              <select name="semester" class="form-control" onchange="this.form.submit()">
                @foreach($semester as $sem)
                <option value="{{ $sem->id_semester }}" {{ $sem->id_semester == $selected ? "selected='selected'" : '' }}>{{  $sem->title_semester }}</option>
                @endforeach
              </select>
            </form>
          </div>
        </div>
        <br><br>
        <table class="table table-bordered" id="example">
          <thead>
            <tr>
              <th> # </th>
              <th> Perkuliahan </th>
              <th> Semester </th>
              <th> Nama Dosen </th>
              <th> # </th>
            </tr>
          </thead>
          <tbody>
            @foreach($i as $key => $v) 
            <tr>
              <td> {{ $key + 1 }} </td>
              <td> {{ $v->title_perkuliahan }} </td>
              <td> {{ $v->title_semester }} </td>
              <td> {{ $v->name }} </td>
              <td> 
                <a href="{{ route('home.admin.perangkat.pembelajaran.action', ["form-matakuliah", base64_encode($v->id_pekuliahan)]) }}">Lihat</a> || {{-- <a href="{{ route('home.admin.data.semester.action', ["show-delete", base64_encode($v->id_semester)]) }}">Delete</a>    --}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection