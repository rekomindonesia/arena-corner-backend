<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Transaksi</title>
</head>
<body>
 
	<h3>Edit Transaksi</h3>
 
	<a href="/list_transaksi"> Kembali</a>
	
	<br/>
	<br/>
 
	@foreach($transaksi as $t)
	<form method="POST" action="/transaksi/update/{{ $t->id_transaksi }}">
	<!-- <form action="{{ url('/transaksi/update')}}" method="POST"> -->
		{{ csrf_field() }}
		@method('PUT')
		ID Transaksi : <input type="text" name="id" value="{{ $t->id_transaksi }}" readonly> 
		<br/>
		Nama : <input type="text" required="required" name="user_id" value="{{ $t->user_id }}" readonly> 
		<br/>
		Nama Toko : <input type="text" required="required" name="id_store" value="{{ $t->id_store }}" readonly> 
		<br/>
		Tanggal Service : <input type="date" required="required" name="tgl_service" value="{{ $t->tgl_service }}" readonly> 
		<br/>
		Catatan Service : <textarea required="required" name="catatan_service" readonly>{{ $t->catatan_service }}</textarea> 
		<br/>
		Status : <input type="text" required="required" name="id_status" value="{{ $t->id_status }}"> 
		<br/>
		<button type="submit"> Simpan </button>
	</form>
	@endforeach
		
 
</body>
</html>