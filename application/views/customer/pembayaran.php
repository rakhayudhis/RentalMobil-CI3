<div class="container"><br><br><br><br><br>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header alert alert-success">
                    Invoice Pembayaran Anda
                </div>
                <div class="card-body">
                    <table class="table">
                        <?php foreach($transaksi as $tr) :?>
                            <tr>
                                <th>Merk Mobil</th>
                                <td>:</td>
                                <td><?php echo $tr->merk?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Rental</th>
                                <td>:</td>
                                <td><?php echo $tr->tanggal_rental?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Kembali</th>
                                <td>:</td>
                                <td><?php echo $tr->tanggal_kembali?></td>
                            </tr>
                            <tr>
                                <th>Biaya Sewa/Hari</th>
                                <td>:</td>
                                <td>Rp. <?php echo number_format($tr->harga,0,',','.') ?></td>
                            </tr>
                            <tr>
                                <?php
                                    $x= strtotime($tr->tanggal_kembali);
                                    $y= strtotime($tr->tanggal_rental);
                                    $jmlHari= abs(($x - $y)/(60*60*24));
                                ?>
                                <th>Jumlah Hari Sewa</th>
                                <td>:</td>
                                <td><?php echo $jmlHari ?> Hari</td>
                            </tr>
                            <tr class="text-success">
                                <th>JUMLAH PEMBAYARAN</th>
                                <td>:</td>
                                <td><button class="btn btn-sm btn-success">Rp. <?php echo number_format($tr->harga * $jmlHari,0,',','.') ?></button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><a href="<?php echo base_url('customer/transaksi/cetak_invoice/'.$tr->id_rental)?>" class="btn btn-sm btn-secondary">Print Invoice</a></td>
                            </tr>
                            
                        <?php endforeach;?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header alert alert-primary">
                    Informasi Pembayaran
                </div>
                <div class="card-body">
                    <p class="text-success mb-3">Silahkan melakukan pembayaran melalui nomor rekening dibawah ini:</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Bank Mandiri 12133244324132</li>
                        <li class="list-group-item">Bank BCA  123213314213</li>
                        <li class="list-group-item">Bank BNI 20398476524345678</li>
                    </ul>

                    <?php 
                        if(empty($tr->bukti_pembayaran)) {?>
                           <button style="width:100%" type="button" class="btn btn-sm btn-danger mt-3" data-toggle="modal" data-target="#myModal">Upload Bukti Pembayaran</button>
                        <?php }elseif($tr->status_pembayaran == '0'){ ?>
                            <button style="width:100%" class="btn btn-sm btn-warning"> <i class="fa fa-clock-o"></i> Menunggu Konfirmasi</button>
                        <?php }elseif($tr->status_pembayaran == '1'){?>
                            <button style="width:100%" class="btn btn-sm btn-success"> <i class="fa fa-check"></i> Pembayaran Selesai</button>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Bukti Pembayaran Anda</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form method="POST" action="<?php echo base_url('customer/transaksi/pembayaran_aksi')?>" enctype="multipart/form-data">
        <div class="modal-body">
            <label>Upload Bukti Pembayaran</label>
            <input type="hidden" name="id_rental" class="form-control" value="<?php echo $tr->id_rental?>">
            <input type="file" name="bukti_pembayaran" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="sumbit" class="btn btn-sm btn-success">Kirim</button>
        </div>
        </div>
    </form>

  </div>
</div>