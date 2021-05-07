@extends("index")

@section("mainhome")
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data Account</h4>
        <a href="{{ route('home.admin.data.semester.save', 'form') }}" class="btn btn-success btn-rounded btn-fw"><i class="icon-note "></i> Account</a>
        <br><br>
        <table class="table table-bordered" id="example">
          <thead>
            <tr>
              <th> # </th>
              <th> Title </th>
              <th> # </th>
            </tr>
          </thead>
          <tbody>
            @foreach($i as $key => $v) 
            <tr>
              <td> {{ $key + 1 }} </td>
              <td> {{ $v->title_semester }} </td>
              <td> 
                <a href="{{ route('home.admin.data.semester.action', ["show", base64_encode($v->id_semester)]) }}">Edit</a> || {{-- <a href="{{ route('home.admin.data.semester.action', ["show-delete", base64_encode($v->id_semester)]) }}">Delete</a>    --}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection