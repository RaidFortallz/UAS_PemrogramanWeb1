<?php
include 'koneksi.php';

if (isset($_POST['search'])) {
    $search = "%" . $_POST['search'] . "%";

    $query = "SELECT * FROM tb_barang WHERE nama_barang LIKE ? ORDER BY id DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute([$search]);

    $barang = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($barang) > 0) {
        echo "<table class='table table-striped table-hover table-bordered text-center'>";
        echo "<thead class='table-dark'>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>";

        $no = 1;
        foreach ($barang as $row) {
            $warningClass = ($row['jumlah'] < 5) ? 'table-warning' : '';
            echo "<tr class='$warningClass'>
                    <td>{$no}</td>
                    <td>" . htmlspecialchars($row['nama_barang']) . "</td>
                    <td>" . htmlspecialchars($row['kategori']) . "</td>
                    <td>" . htmlspecialchars($row['jumlah']) . "</td>
                    <td>" . htmlspecialchars($row['kondisi']) . "</td>
                    <td>" . htmlspecialchars($row['lokasi']) . "</td>
                    <td>
                        <img src='../uploads/" . htmlspecialchars($row['gambar']) . "' class='table-img' alt='Gambar'>
                    </td>
                    <td>
                        <a href='detail.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Detail</a>
                    </td>
                  </tr>";
            $no++;
        }

        echo "</tbody></table>";
    } else {
        echo "<p class='text-muted'>Barang tidak ditemukan.</p>";
    }
}
?>
