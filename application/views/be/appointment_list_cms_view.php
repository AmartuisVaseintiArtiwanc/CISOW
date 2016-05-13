<script type="text/javascript">
    
     $(function() {

        $(document).on('click',"ul.pagination li a",function(e){
             var url = $(this).attr("href");
             $.ajax({
                 type: "POST",
                 data: "ajax=1",
                 url: url,
                 beforeSend: function() {
                     $("#page-wrapper").html("");
                 },
                 success: function(msg) {
                     $("#page-wrapper").html(msg);
                     //applyPagination();
                 }
             });
             e.preventDefault();
             return false;
         });                                                                
         
         //For confirmation to delete user item
         function confirmConfirmation(id)
         {
            alertify.confirm("Apakah anda yakin ingin mengkonfirmasi appointment ini ["+id+"] ?", function(e){
                if (e)
                {
                    alertify.success("Berhasil mengkonfirmasi");
                    location.href = "<?= site_url("be/appointment/confirmAppointment")?>"+"/"+id;                                
                }    
            });            
         }

         //For confirmation to delete user item
         function deleteConfirmation(id)
         {
            alertify.prompt("Apakah anda yakin ingin membatalkan apponintment ini ["+id+"], jika ya alasannya ?", function(e, value){
                if (e)
                {
                    alertify.success("Berhasil melakukan cancel dengan alasan -> [ "+value+"]");
                    location.href = "<?= site_url("be/appointment/cancelAppointment")?>"+"/"+id+"/"+value;                                
                }    
            });            
         }
         
         //Delete Button click : for delete (isActive = 0)
         $(".btn-delete").click(function(){
            
            var id = $(this).data("id");
            $("#user-item-id").val(id);
            deleteConfirmation(id);
            
         });

         $(".btn-confirm").click(function(){
            
            var id = $(this).data("id");
            $("#user-item-id").val(id);            
            confirmConfirmation(id);
         });
         
               
        
    }); 
</script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Appointments List Data</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               Appointments Data
            </div>

                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <!--<th>Appointment ID</th>-->
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Nama Perusahaan</th>
							<th>Kategori</th>
							<th>Date/Time</th>
							<th>Lokasi</th>
							<th>Deskripsi</th>
							<th>Status</th>
							<th>Keterangan</th>
                            <th>Action(s)</th>                           
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($data as $row)
                        { 
                        ?>
                        <tr class="appointment-row">
                            <!--<td><?=$row['appointmentID']?></td>-->
                            <td class="nama"><?=$row['nama']?></td>
                            <td class="email"><?=$row['email']?></td>
							<td class="telepon"><?=$row['telp']?></td>
                            <td class="perusahaan"><?=$row['namaPerusahaan']?></td>
                            <td class="kategori"><?=$row['category']?></td>
							<td class="waktu"><?=date("d M Y",strtotime($row['appointmentDatetime'])); ?></td>
							<td class="lokasi"><?=$row['appointmentLocation']?></td>
							<td class="Deskripsi"><?=$row['deskripsi']?></td>
							<td class="status">
                                <?php  
                                    if($row['isSuccess']==true)
                                    {
                                        echo "Success";
                                    }
                                    else if($row['isCancel']==true)
                                    {
                                        echo "Cancelled";
                                    }
                                    else
                                    {
                                        echo "Pending";
                                    }
                                ?>                                    
                            </td>
							<td class="keterangan"><?=$row['cancelReason']?></td>
                            <td class="center">
                                <?php  
                                if($row['isSuccess']==true || $row['isCancel']==true)
                                {?>
                                <button type="button" class="btn btn-primary" disabled="disabled">
                                    Confirm
                                </button>
                                <button type="button" class="btn btn-danger" disabled="disabled">
                                    Cancel
                                </button>
                                <?php 
                                }
                                else
                                {
                                ?>
                                <button type="button" class="btn btn-primary btn-confirm" data-id="<?=$row['appointmentID']?>">
                                    Confirm
                                </button>
                                <button type="button" class="btn btn-danger btn-delete" data-id="<?=$row['appointmentID']?>" >
                                    Cancel
                                </button>
                                <?php 
                                }
                                ?>
                            </td>
                        </tr>
                        <?php 
                        } 
                        ?>
                        </tbody>
                    </table>                   
                </div>                
            <?=$pages?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->