@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Bukti Transaksi</div>
                <div class="panel-body">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col"><center>No</center></th>
                          <th scope="col"><center>No. Bukti</center></th>
                          <th scope="col"><center>No. Transaksi</center></th>
                          <th scope="col"><center>Tanggal Service</center></th>
                          <th scope="col"><center>Catatan Service</center></th>
                          <th scope="col"><center>Bukti Transfer</center></th>
                          <th scope="col"><center>Button</center></th>
                        </tr>
                      </thead>
                       <?php $no = 0;?>
                       @foreach ($bukti as $b)
                       <?php $no++ ;?>
                       <tbody>
                       <tr>
                          <td><center>{{ $no }}</center></td>
                          <td><center>{{ $b->id_bukti }}</center></td>
                          <td><center>{{ $b->id_transaksi }}</center></td>
                          <td><center>{{ $b->tgl_service }}</center></td>
                          <td>{{ $b->catatan_service }}</td>
                          <td><img src="storage/app/public/ {{ $b->img_tf }}" height="100px" width="100px"></td>
                          <td><a href="/bukti/edit/{{ $b->id_bukti }}">Edit</a>
                          |    
                            <a href="/bukti/hapus/{{ $b->id_bukti }}">Hapus</a>
                          </td>
                       </tr>
                     </tbody>
                       @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection