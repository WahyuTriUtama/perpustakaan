<script type="text/javascript">
    // 1 detik = 1000
    window.setTimeout("waktu()",1000);  
    function waktu() {   
      var tanggal = new Date();  
      setTimeout("waktu()",1000);  
      document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
    }
    </script>
    <script language="JavaScript">
    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;

      var popupWindow = null;
      function centeredPopup(url,winName,w,h,scroll){
      LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
      TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
      settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
      popupWindow = window.open(url,winName,settings)
    }
</script>
<div class="row dashboard-header">
    <div class="col-lg-6">
        <div class="widget gray-bg">
              <h3>Selamat Datang</h3>
              <p>Selamat datang di halaman Aplikasi...!</br> 
               Sistem Informasi <?php echo $this->config->item('site');?>.
               Silahkan klik menu yang berada di sebelah kiri untuk mengelola content Aplikasi Ini
               dan jangan lupa logout..! agar Sistem Informasi Ini Tetap Aman.
        </div>
    </div>
    <div class="col-lg-6">
        <div class="widget white-bg">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="<?php echo base_url('assets/front/img/banner_1.jpg');?>" width="100%" style="height:120px" alt="">  
                    </div>
                    <div class="item">
                      <img src="<?php echo base_url('assets/front/img/banner.jpg');?>" width="100%" style="height:120px" alt="">  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="box">
                <div class="box-title yellow">
                    <h5>Hari ini</h5>
                </div>
                <div class="box-content">
                    <b><script language="javascript">document.write(tanggallengkap);</script></b> - <b id="output" class="jam" ></b> WIB
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box">
                <div class="box-title red">
                    <h5>Aggota</h5>
                </div>
                <div class="box-content">
                    <a href="<?php echo site_url('anggota');?>"><?php echo $dt_anggota;?> Orang</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box">
                <div class="box-title cyan">
                    <h5>Buku</h5>
                </div>
                <div class="box-content">
                    <a href="<?php echo site_url('buku');?>"><?php echo $dt_buku;?> Judul</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box">
                <div class="box-title">
                    <h5>Kategori</h5>
                </div>
                <div class="box-content">
                    <a href="<?php echo site_url('kategori');?>"><?php echo $dt_kategori;?> Kategori</a> 
                </div>
            </div>
        </div>
    </div>
</div> 