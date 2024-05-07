// COSTUME JS START

document.addEventListener('DOMContentLoaded', function () {
  // Mendapatkan elemen input tanggal
  var inputTanggalLaporan = document.getElementById('auto_datestamp');

  // Mendapatkan tanggal dan waktu saat ini di Kalimantan Selatan (WITA)
  var today = new Date();
  var witaOffset = 8; // Perbedaan waktu dengan UTC/GMT
  var witaTime = new Date(today.getTime() + witaOffset * 3600 * 1000); // Menambahkan offset ke waktu saat ini

  // Format tanggal dan waktu sesuai dengan format yang diinginkan
  var formattedDateTime = witaTime.toISOString().slice(0, 19).replace('T', ' ');

  // Mengisi nilai input tanggal dengan tanggal dan waktu yang diformat
  inputTanggalLaporan.value = formattedDateTime;
});

// MERUBAH SWITCH
document.addEventListener('DOMContentLoaded', function () {
  var switches = document.querySelectorAll('.switch-input');
  switches.forEach(function (switchInput) {
    switchInput.addEventListener('change', function (event) {
      var selectedBarang = event.target.value;
      // Kirim nilai selectedBarang ke server menggunakan Ajax atau kirim formulir
    });
  });
});
