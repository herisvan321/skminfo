@extends("index")

@section("mainhome")
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data Account</h4>
        <a href="{{ route('home.adminnew.account.save', 'form') }}" class="btn btn-success btn-rounded btn-fw"><i class="icon-note "></i> Account</a>
        <br><br>
        <table class="table table-bordered" id="example">
          <thead>
            <tr>
              <th> # </th>
              <th> NIDN </th>
              <th> NAME </th>
              <th> EMAIL </th>
              <th> # </th>
            </tr>
          </thead>
          <tbody>
            @foreach($i as $key => $v) 
            <tr>
              <td> {{ $key + 1 }} </td>
              <td>
                @php($nidn = explode("@", $v->email))
                {{ $nidn[0] }}
              </td>
              <td> {{ $v->name }} </td>
              <td> {{ $v->email }} </td>
              <td> 
                <a href="{{ route('home.adminnew.action', ["show", base64_encode($v->id)]) }}">Edit</a> || <a href="{{ route('home.adminnew.action', ["show-delete", base64_encode($v->id)]) }}">Delete</a>    
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection