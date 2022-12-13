<?php
    session_start();

    //conection to database
    $conn = mysqli_connect("localhost","root","","invoicedatafutari");

    //Meanmbahkn data
    if(isset($_POST['addnewdata'])){
        $theitem = $_POST['theitem'];
        $theitems = $_POST['theitems'];
        $theitemss = $_POST['theitemss'];
        $qty = $_POST['quantity'];
        $unit = $_POST['unit'];
        $ppn = $_POST['ppn'];
        $invoicenum = $_POST['invoicenum'];
        $date = $_POST['date'];
        $ponum = $_POST['ponum'];
        $donum = $_POST['donum'];
        $termofpayment = $_POST['termofpayment'];
        $currency = $_POST['currency'];

            $addtotable = mysqli_query($conn,"insert into maindata (clientid, payid, proid, quantity, unit, ppn, invoicenum, date, ponum, donum, termofpayment, currency)values('$theitem','$theitems','$theitemss','$qty','$unit','$ppn','$invoicenum','$date','$ponum','$donum','$termofpayment','$currency')");

            if($addtotable){
                header("location:index.php");
            } else {
                echo "Gagal";
                header("location:index.php");
            }
        }

    //Meanmbahkn data produk
    if(isset($_POST['addnewproduk'])){
        $proname = $_POST['proname'];
        $prodesc = $_POST['prodesc'];
        $price = $_POST['price'];

         //memasukan gambar
         $allowed_extension = array('png','jpg','jpeg','jfif');
         $nama = $_FILES['file']['name'];
         $dot = explode('.',$nama);
         $ekstensi = strtolower(end($dot));
         $ukuran = $_FILES['file']['size'];
         $file_tmp = $_FILES['file']['tmp_name'];
 
         //penamaan file -> enskripsi ny
         $proimg = md5(uniqid($nama,true) . time()).'.'.$ekstensi;
 
         $cek = mysqli_query($conn,"select * from produk where proname='$proname'");
         $hitung = mysqli_num_rows($cek);

        if($hitung<1){
            if(in_array($ekstensi, $allowed_extension) === true){
                if($ukuran < 15000000){
                    move_uploaded_file($file_tmp, 'img/'.$proimg);
            $addtotable = mysqli_query($conn,"insert into produk (proname, prodesc, price, proimg) values('$proname','$prodesc', '$price', '$proimg')");
            if($addtotable){
                header("location:produk.php");
            } else {
                echo "Gagal";
                header("location:produk.php");
            }
        } else {
            //klo file ny lebih dari 15mb
            echo '
        <script>
            alert("Ukuran file terlalu besar, maksimal 15MB");
            window.location.href="produk.php";
        </script>
        ';
        }
    } else {
        //klo file ny g di izin kan (png, jpg)
        echo '
        <script>
            alert("Make sure your file are JPG/JPEG/JFIF/PNG");
            window.location.href="produk.php";
        </script>
        ';
    }
} else {
    echo '
    <script>
        alert("nama barang sudah terdaftar");
        window.location.href="produk.php";
    </script>
    ';
}
    }

    //Meanmbahkn data client
    if(isset($_POST['addnewclient'])){
        $compnames = $_POST['compnames'];
        $compaddress = $_POST['compaddress'];
        $compcontnum = $_POST['compcontnum'];
        $customernem = $_POST['customernem'];
        $manageria = $_POST['manageria'];
        $cdi = $_POST['clientid'];

         //memasukan gambar
         $allowed_extension = array('png','jpg','jpeg','jfif');
         $nama = $_FILES['file']['name'];
         $dot = explode('.',$nama);
         $ekstensi = strtolower(end($dot));
         $ukuran = $_FILES['file']['size'];
         $file_tmp = $_FILES['file']['tmp_name'];
 
         //penamaan file -> enskripsi ny
         $comlog = md5(uniqid($nama,true) . time()).'.'.$ekstensi;
 
         $cek = mysqli_query($conn,"select * from client where compnames='$compnames'");
         $hitung = mysqli_num_rows($cek);
 
            
        if($hitung<1){
            if(in_array($ekstensi, $allowed_extension) === true){
                if($ukuran < 15000000){
                    move_uploaded_file($file_tmp, 'img/'.$comlog);
            $addtotable = mysqli_query($conn,"insert into client (compnames, compaddress, compcontnum, customernem, manageria, comlog) values('$compnames','$compaddress','$compcontnum','$customernem','$manageria','$comlog')");
            if($addtotable){
                header("location:client.php");
            } else {
                echo "Gagal";
                header("location:client.php");
            }
        } else {
            //klo file ny lebih dari 15mb
            echo '
        <script>
            alert("Ukuran file terlalu besar, maksimal 15MB");
            window.location.href="client.php";
        </script>
        ';
        }
    } else {
        //klo file ny g di izin kan (png, jpg)
        echo '
        <script>
            alert("Make sure your file are JPG/JPEG/JFIF/PNG");
            window.location.href="client.php";
        </script>
        ';
    }
} else {
    echo '
    <script>
        alert("nama barang sudah terdaftar");
        window.location.href="client.php";
    </script>
    ';
}
    }

    //Manambahkan Data Payment
    if(isset($_POST['addnewbank'])){
        $bankname = $_POST['bankname'];
        $bankaccount = $_POST['bankaccount'];
        $banknumber = $_POST['banknumber'];
        $pdi = $_POST['payid'];

        $addtopay = mysqli_query($conn,"insert into payment (bankname, bankaccount, banknumber) values ('$bankname','$bankaccount','$banknumber')");
        if($addtopay){
            header("location:payment.php");
        } else {
            echo "gagal";
            header("location:payment.php");
        }
    }

    //Update invoice info
    if(isset($_POST['updatedata'])){
        $qty = $_POST['quantity'];
        $unit = $_POST['unit'];
        $idi = $_POST['idi'];
        $ppn = $_POST['ppn'];
        $invoicenum = $_POST['invoicenum'];
        $date = $_POST['date'];
        $ponum = $_POST['ponum'];
        $donum = $_POST['donum'];
        $termofpayment = $_POST['termofpayment'];
        $currency = $_POST['currency'];{

            //jika tidak ingin upload 
            $update = mysqli_query($conn,"update maindata set description='$description', quantity='$qty', unit='$unit', price='$price', ppn='$ppn', invoicenum='$invoicenum', date='$date', ponum='$ponum', donum='$donum', termofpayment='$termofpayment', currency='$currency' where invoiceid='$idi'");
            if($update){
                header('location:index.php');
            } else {
                echo 'Gagal';
                header('location:index.php');
        }
    }
    }
    //Update payment info
    if(isset($_POST['updatepayment'])){
        $bankname = $_POST['bankname'];
        $bankaccount = $_POST['bankaccount'];
        $banknumber = $_POST['banknumber'];
        $pdi = $_POST['pdi'];

            //jika tidak ingin upload 
            $update = mysqli_query($conn,"update payment set bankname='$bankname', bankaccount='$bankaccount', banknumber='$banknumber' where payid='$pdi'");
            if($update){
                header('location:payment.php');
            } else {
                echo 'Gagal';
                header('location:payment.php');
        }
    }
    

    //Update produk info
    if(isset($_POST['updateproduk'])){
        $rdi = $_POST['rdi'];
        $proname = $_POST['proname'];
        $prodesc = $_POST['prodesc'];
        $price = $_POST['price'];

        $allowed_extension = array('png','jpg');
        $nama = $_FILES['file']['name'];
        $dot = explode('.',$nama);
        $ekstensi = strtolower(end($dot));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        //penamaan file -> enskripsi ny
        $proimg = md5(uniqid($nama,true) . time()).'.'.$ekstensi;

        if($ukuran==0){

            //jika tidak ingin upload 
            $update = mysqli_query($conn,"update produk set proname='$proname', prodesc='$prodesc', price='$price' where proid='$rdi'");
            if($update){
                header('location:produk.php');
            } else {
                echo 'Gagal';
                header('location:produk.php');
        }
    } else {
        //jika ingin upload gambar
        move_uploaded_file($file_tmp, 'img/'.$proimg);
        $update = mysqli_query($conn,"update produk set proname='$proname', prodesc='$prodesc', price='$price', proimg='$proimg' where proid='$rdi'");
        if($update){
            header('location:produk.php');
        } else {
            echo 'Gagal';
            header('location:produk.php');
        }
    }
    }

    //Update client info
    if(isset($_POST['updateclient'])){
        $compnames = $_POST['compnames'];
        $compaddress = $_POST['compaddress'];
        $compcontnum = $_POST['compcontnum'];
        $customernem = $_POST['customernem'];
        $manageria = $_POST['manageria'];
        $cdi = $_POST['cdi'];

        $allowed_extension = array('png','jpg');
        $nama = $_FILES['file']['name'];
        $dot = explode('.',$nama);
        $ekstensi = strtolower(end($dot));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        //penamaan file -> enskripsi ny
        $comlog = md5(uniqid($nama,true) . time()).'.'.$ekstensi;

        if($ukuran==0){

            //jika tidak ingin upload 
            $update = mysqli_query($conn,"update client set compnames='$compnames', compaddress='$compaddress', compcontnum='$compcontnum', customernem='$customernem', manageria='$manageria' where clientid='$cdi'");
            if($update){
                header('location:client.php');
            } else {
                echo 'Gagal';
                header('location:client.php');
        }
    } else {
        //jika ingin upload gambar
        move_uploaded_file($file_tmp, 'img/'.$comlog);
        $update = mysqli_query($conn,"update client set compnames='$compnames', compaddress='$compaddress', compcontnum='$compcontnum', customernem='$customernem', manageria='$manageria', comlog='$comlog' where clientid='$cdi'");
        if($update){
            header('location:client.php');
        } else {
            echo 'Gagal';
            header('location:client.php');
        }
    }
    }

    //Delete invoice info
    if(isset($_POST['deletedata'])){
        $idi = $_POST['idi'];

        $delete = mysqli_query($conn, "delete from maindata where invoiceid='$idi'");
        if($delete){
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
    }

    //Delete produk info
    if(isset($_POST['deleteproduk'])){
        $rdi = $_POST['rdi'];

        $delete = mysqli_query($conn, "delete from produk where proid='$rdi'");
        if($delete){
            header('location:produk.php');
        } else {
            echo 'Gagal';
            header('location:produk.php');
        }
    }

    //Delete client info
    if(isset($_POST['deleteclient'])){
        $cdi = $_POST['cdi'];

        $delete = mysqli_query($conn, "delete from client where clientid='$cdi'");
        if($delete){
            header('location:client.php');
        } else {
            echo 'Gagal';
            header('location:client.php');
        }
    }
    
    //Delete payment info
    if(isset($_POST['deletepayment'])){
        $pdi = $_POST['pdi'];

        $delete = mysqli_query($conn, "delete from payment where payid='$pdi'");
        if($delete){
            header('location:payment.php');
        } else {
            echo 'Gagal';
            header('location:payment.php');
        }
    }

    //menambhakan admin baru
    if(isset($_POST['addnewadmin'])){
        $access = $_POST['access'];
        $idu = $_POST['userid'];
        $pass = $_POST['password'];
        $username = $_POST['username'];
        $status = $_POST['status'];
        $kelas = $_POST['kelas'];
        // $name = $_POST['name'];

        $confirmation = mysqli_query($conn, "select username from user where username='$username'");
        if(mysqli_fetch_assoc($confirmation)){
            echo "<script> alert('account already registered')</script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $queryinsert = mysqli_query($conn,"insert into user (access, username, password) values ('$access','$username','$password')");

        if($queryinsert){
            header('location:admin.php');
        } else {
            echo 'Gagal';
            header('location:admin.php');
        }
    }

    //edit data admin
    if(isset($_POST['updatestatus'])){
        $status = $_POST['status'];
        $idny = $_POST['idu'];

        $queryupdate = mysqli_query($conn,"update user set status='$status' where userid='$idny'");

        if($queryupdate){
            header('location:admin.php');
        } else {
            echo 'Gagal';
            header('location:admin.php');
        }
    }

    //edit data admin access
    if(isset($_POST['updateaccess'])){
        $access = $_POST['access'];
        $idny = $_POST['idu'];

        $queryupdate = mysqli_query($conn,"update user set access='$access' where userid='$idny'");

        if($queryupdate){
            header('location:admin.php');
        } else {
            echo 'Gagal';
            header('location:admin.php');
        }
    }
    
    //edit data admin password
    if(isset($_POST['updatepass'])){
        $passbaru = $_POST['passbaru'];
        $passbarucon = $_POST['passbarucon'];
        $idny = $_POST['idu'];

        if($passbaru !== $passbarucon){
            echo "<script>
                    alert('confirmation failed')
            </script>";
            return false;
        }

        $passbaru = password_hash($passbaru, PASSWORD_DEFAULT);

        $queryupdate = mysqli_query($conn,"update user set password='$passbaru' where userid='$idny'");

        if($queryupdate){
            header('location:admin.php');
        } else {
            echo 'Gagal';
            header('location:admin.php');
        }
    }

    //deleteadmin
    if(isset($_POST['deleteadmin'])){
        $idny = $_POST['idu'];

        $querydelete = mysqli_query($conn,"delete from user where userid='$idny'");

        if($querydelete){
            header('location:admin.php');
        } else {
            header('location:admin.php');
        }
    }

    //registration
    function registrasi($data) {
        global $conn;
        $username = strtolower(stripslashes($data['username']));
        $access = strtolower(stripslashes($data['access']));
        $status = strtolower(stripslashes($data['status']));
        $password = mysqli_real_escape_string($conn, $data['password']);
        $confirmpassword = mysqli_real_escape_string($conn, $data['confirmpassword']);
        $request = $data['request'];

        $confirmation = mysqli_query($conn, "select username from user where username='$username'");
        if(mysqli_fetch_assoc($confirmation)){
            echo "<script> alert('account already registered')</script>";
            return false;
        }

        if($password !== $confirmpassword){
            echo "<script>
                    alert('confirmation failed')
            </script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        
        mysqli_query($conn, "insert into user values('','$access','$username','$password','$status')");
        mysqli_query($conn, "insert into request values('','$request')");
        return mysqli_affected_rows($conn);

    }

?>