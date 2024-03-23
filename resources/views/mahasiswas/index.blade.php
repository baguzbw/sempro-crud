<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
                <a id="linkAdmin" class="nav-link" ">Admin</span></a>
            </li>
            <li class="nav-item">
    <a id="homeLink" class="nav-link" href="#">Home</a>
</li>
        </ul>
    </div>
</nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        
                    <a href="{{ route('mahasiswas.create') }}" id="tambahMahasiswa" class="btn btn-md btn-success mb-3">TAMBAH MAHASISWA</a>
                        <input type="text" id="searchInput" class="search form-control mb-3" placeholder="Cari">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">NIM</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">ALAMAT</th>
                                <th scope="col">TANGGAL LAHIR</th>
                                <th scope="col">GENDER</th>
                                <th scope="col">USIA</th>
                                <th id="action" scope="col">ACTION</th>
                              </tr>
                            </thead>
                            <tbody id="tableBody">
                              @forelse ($mahasiswas as $mahasiswa)
                                <tr>
                                    <td>{{ $mahasiswa->nim }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td>{{ $mahasiswa->alamat }}</td>
                                    <td>{{ $mahasiswa->tgl_lahir }}</td>
                                    <td>{{ $mahasiswa->gender }}</td>
                                    <td>{{ $mahasiswa->usia }}</td>                 
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('mahasiswas.destroy', $mahasiswa->id) }}" method="POST">
                                            <a href="{{ route('mahasiswas.edit', $mahasiswa->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <tr>
                                      <td colspan="7" class="text-center">
                                          <div class="alert alert-danger">
                                              Data Mahasiswa belum Tersedia.
                                          </div>
                                      </td>
                                  </tr>
                              @endforelse
                            </tbody>
                            
                          </table>  
                          <div id="genderCount" class="mt-3">
    <strong>Jumlah Pria:</strong> {{ $jumlahPria }}<br>
    <strong>Jumlah Wanita:</strong> {{ $jumlahWanita }}
    <br>
    <strong>Jumlah Siswa:</strong> {{ $jumlahSiswa }}
</div>
                          {{ $mahasiswas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#searchInput').on('keyup', function(){
                var value = $(this).val().toLowerCase();
                $('#tableBody tr').filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
<script>
$(document).ready(function(){    
    $('#homeLink').on('click', function() {
        $('.text-center form').hide(); 
        $('#tambahMahasiswa').hide();
        $('#action').hide();
    });
});
</script>

<script>
$(document).ready(function(){    
    $('#linkAdmin').on('click', function() {
        $('.text-center form').show(); 
        $('#tambahMahasiswa').show();
        $('#action').show();
    });
});
</script>

</body>
</html>
