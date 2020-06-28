@extends('layouts.app')

@section('content')
<!--    <head>
      <title>View Transaksi Records</title>
   </head>
   --> 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Data Transaksi</div>
                <div class="panel-body">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col"><center>No</center></th>
                          <th scope="col"><center>No. Transaksi</center></th>
                          <th scope="col"><center>Nama</center></th>
                          <th scope="col"><center>Toko</center></th>
                          <th scope="col"><center>Tanggal Service</center></th>
                          <th scope="col"><center>Catatan Service</center></th>
                          <th scope="col"><center>Status</center></th>
                          <th scope="col"><center>Button</center></th>
                        </tr>
                      </thead>
                       <?php $no = 0;?>
                       @foreach ($transaksi as $t)
                       <?php $no++ ;?>
                       <tbody>
                       <tr>
                          <td><center>{{ $no }}</center></td>
                          <td><center>{{ $t->id_transaksi }}</center></td>
                          <td><center>{{ $t->name }}</center></td>
                          <td><center>{{ $t->name_store }}</center></td>
                          <td><center>{{ $t->tgl_service }}</center></td>
                          <td>{{ $t->catatan_service }}</td>
                          <td><center>{{ $t->nama_status }}</center></td>
                          <td><a href="/transaksi/edit/{{ $t->id_transaksi }}">Edit</a>
                          |    
                            <a href="/transaksi/hapus/{{ $t->id_transaksi }}">Hapus</a>
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