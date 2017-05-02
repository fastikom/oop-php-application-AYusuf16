<html>
    <head>
        <title>Aplikasi CRUD Sederhana</title>
        <script src="files/js/jquery.min.js"></script>
        <script src="files/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="files/bootstrap/css/bootstrap.min.css">
    </head>
    <body onload="muatDaftarData();">
    </body>
    <script type="text/javascript">
    </script>

<body onload="muatDaftarData();">
        <div class="col-md-8 col-md-offset-2" ng-controller="listContactCtrl">
            <div class="page-header">
                <h1>
                    Program CRUD Sederhana
                </h1>
                <ul class="nav nav-pills">
                  <li><a id="nav-list-data" href="javascript:void(0);" onclick="gantiMenu('list-data');">Daftar Data</a></li>
                  <li><a id="nav-tambah-data" href="javascript:void(0);" onclick="gantiMenu('tambah-data');">Tambah Data</a></li>
                </ul>
            </div>

            <div id="tambah-data" class="well" style="display:none;">
                <form id="form-data">
                    <div id="name-group" class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" id="Nama" name="Nama" placeholder="..." /><br/>
                    </div>
                    <div id="alamat-group" class="form-group">
                        <label>Alamat:</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="..."" /><br/>
                    </div>
                    <div id="Ketereangan-group" class="form-group">
                        <label>Keterangan:</label>
                        <textarea class="form-control" id="Ketereangan" name="Ketereangan" placeholder="..."></textarea><br/>
                    </div>
                    <input type="button" value="Simpan" onclick="simpanData();" class="btn btn-success btn-small"/>
                    <input type="reset" value="Reset" onclick="" class="btn btn-warning btn-small"/>
                </form>
            </div>
            <div id="edit-data" class="well" style="display:none;">
                <form id="eform-data">

                    <div id="name-group" class="form-group" style="display:none;">
                        <label>ID Data:</label>
                        <input type="text" class="form-control" id="eid_data" name="Nama" placeholder="" /><br/>
                    </div>

                    <div id="name-group" class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" id="eNama" name="Nama" placeholder="..." /><br/>
                    </div>
                    <div id="alamat-group" class="form-group">
                        <label>Alamat:</label>
                        <input type="text" class="form-control" id="ealamat" name="alamat" placeholder="..." /><br/>
                    </div>
                    <div id="Ketereangan-group" class="form-group">
                        <label>Keterangan:</label>
                        <textarea class="form-control" id="eKetereangan" name="Ketereangan" placeholder="..."></textarea><br/>
                    </div>
                    <input type="button" value="Simpan" onclick="simpanEditData();" class="btn btn-success btn-small"/>
                    <input type="reset" value="Reset" onclick="" class="btn btn-warning btn-small"/>
                    <input type="button" value="Batal" onclick="gantiMenu('list-data');" class="btn btn-warning btn-small"/>
                </form>
            </div>
            <div id="list-data" class="well">
                Data Kosong
            </div>
        </div>
    </body>

    <script type="text/javascript">
      function muatDaftarData(){
                  if (localStorage.daftar_data && localStorage.id_data){

                      daftar_data = JSON.parse(localStorage.getItem('daftar_data'));

                      var data_app = "";

                      if (daftar_data.length > 0){
                          data_app = '<table class="table">';
                          data_app += '<thead>'+
                                              '<th>ID</th>'+
                                              '<th>Nama</th>'+
                                              '<th>Alamat</th>'+
                                              '<th>Ketereangan</th>'+

                                            '</thead><tbody>';

                          for (i in daftar_data){
                              data_app += '<tr>';
                              data_app += '<td>'+ daftar_data[i].id_data + ' </td>'+
                                                '<td>'+ daftar_data[i].Nama + ' </td>'+
                                                '<td>'+ daftar_data[i].alamat + ' </td>'+
                                                '<td>'+ daftar_data[i].Ketereangan + ' </td>'+
                                                '<td><a class="btn btn-danger btn-small" href="javascript:void(0)" onclick="hapusData(\''+daftar_data[i].id_data+'\')">Hapus</a></td>'+
                                                '<td><a class="btn btn-warning btn-small" href="javascript:void(0)" onclick="editData(\''+daftar_data[i].id_data+'\')">Edit</a></td>';
                              data_app += '</tr>';

                          }
                         data_app += '</tbody></table>';

                      }
                      else {
                          data_app = "Data Kosong";
                      }


                     $('#list-data').html(data_app);
                     $('#list-data').hide();
                     $('#list-data').fadeIn(100);
                  }
              }

      		function editData(id){

                  if (localStorage.daftar_data && localStorage.id_data){
                      daftar_data = JSON.parse(localStorage.getItem('daftar_data'));
      				idx_data = 0;
                      for (i in daftar_data){
                          if (daftar_data[i].id_data == id){
      						$("#eid_data").val(daftar_data[i].id_data);
      						$("#eNama").val(daftar_data[i].Nama);
      						$("#ealamat").val(daftar_data[i].alamat);
      						$("#eKetereangan").val(daftar_data[i].Ketereangan);
      						daftar_data.splice(idx_data, 1);
                          }
                          idx_data ++;
                      }
      				gantiMenu('edit-data');

                  }

      		}


              function simpanData(){
                  Nama = $('#Nama').val();
                  alamat = $('#alamat').val();
                  Ketereangan = $('#Ketereangan').val();

                  if (localStorage.daftar_data && localStorage.id_data){
                      daftar_data = JSON.parse(localStorage.getItem('daftar_data'));
                      id_data = parseInt(localStorage.getItem('id_data'));
                  }
                  else {
                      daftar_data = [];
                      id_data = 0;
                  }

                  id_data ++;
                  daftar_data.push({'id_data':id_data, 'Nama':Nama, 'alamat':alamat, 'Ketereangan':Ketereangan});
                  localStorage.setItem('daftar_data', JSON.stringify(daftar_data));
                  localStorage.setItem('id_data', id_data);
                  document.getElementById('form-data').reset();
                  gantiMenu('list-data');

                  return false;
              }

              function simpanEditData(){
                  id_data = $('#eid_data').val();
                  Nama = $('#eNama').val();
                  alamat = $('#ealamat').val();
                  Ketereangan = $('#eKetereangan').val();

                  daftar_data.push({'id_data':id_data, 'Nama':Nama, 'alamat':alamat, 'Ketereangan':Ketereangan});
                  localStorage.setItem('daftar_data', JSON.stringify(daftar_data));
                  document.getElementById('eform-data').reset();
                  gantiMenu('list-data');

                  return false;
              }

              function hapusData(id){
                  if (localStorage.daftar_data && localStorage.id_data){
                      daftar_data = JSON.parse(localStorage.getItem('daftar_data'));

                      idx_data = 0;
                      for (i in daftar_data){
                          if (daftar_data[i].id_data == id){
                              daftar_data.splice(idx_data, 1);
                          }
                          idx_data ++;
                      }

                      localStorage.setItem('daftar_data', JSON.stringify(daftar_data));
                      muatDaftarData();
                  }
              }

        function gantiMenu(menu){
            if (menu == "list-data"){
                muatDaftarData();
                $('#tambah-data').hide();
                $('#list-data').fadeIn();
		$('#edit-data').hide();
            }
            else if (menu == "tambah-data"){
                $('#tambah-data').fadeIn();
                $('#list-data').hide();
				$('#edit-data').hide();
            }else if (menu == "edit-data"){
                $('#edit-data').fadeIn();
                $('#tambah-data').hide();
                $('#list-data').hide();
            }
        }
    </script>
</html>
