<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		body {
			font-family: arial, sans-serif;
		}
		table {
		  border-collapse: collapse;
		  width: 100%;
		  font-size: 12px;
		}

		#table-data td, #table-data th {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;
		}

/*		tr:nth-child(even) {
		  background-color: #dddddd;
		}*/
		</style>
</head>
<body>
	<center><h3 style="margin-bottom: 30px;">LAPORAN BAHAN BAKU KELUAR</h3></center>
	<table>
		<tr>
			<td style="width: 50px;">Tanggal&nbsp;Laporan</td>
			<td>: {{ date('d/m/Y') }}</td>
		</tr>
		<tr>
			<td>Periode</td>
			<td>: {{ date_format(date_create($tanggal_mulai),'d/m/Y').' - '.date_format(date_create($tanggal_selesai),'d/m/Y') }}</td>
		</tr>
	</table>
	<table width="100%" id="table-data" style="margin-top: 10px;">
			<tr>
				<th style="width: 10px">NO</th>
	            <th>ID TRANSAKSI</th>
	            <th>TANGGAL</th>
	            <th>ID BARANG</th>
	            <th>NAMA BARANG</th>
	            <th>JUMLAH</th>
			</tr>
		@foreach($data as $d)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $d->id_transaksi }}</td>
	            <td>{{ $d->tanggal }}</td>
	            <td>{{ $d->kode_bahan }}</td>
	            <td>{{ $d->nama_bahan }}</td>
	            <td>{{ $d->jumlah }}</td>
			</tr>
			<span style="display: none;">{{ $total += $d->jumlah}}</span>
		@endforeach
		<tr>
			<td colspan="5"><center>TOTAL</center></td>
			<td>{{ $total }}</td>
		</tr>
	</table>	
	<br>
	<br>
	<br>
	<table>
		<tr>
			<td></td>
			<td width="20%" style="text-align: center;">Mengetahui</td>
		</tr>
		<tr>
			<td></td>
			<td width="20%" style="text-align: center;">
				<br>
				<br>
				<br>
				<br>
			</td>
		</tr>
		<tr>
			<td></td>
			<td width="20%" style="text-align: center;">{{ Auth::user()->name }}</td>
		</tr>
	</table>
</body>
</html>