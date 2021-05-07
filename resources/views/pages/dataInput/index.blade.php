@extends("index")

@section("mainhome")
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
                          <th> Semester </th>
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
                            <a href="{{route('home.perangkat.action',['inputdata', base64_encode($v->id_pekuliahan)])}}" class="btn btn-primary">Cek data</a>
                          </td>
                        </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
@endsection