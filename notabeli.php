<?php
include 'connect.php';

if (isset($_GET['idb'])) {

    $idc = $_GET['idb'];

    $sql = "SELECT * FROM cartcus JOIN items ON cart_items_id = items_id WHERE cart_id = '$idc'";
    $result = pg_query($conn, $sql);
    $d = pg_fetch_object($result);
} else {
    echo 'Gagal menghapus data';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <link rel="stylesheet" type="text/css" href="style.css" id="style">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    <!-- Menyertakan library html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

    <!-- Menyertakan Library html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"> </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        // $("#btnPrint").live("click", function() {
        //     var divContents = $("#dvContainer").html();
        //     var printWindow = window.open('', '', 'height=400,width=800');
        //     printWindow.document.write('<html><head><title>DIV Contents</title>');
        //     printWindow.document.write('</head><body >');
        //     printWindow.document.write(divContents);
        //     printWindow.document.write('</body></html>');
        //     printWindow.document.close();
        //     printWindow.print();
        // });

        
    </script>
</head>

<body>
    <div class="nota" id="nota">
        <div class="notaheader">
            <h2>Nota Pembelian</h2>
        </div>
        <div class="notacontent">
            <div class="notadate">
                <span><?php echo date('l, d / m / Y'); ?></span>
            </div>
            <div class="notaitem">
                <span style="font-weight: 700;">Nama Barang:</span>
                <br>
                <span style="padding-left: 10px;"><?php echo $d->items_name; ?></span>
            </div>
            <div class="notaitem">
                <span style="font-weight: 700;">Harga:</span>
                <br>
                <span style="padding-left: 10px;">Rp. <?php echo number_format($d->items_price * 1000) ?></span>
            </div>
            <div class="notaitem">
                <span style="font-weight: 700;">Jumlah:</span>
                <br>
                <span style="padding-left: 10px;"><?php echo $d->cart_jumlah; ?></span>
            </div>
            <div class="notaitem">
                <span style="font-weight: 700;">Total:</span>
                <br>
                <span style="padding-left: 10px;">Rp. <?php echo number_format($d->cart_jumlah * $d->items_price * 1000); ?></span>
            </div>
            <div class="notabuttons">
            <button onclick="beli()" id="downloadBtn">Beli</button>
                <button class="batal" onclick="window.location.href = 'keranjang.php'">Kembali</button>
            </div>

        </div>
    </div>

    <script>

        function beli() {
            var idc = "<?php echo $idc; ?>"; // ID nota yang ingin Anda kirimkan

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "notaaksi.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Get the download button element
                    const downloadBtn = document.getElementById('downloadBtn');

                    // Add a click event listener to the button
                    // Get the nota element to capture as an image
                    const notaElement = document.getElementById('nota');

                    // Use html2canvas library to capture the nota element as an image
                    html2canvas(notaElement).then(canvas => {
                        // Convert the canvas to a data URL
                        const dataURL = canvas.toDataURL();

                        // Create a temporary link element
                        const link = document.createElement('a');
                        link.href = dataURL;
                        link.download = 'Nota-Wear.png'; // Change the file extension to 'jpg' if desired

                        // Append the link to the document
                        document.body.appendChild(link);

                        // Simulate a click event to trigger the download
                        link.click();

                        // Remove the temporary link from the document
                        document.body.removeChild(link);
                    });
                }
            };
            xhr.send("idc=" + encodeURIComponent(idc));
        }
    </script>
</body>

</html>