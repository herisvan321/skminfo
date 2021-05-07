@extends("index")

@section("mainhome")
<div class="row quick-action-toolbar">
    <div class="col-md-12 grid-margin">
    <div class="card">
        <div class="card-header d-block d-md-flex">
        <h5 class="mb-0">Inputkan Mata Kuliah</h5>
        <p class="ml-auto mb-0"><i class="icon-bulb"></i></p>
        </div>
        <form action="">
        <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
            <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
                <input type="text" class="form-control" placeholder="Enter Kode Matakuliah" required="required">
            </div>
            <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
                <input type="text" class="form-control" placeholder="Enter judul Matakuliah" required="required">
            </div>
            <div class="col-sm-6 col-md-4 p-4 text-center btn-wrapper">
            <button type="submit" class="btn px-0"><i class="icon-book-open mr-2"></i> Simpan</button>
            </div>
            
        </div>
        </form>
    </div>
    </div>
</div>
@endsection