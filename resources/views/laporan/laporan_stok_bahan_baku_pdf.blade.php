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
	<center><h3 style="margin-bottom: 30px;">LAPORAN STOK BAHAN BAKU</h3></center>
	<table>
		<tr>
			<td style="width: 50px;">Tanggal&nbsp;Laporan</td>
			<td>: {{ date('d/m/Y') }}</td>
		</tr>
	</table>
	<table width="100%" id="table-data" style="margin-top: 10px;">
              <tr>
				<th style="width: 10px">NO</th>
                <th>KODE BAHAN</th>
                <th>NAMA BAHAN</th>
                <th>SATUAN</th>
                <th>JUMLAH</th>
              </tr>
			
		@foreach($data as $d)
			<tr>
				<td>{{ $no++ }}</td>
                  <td>{{ $d->kode_bahan }}</td>
                  <td>{{ $d->nama_bahan }}</td>
                  <td>{{ $d->satuan }}</td>
                  <td>{{ $d->stok }}</td>
			</tr>
			<span style="display: none;">{{ $total += $d->stok}}</span>
		@endforeach
		<tr>
			<td colspan="4"><center>TOTAL</center></td>
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