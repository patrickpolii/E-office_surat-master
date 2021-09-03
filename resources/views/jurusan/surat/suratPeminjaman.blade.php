@extends('jurusan.default')

@section('css')
<style>
    /*Textbox*/
    .ck-editor__editable {
        min-height: 300px;
        min-width: 860px;
    }
    /*Toolbar*/
    .ck-editor__top {
        min-width: 860px;
    }
</style>
@endsection

@section('page-header')
    Lihat<small> Surat Peminjaman</small>
@endsection

@section('content')

  <div class="col-md-9">
    <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#axe2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="axe3">
        <h6 class="m-0 font-weight-bold text-info">Data Pemohon</h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="axe2">
        <div class="card-body">

          <div class="form-group row pl-3">
            <div class="form-group col-md-4">
              <label for="nama">Nama</label>
              <div class="input-group mb-3">
              <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" autocomplete="nama" value="{{ $surat->user->name}}" readonly>
              </div>
              @error('nama')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group col-md-4">
              <label for="nim">NIM</label>
              <div class="input-group mb-3">
              <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" autocomplete="nim" value="{{ $surat->user->mahasiswa->nim}}" readonly>
              </div>
              @error('nim')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group col-md-4">
              <label for="prodi">Program Studi</label>
              <div class="input-group mb-3">
              <input id="prodi" type="text" class="form-control @error('prodi') is-invalid @enderror" name="prodi" autocomplete="prodi" value="{{ $surat->user->mahasiswa->prodi}}" readonly>
              </div>
              @error('prodi')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

    <div class="col-md-9">
    <div class="card shadow mb-4">
      @if($surat->status_surat == 4)
      {!! Form::model($surat, [
          'route'  => [ JURUSAN . '.surat.tolak', $surat->id ],
          'method' => 'put',
          'files'  => true
        ])
      !!}
      @elseif($surat->status_surat == 6)
      {!! Form::model($surat, [
          'route'  => [ JURUSAN . '.surat.export', $surat->id ],
          'method' => 'put',
          'files'  => true
        ])
      !!}
      @elseif($surat->status_surat == 7)
      {!! Form::model($surat, [
          'route'  => [ JURUSAN . '.surat.persetujuan', $surat->id ],
          'method' => 'put',
          'files'  => true
        ])
      !!}
      @elseif($surat->status_surat == 20)
      {!! Form::model($surat, [
          'route'  => [ JURUSAN . '.surat.penyelesaian', $surat->id ],
          'method' => 'put',
          'files'  => true
        ])
      !!}
      @endif

      <!-- Card Header - Accordion -->
      <a href="#axe3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="axe3">
        <h6 class="m-0 font-weight-bold text-info">Data Surat Peminjaman</h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="axe3">
        <div class="card-body">

          @if($surat->status_surat == 6 || $surat->status_surat == 7 || $surat->status_surat == 19 || $surat->status_surat == 20)
          <div class="form-group">
            <div class="form-group col-md-12">
              <label for="no_surat">Nomor Surat</label>
              <div class="input-group mb-3">
              @if($surat->status_surat == 6)
                <input id="no_surat" type="text" class="form-control @error('no_surat') is-invalid @enderror" name="no_surat" autocomplete="no_surat" required>
              @elseif($surat->status_surat == 7 || $surat->status_surat == 19 || $surat->status_surat == 20)
                <input id="no_surat" type="text" class="form-control @error('no_surat') is-invalid @enderror" name="no_surat" autocomplete="no_surat" value="{{ $surat->no_surat}}" readonly>
              @endif
              </div>
              @error('no_surat')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          @endif
          
          <div class="form-group">
            <div class="form-group col-md-12">
              <label for="tujuan_surat">Tujuan Surat</label>
              <div class="input-group mb-3">
              <textarea id="tujuan_surat" type="text" class="form-control @error('tujuan_surat') is-invalid @enderror ckeditor" rows="30" name="tujuan_surat" autocomplete="tujuan_surat">{{ $surat->surat_peminjaman->tujuan_surat }}</textarea>
              </div>
              <small id="tujuan_surat" class="form-text text-muted">Tujuan surat</small>
              @error('tujuan_surat')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <div class="form-group col-md-12">
              <label for="tujuan">Tujuan Peminjaman</label>
              <div class="input-group mb-3">
              <input id="tujuan" type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" autocomplete="tujuan" value="{{ $surat->surat_peminjaman->tujuan }}" readonly>
              </div>
              <small id="tujuan" class="form-text text-muted">Contoh : Melakukan Rancang Bangun Pembangkit Energi Mikro dari Kebisingan Mesin Berdaya Tinggi</small>
              @error('tujuan')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <div class="form-group col-md-12">
              <label for="objek">Barang / Ruangan yang dipinjam</label>
              <div class="input-group mb-3">
              <input id="objek" type="text" class="form-control @error('objek') is-invalid @enderror" name="objek" autocomplete="objek" value="{{ $surat->surat_peminjaman->objek }}" readonly>
              </div>
              <small id="objek" class="form-text text-muted">Contoh : Ruang Genset ITK</small>
              @error('objek')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group row pl-3">
            <div class="form-group col-md-6">
              <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
              <div class="input-group mb-3">
              <input id="tanggal_peminjaman" type="text" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" name="tanggal_peminjaman" autocomplete="tanggal_peminjaman" value="{{ $surat->surat_peminjaman->tanggal_peminjaman }}" readonly>
              </div>
              <small id="tanggal_peminjaman" class="form-text text-muted">Contoh : 12 Juni - 15 Juli 2021</small>
              @error('tanggal_peminjaman')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group col-md-6">
              <label for="waktu_peminjaman">Waktu Peminjaman</label>
              <div class="input-group mb-3">
              <input id="waktu_peminjaman" type="text" class="form-control @error('waktu_peminjaman') is-invalid @enderror" name="waktu_peminjaman" autocomplete="waktu_peminjaman" value="{{ $surat->surat_peminjaman->waktu_peminjaman }}" readonly>
              </div>
              <small id="waktu_peminjaman" class="form-text text-muted">Contoh : 09.00 - 16.00 WITA</small>
              @error('waktu_peminjaman')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          @if($surat->status_surat == 7 || $surat->status_surat == 19 || $surat->status_surat == 20)
          <div class="form-group">
            <div class="form-group col-md-8">
              <label for="file_surat">Úpload Surat</label>
              <div class="input-group mb-3">
              <input id="file_surat" type="file" class="form-control @error('file_surat') is-invalid @enderror" name="file_surat" autocomplete="file_surat" required>
              @isset($surat->file_surat)
              <div class="input-group-append">
                <a href="{{url('storage/surat/'.$surat->file_surat )}}"class="btn btn-success" download>Download</a>
              </div>
              @endisset
              </div>
              <small id="file_surat" class="form-text text-muted">File scan surat</small>
              <small id="file_surat" class="form-text text-muted">hanya file pdf, max 2 Mb </small>
              @error('file_surat')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          @endif

        @if($surat->status_surat == 4)
        <div class="row pl-3 pr-3">
          <div class="col-sm-8">
              <a href="{{ route(JURUSAN . '.surat.pengajuan') }}" class="btn btn-lg btn-primary">Kembali</a>
          </div>
          <div class="col-sm-2">
              <button type="button" class="btn btn-lg btn-danger form-control" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Tolak</button>

              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Masukan Keterangan Surat Ditolak</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Keterangan:</label>
                        <textarea class="form-control" name="keterangan_surat" id="message-text"></textarea>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Kirim keterangan</button>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>      
          </div>
          <div class="col-sm-2" style="text-align: right">
              <a href="{{ route(JURUSAN . '.surat.verifikasi', $surat->id) }}" class="btn btn-lg btn-success form-control">Verifikasi</a>
          </div>
        </div>
        @elseif($surat->status_surat == 5)
        <div class="row pl-3 pr-3">
          <div class="col-sm-8">
              <a href="{{ route(JURUSAN . '.surat.ditolak') }}" class="btn btn-lg btn-primary">Kembali</a>
          </div>
        </div>
        @elseif($surat->status_surat == 6)
        <div class="row pl-3 pr-3">
          <div class="col-sm-8">
              <a href="{{ route(JURUSAN . '.surat.terverifikasi') }}" class="btn btn-lg btn-primary">Kembali</a>
              <a onClick="window.location.reload()"class="btn btn-lg btn-info">Reload</a>
          </div>
          <div class="col-sm-4" style="text-align: right">
              <button type="submit"class="btn btn-lg btn-success pull-right">
                  {{ __('Cetak') }}
              </button>
          </div>
        </div>
        @elseif($surat->status_surat == 7)
        <div class="row pl-3 pr-3">
          <div class="col-sm-8">
              <a href="{{ route(JURUSAN . '.surat.cetak') }}" class="btn btn-lg btn-primary">Kembali</a>
          </div>
          <div class="col-sm-4" style="text-align: right">
              <button type="submit"class="btn btn-lg btn-success pull-right">
                  {{ __('Teruskan') }}
              </button>
          </div>
        </div>
        @elseif($surat->status_surat == 19)
        <div class="row pl-3 pr-3">
          <div class="col-sm-8">
              <a href="{{ route(JURUSAN . '.surat.menunggu_persetujuan') }}" class="btn btn-lg btn-primary">Kembali</a>
          </div>
        </div>
        @elseif($surat->status_surat == 20)
        <div class="row pl-3 pr-3">
          <div class="col-sm-8">
              <a href="{{ route(JURUSAN . '.surat.disetujui') }}" class="btn btn-lg btn-primary">Kembali</a>
          </div>
          <div class="col-sm-4" style="text-align: right">
              <button type="submit"class="btn btn-lg btn-success pull-right">
                  {{ __('Selesai') }}
              </button>
          </div>
        </div>
        @elseif($surat->status_surat == 21)
        <div class="row pl-3 pr-3">
          <div class="col-sm-8">
              <a href="{{ route(JURUSAN . '.surat.selesai') }}" class="btn btn-lg btn-primary">Kembali</a>
          </div>
        </div>
        @endif

        {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')
<script>
  ClassicEditor
        .create( document.querySelector( '#tujuan_surat' ), {
        toolbar: {
        items: [
          'heading',
          '|',
          'bold',
          'italic',
          '|',
          'bulletedList',
          'numberedList',
          '|',
          'insertTable',
          '|',
          '|',
          'undo',
          'redo'
        ]
      },
        } ).then(editor => { 
          console.log( editor ); 
          editor.isReadOnly = true; // make the editor read-only right after initialization
     } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection