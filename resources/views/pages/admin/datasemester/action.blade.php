@extends("index")

@section("mainhome")
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Basic form elements</h4>
        <p class="card-description"> Basic form elements </p>
        @if($ckondisi == "save")
        <form class="forms-sample" method="POST" action="{{ route('home.admin.data.semester.save', ['save']) }}">
        @elseif($ckondisi == "show" ||$ckondisi == "show-delete" )
            @if($ckondisi == "show")
                @php($kondisi = "update")
            @elseif($ckondisi == "show-delete")
                @php($kondisi = "delete")
            @endif
        <form class="forms-sample" method="POST" action="{{ route('home.admin.data.semester.action', [$kondisi, base64_encode($i->id_semester)]) }}">
        @endif
            @csrf
        @if($ckondisi == "save")
        <div class="form-group">
            <label for="exampleInputName1">Semester</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Semester" name="semester">
          </div>
        @elseif($ckondisi == "show" ||$ckondisi == "show-delete" )
          <div class="form-group">
            <label for="exampleInputName1">Semester</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Semester" name="semester" value="{{ $i->title_semester }}">
          </div>
        @endif
          
          @if($ckondisi == "save")
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
        @elseif($ckondisi == "show" ||$ckondisi == "show-delete" )
            @if($ckondisi == "show")
                @method("PUT")
                <button type="submit" class="btn btn-success mr-2">Update</button>
            @elseif($ckondisi == "show-delete")
                @method("DELETE")
                <button type="submit" class="btn btn-warning mr-2">Delete</button>
            @endif
        @endif
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
@endsection