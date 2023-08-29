function increment() {
    var inputElement = document.getElementById("myInput");
    var currentValue = parseInt(inputElement.value);
    var maxValue = parseInt(inputElement.max);

    if (currentValue < maxValue) {
      inputElement.value = currentValue + 1;
    }
  }

  function decrement() {
    var inputElement = document.getElementById("myInput");
    var currentValue = parseInt(inputElement.value);
    var minValue = parseInt(inputElement.min);

    if (currentValue > minValue) {
      inputElement.value = currentValue - 1;
    }
  }

  var inputElement = document.getElementById("myInput");
  inputElement.addEventListener("input", function() {
    var currentValue = parseInt(inputElement.value);
    var maxValue = parseInt(inputElement.max);

    if (currentValue > maxValue) {
      inputElement.value = maxValue;
    }
  });

  var saveButton = document.getElementById("saveButton");
  saveButton.addEventListener("click", function() {
    var nilai = document.getElementById("myInput").value;
    var itemid = document.getElementById("itemsId").value;
    var custid = document.getElementById("custId").value;
    // Kirim nilai ke masukkeranjang_data.php menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'masukkeranjang.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var linkElement = document.createElement('link');
            linkElement.rel = 'stylesheet';
            linkElement.href = 'style.css';
            document.head.insertAdjacentElement('beforeend', linkElement);
        
            var response = 'Berhasil Memasukkan'; // Simpan respons dari masukkeranjang.php dalam variabel response
        
            // Buat elemen popup
            var popupElement = document.createElement('div');
            popupElement.className = 'popup'; // Atur kelas CSS untuk elemen popup
        
            // Tambahkan teks respons di atas tombol tutup
            var responseElement = document.createElement('p');
            responseElement.textContent = response;
            popupElement.appendChild(responseElement); // Tambahkan teks respons ke elemen popup
        
            // Tambahkan tombol tutup
            var closeButton = document.createElement('button');
            closeButton.textContent = 'Tutup';
            closeButton.addEventListener('click', function() {
                document.body.removeChild(popupElement); // Hapus elemen popup saat tombol tutup diklik
            });
            popupElement.appendChild(closeButton); // Tambahkan tombol tutup ke elemen popup
        
            document.body.appendChild(popupElement); // Tambahkan elemen popup ke akhir body
        }
        
      };
      
      
  
    var data = 'nilai=' + nilai + '&items=' + itemid + '&cust=' + custid; // Gabungkan nilai dan itemid dalam satu string
    xhr.send(data);
  });

  var imageElements = document.querySelectorAll('.zoomable-image');

  imageElements.forEach(function(imageElement) {
    imageElement.addEventListener('click', function() {
      // Hapus kelas 'active' dari semua gambar
      imageElements.forEach(function(img) {
        img.classList.remove('active');
      });
  
      // Tambahkan kelas 'active' pada gambar yang diklik
      imageElement.classList.add('active');
    });
  });
  