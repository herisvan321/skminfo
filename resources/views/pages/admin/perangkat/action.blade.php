@extends("index")

@section("mainhome")
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Basic form elements</h4>
        <p class="card-description"> Basic form elements </p>
        @if($ckondisi == "form-matakuliah")
        <table class="table table-bordered">
          @foreach($i as $key => $v)
            <tr class="table-success" >
              <td colspan="5"><b>{!! $v->title_menu !!}</b></td>
            </tr>
            @foreach($v->data_content as $keyy => $va)
            <tr>
              <td>&nbsp;&nbsp;&nbsp; File {!! $v->title_menu !!} Ke-{!! $va->no_content !!}</td>
              <td>Tanggal Update <b>{!! $va->tgl_update !!}</b></td>
              <td>
                <a href="{!! $va->file_link !!}" target="_blank">Lihat File</a>
              </td>
              
              <td class="{{ $va->comment == NULL ? 'table-danger' : ''}}">
                <a href="{{ route("home.admin.perangkat.pembelajaran.action", ['show', base64_encode($va->id_content)]) }}">Comment(
                  {{ $va->comment == NULL ? 'ISI' : 'EDIT'}}
                  )</a>
              </td>
              <td>Tanggal Comment <b>{!! $va->tgl_comment !!}</b></td>
            </tr>
            @endforeach
          @endforeach
        </table>
        @elseif($ckondisi == "show")
       <form action="{{ route("home.admin.perangkat.pembelajaran.action", ['update', base64_encode($i->id_content)]) }}" method="POST">
         @csrf
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
              <textarea name="comment" class="form-control" rows="20">{{ $i->comment }}</textarea> <br><br>
              <input type="submit" value="Submit" class="btn btn-primary">
            </td>
          </tr>
        </table>
       </form>
        @endif
      </div>
    </div>
  </div>
@endsection