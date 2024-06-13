<h2 >Input Data Order</h2>
<form action="order_proses.php" method="post" >

<table class="masukkan">
    <tr>
        <td>NAMA</td>
        <td><input type="text" name="order_nama" id="nama" onblur="cek_valid2()">
        <label id="namaError" style="color:red"></label></td>
    </tr>
    <tr>
        <td>HP</td>
        <td><input type="text" name="order_hp" id="hp" onblur="cek_valid2()">
        <label id="hpError" style="color:red"></label></td>
        
    </tr>
    <tr>
        <td>TANGGAL</td>
        <td><input type="date" name="order_tanggal" required></td>
    </tr>
    <tr>
        <td>Makanan</td>
        <td>
            <select name="order_paket" id="makanan" onchange="hitungHarga()">
                <option value="">--PILIH MAKANAN--</option>
                <option value="Empek-Empek">Empek-Empek (Rp 500.000)</option>
                <option value="Bakso Pedas">Bakso Pedas (Rp 350.000)</option>
                <option value="Sate Padang">Sate Padang (Rp 215.000)</option>
                <option value="Ayam Bakar">Ayam Bakar (Rp 275.000)</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Tambahan</td>
        <td>
            <input type="checkbox" name="order_tambahan[]" value="Nasi" onchange="hitungHarga()"> Extra Nasi (Rp 150.000)<br>
            <input type="checkbox" name="order_tambahan[]" value="Sambal" onchange="hitungHarga()"> Extra Sambal (Rp 100.000)<br>
            <input type="checkbox" name="order_tambahan[]" value="Kuah" onchange="hitungHarga()"> Extra Kuah (Rp 75.000)<br>
        </td>
    </tr>
    <tr>
        <td>Harga</td>
        <td><input type="text" name="order_harga" id="harga" readonly></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="b_simpan" value="simpan"></td>
    </tr>
</table>

<script>
     function hitungHarga() {
            var paket = document.getElementById("makanan").value;
            var tambahan = [];
            var hargaTambahan = 0;

            // Get the checked tambahan checkboxes
            var tambahanCheckboxes = document.getElementsByName("order_tambahan[]");
            for (var i = 0; i < tambahanCheckboxes.length; i++) {
                 if (tambahanCheckboxes[i].checked) {
                    tambahan.push(tambahanCheckboxes[i].value);
                    switch (tambahanCheckboxes[i].value) {
                        case "Nasi":
                            hargaTambahan += 150000;
                            break;
                        case "Sambal":
                            hargaTambahan += 100000;
                            break;
                        case "Kuah":
                            hargaTambahan += 75000;
                            break;
                    }
                }
            }

            // Calculate the total price
            var hargaTotal = 0;
            switch (paket) {
                case "Empek-Empek":
                    hargaTotal = 500000;
                    break;
                case "Bakso Pedas":
                    hargaTotal = 350000;
                    break;
                case "Sate Padang":
                    hargaTotal = 215000;
                    break;
                case "Ayam Bakar":
                    hargaTotal = 275000;
                    break;
            }
            hargaTotal += hargaTambahan;

            // Update the harga field
            document.getElementById("harga").value = hargaTotal;
        }

        function cek_valid() {                    
            var nama = document.getElementById("nama").value;
            var hp = document.getElementById("hp").value;
            var makanan = document.getElementById("makanan").value;
            var validasiHuruf = /^[a-zA-Z ]+$/;
            var validasiAngka = /^[0-9]+$/;  
            var pesan = '';           

            if (nama == ""){
                pesan += 'Nama Harus Diisi\n';            
            }                     
                    
            if (nama != "" && !nama.match(validasiHuruf)) {
                pesan += 'Nama Harus Huruf\n';
            } 

            if (hp == ""){
                pesan = 'HP Harus Diisi\n';            
            }                     
                    
            if (hp != "" && !hp.match(validasiAngka)) {
                pesan += 'HP Harus Angka\n';
            }   

            if(pesan != ""){//kondisi untuk menampilkan pesan
                alert('Ada kesalahan pada pengisisan formulir : \n'+pesan);
                return false;
            }
            
            if(nama != "" && hp != ""  && paket != "" ){
                alert(data);
            }
            return true;
        }

        function cek_valid2() {
            var nama = document.getElementById("nama").value;
            var hp = document.getElementById("hp").value;
            var makanan = document.getElementById("makanan").value;
            //var data = "NIM Anda = " + nim + "<br>Nama Anda = " + nama + "<br>Kelas Anda = " + kelas;
            var validasiHuruf = /^[a-zA-Z ]+$/; 
            var validasiAngka = /^[0-9]+$/;           
                        
            if (nama == ""){
                document.getElementById("namaError").innerHTML = "Nama Masih Kosong";                                  
            } else {
                if (nama.match(validasiHuruf)) {
                    document.getElementById("namaError").innerHTML = "";                        
                } else {
                    document.getElementById("namaError").innerHTML = "Nama Harus Huruf";
                }  
            }  

            if (hp == ""){
                document.getElementById("hpError").innerHTML = "hp Masih Kosong";                    
            } else {
                if (hp.match(validasiAngka)) {
                    document.getElementById("hpError").innerHTML = "";
                } else {
                    document.getElementById("hpError").innerHTML = "hp Harus Angka";
                }                   
            }
        }
</script>
</form>
