<?php
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_order WHERE order_id =?";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $hp = $_POST['hp'];
        $tanggal = $_POST['tanggal']; // bagian tgl
        $makanan = $_POST['paket'];
        $tambahan = implode(',', $_POST['tambahan']);
        $harga = $_POST['harga'];

        $sql = "UPDATE tb_order SET order_nama =?, order_hp =?, order_paket =?, order_tambahan =?, order_harga =?, order_tanggal =? WHERE order_id =?";
        $stmt = $koneksi->prepare($sql);
        $stmt->execute([$nama, $hp, $makanan, $tambahan, $harga, $tanggal, $id]);

        header('location:index.php?page=order_tampil');
        exit;
    }
}

?>

<form action="" method="post">

    <table>
        <tr>
            <td><label>Nama:</label></td>
            <td><input type="text" name="nama" value="<?php echo $row['order_nama'];?>"></td>
        </tr>
        <tr>
            <td> <label>HP:</label></td>
            <td> <input type="text" name="hp" value="<?php echo $row['order_hp'];?>"></td>
        </tr>
        <tr>
            <td><label>Tanggal:</label></td>
            <td><input type="date" name="tanggal" value="<?php echo $row['order_tanggal'];?>"></td>
        </tr>
        <tr>
            <td><label>makanan:</label></td>
            <td>
                <select name="paket" id="makanan" onchange="hitungHarga()">
                    <option value="Empek-Empek" <?php if($row['order_paket'] == 1) echo 'elected';?>>Empek-Empek (Rp 500.000)</option>
                    <option value="Bakso Pedas" <?php if($row['order_paket'] == 2) echo 'elected';?>>Bakso Pedas (Rp 350.000)</option>
                    <option value="Sate Padang" <?php if($row['order_paket'] == 3) echo 'elected';?>>Sate Padang (Rp 215.000)</option>
                    <option value="Ayam Bakar" <?php if($row['order_paket'] == 4) echo 'elected';?>>Ayam Bakar (Rp 275.000)</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Tambahan:</label></td>
            <td>
                <?php
                $tambahan_array = explode(',', $row['order_tambahan']); // convert string to array
             ?>
                <input type="checkbox" name="tambahan[]" value="Nasi" <?php if(in_array('Nasi', $tambahan_array)) echo 'checked';?> onchange="hitungHarga()"> Extra Nasi (Rp 150.000)<br>
                <input type="checkbox" name="tambahan[]" value="Sambal" <?php if(in_array('Sambak', $tambahan_array)) echo 'checked';?> onchange="hitungHarga()"> Extra Sambal (Rp 100.000)<br>
                <input type="checkbox" name="tambahan[]" value="Kuah" <?php if(in_array('Kuah', $tambahan_array)) echo 'checked';?> onchange="hitungHarga()"> Extra Kuah (Rp 75.000)<br>
            </td>
        </tr>
        <tr>
            <td><label>Harga:</label></td>
            <td><input type="text" name="harga" id="harga" value="<?php echo $row['order_harga'];?>" readonly></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Update"></td>
        </tr>
    </table>

    <script>
        function hitungHarga() {
            var makanan = document.getElementById("makanan").value;
            var tambahan = [];
            var hargaTambahan = 0;

            // Get the checked tambahan checkboxes
            var tambahanCheckboxes = document.getElementsByName("tambahan[]");
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
            switch (makanan) {
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
    </script>
</form>
