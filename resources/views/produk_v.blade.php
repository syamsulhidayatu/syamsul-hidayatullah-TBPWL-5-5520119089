@extends('adminlte::page')

@section('title', 'Pengelolaan Produk')

@section('content_header')
<h1 class="text-center text-bold">PENGELOLAAN PRODUK</h1>
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          {{ __('Pengelolaan Produk Setting') }}

        </div>
        <div class="card-body">
          <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> MENAMBAHKAN DATA PRODUK</button>

          <div class="btn-group mb-5" role="group" aria-label="Basis Example">

          </div>
          <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>FOTO</th>
                <th>NAMA</th>
                <th>KATEGORI</th>
                <th>MEREK</th>
                <th>HARGA</th>
                <th>STOK</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach($barang as $key)
              <tr>
                <td>{{$no++}}</td>
                <td>
                  @if($key->photo !== null)
                  <img src="{{ asset('storage/photo_barang/'.$key->photo) }}" width="100px" />
                  @else
                  [Picture Not Found]
                  @endif
                </td>
                <td>{{$key->name}}</td>
                <td>{{$key->categories_id}}</td>
                <td>{{$key->brands_id}}</td>
                <td>{{$key->harga}}</td>
                <td>{{$key->stok}}</td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="btn-edit-buku" class="btn" data-toggle="modal" data-target="#editBukuModal" data-id="{{ $key->id }}"><i class="fa fa-edit"></i></button>
                    <button type="button" id="btn-delete-buku" class="btn" data-toggle="modal" data-target="#deleteBukuModal" data-id="{{ $key->id }}" data-photo="{{ $key->photo }}"><i class="fa fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data PRODUK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
        <form method="post" action="{{ route('admin.product.submit') }}" enctype="multipart/form-data">
          @csrf
          <div class="container-fluid">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Nama</label>
                <input type="text" name="name" placeholder="Masukan Nama Barang" class="form-control" name="name" id="name" required />
              </div>
              <div class="form-group col-md-6 ml-auto">
                <label for="stok">Jumlah</label>
                <input type="number" min="0" class="form-control" placeholder="Masukan Jumlah" name="stok" id="stok" required />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="harga">Harga</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" name="harga" id="harga" min="0" placeholder="Masukan Harga" class="form-control" aria-label="Amount (to the nearest dollar)">

            </div>
          </div>
          <div class="form-group">
            <label for="categories_id">Kategori</label>
            <!-- <input type="text" class="form-control" name="penerbit" id="penerbit" required /> -->
            <div class="input-group">
              <select class="custom-select" name="categories_id" id="categories_id" placeholder="Masukan Kategori barang" id="inputGroupSelect04" aria-label="Example select with button addon">
                <option selected>Pilih Kategori</option>
                @php
                $data=App\Models\Categories::get();
                @endphp
                @foreach($data as $key)
                <option value="{{$key->id}}">{{$key->name}}</option>
                @endforeach
              </select>

            </div>
          </div>
          <div class="form-group">
            <label for="brands_id">Merek</label>
            <!-- <input type="text" class="form-control" name="penerbit" id="penerbit" required /> -->
            <div class="input-group">
              <select class="custom-select" name="brands_id" id="brands_id" placeholder="Masukan Nama Brands" id="inputGroupSelect04" aria-label="Example select with button addon">
                <option selected>Pilih Merek</option>
                @php
                $data=App\Models\Brands::get();
                @endphp
                @foreach($data as $key)
                <option value="{{$key->id}}">{{$key->name}}</option>
                @endforeach

              </select>

            </div>
          </div>
          <div class="form-group">
            <label for="photo">Photo Barang</label>
            <input type="file" class="form-control" placeholder="Masukan Photo barang" name="photo" id="photo" />
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--edit modal Pengelolaan Produk-->
<div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit-name">Nama</label>
                <input type="text" class="form-control" name="name" id="edit-name" required />
              </div>
              <div class="form-group">
                <label for="edit-jumlah">Jumlah</label>
                <input type="number" class="form-control" name="stok" id="edit-jumlah" required />
              </div>
              <div class="form-group">
                <label for="edit-harga">Harga</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" name="harga" id="edit-harga" min="0" class="form-control" aria-label="Amount (to the nearest dollar)">

                </div>
              </div>
              <div class="form-group">
                <label for="edit-kategori">Kategori</label>
                <div class="input-group">
                  <select class="custom-select" name="categories_id" id="edit-kategori" aria-label="Example select with button addon" required>
                    @php
                    $data=App\Models\Categories::get();
                    @endphp
                    @foreach($data as $key)
                    <option value="{{$key->id}}">{{$key->name}}</option>
                    @endforeach
                  </select>

                </div>
              </div>
              <div class="form-group">
                <label for="edit-merek">Merek</label>
                <div class="input-group">
                  <select class="custom-select" name="brands_id" id="edit-merek" aria-label="Example select with button addon" required>
                    @php
                    $data=App\Models\Brands::get();
                    @endphp
                    @foreach($data as $key)
                    <option value="{{$key->id}}">{{$key->name}}</option>
                    @endforeach
                  </select>

                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="image-area"></div>
              <div class="form-group">
                <label for="edit-photo">Photo</label>
                <input type="file" class="form-control" name="photo" id="edit-photo" />
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" id="edit-id" />
        <input type="hidden" name="old_photo" id="edit-old-photo" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--delete modal Pengelolaan Produk-->
<div class="modal fade" id="deleteBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to delete this data <strong class="font-italic" id="delete-name"></strong>?
        <form method="post" action="{{ route('admin.product.delete') }}" enctype="multipart/form-data">
          @csrf
          @method('DELETE')
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" id="delete-id" value="" />
        <input type="hidden" name="old_photo" id="delete-old-photo" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>





@stop
@section('js')
<script>
  $(function() {

    $(document).on('click', '#btn-delete-buku', function() {
      let id = $(this).data('id');
      let photo = $(this).data('photo');
      let name = $(this).data('name');
      $('#delete-id').val(id);
      $('#delete-old-photo').val(photo);
      $('#delete-name').text(name);
      console.log("hallo");
    });



    $(document).on('click', '#btn-edit-buku', function() {
      let id = $(this).data('id');

      $('#image-area').empty();


      $.ajax({
        type: "get",
        url: baseurl + '/admin/ajaxadmin/dataProduct/' + id,
        dataType: 'json',
        success: function(res) {
          $('#edit-id').val(res.id);
          $('#edit-name').val(res.name);
          $('#edit-jumlah').val(res.stok);
          $('#edit-harga').val(res.harga);
          $('#edit-kategori').val(res.categories_id);
          $('#edit-merek').val(res.brands_id);
          $('#edit-old-photo').val(res.photo);

          if (res.photo !== null) {
            $('#image-area').append(
              "<img src='" + baseurl + "/storage/photo_barang/" + res.photo + "' width='200px'/>"
            );
          } else {
            $('#image-area').append('[Gambar tidak tersedia]');
          }
        },
      });
    });

  });
</script>
@stop
@section('js')
<script>

</script>
@stop