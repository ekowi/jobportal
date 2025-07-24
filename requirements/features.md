## Fitur dengan role
### Kandidat
- membuat akun 
- mengisi data diri pelamar
- melihat list lowongan
- melamar lowongan
- mengerjakan cbt psikotest

### Recruiter
- membuat lowongan
- edit lowongan
- delete lowongan
- membuat kategori lowongan
- edit kategori lowongan
- delete kategori lowongan
- melihat list pelamar lowongan (lamarlowongan)
- melihat list progress rekrutment
- melihat hasil interview dan psikotest

### Coordinator
- Sama seperti recruiter dengan tambahan
- mengupdate progress rekrutment (approve or reject)
- membuat soal psikotes
- edit soal psikotes
- delete soal psikotes
- testing cbt psikotes

### Manager 
- sama seperti coordinator


## Fitur yang tersedia
- CRUD Officer
- CRUD Kategori Lowngan
- CRUD Lowongan
- Lamar lowongan (untuk mendapatkan informasi kandidat mengetahui lowongan ['kandidat_id, lowongan_id, iklan_lowongan])
- Progress Rekrutment [status rekrutment dari diterima, interview, psikotes, dan ditolak] (progress)
- ==CRUD Bank Soal== (ask hrd)
- Status Interview (hanya informasi partisipan, note dan hasil akhir) (progress)
- ==Status Psikotes (hanya informasi partisipan dan hasil akhir)== (progress)
- ==CBT Psikotes==  (butuh bank soal) 
- ==Filter BMI & Blind Test== (butuh foto blind test)
- ==CRUD Kandidat (Done Tinggal list kandidat)==

## Fitur yang sudah diimplementasikan
- CRUD Officer
- CRUD Kategori Lowngan
- CRUD Lowongan
- Lamar lowongan (untuk mendapatkan informasi kandidat mengetahui lowongan ['kandidat_id, lowongan_id, iklan_lowongan])
- Progress Rekrutment (status rekrutment dari diterima, interview, psikotes, dan ditolak)
- Status Interview (hanya informasi partisipan, note dan hasil akhir)











Kandidat, hanya dapat melihat informasi loker yang tersedia di Perusahaan, dapat melakukan pencarian loker yang di ingin kan, dapat mengisi data isian pelamar, dapat mengupload dokumen yg di butuhkan Perusahaan, dapat mengisi/mengerjakan soal tes psikotes.
-        Recruiter, dapat memposting loker yang tersedia di Perusahaan, mengupdate dan  dapat menghapus loker yang telah terpenuhi, dapat melihat dan mengunduh data pelamar, dapat melihat hasil tes prikotes kandidat.
-        Hrga coordinator area, dapat memposting loker yang tersedia di Perusahaan, mengupdate dan  dapat menghapus loker yang telah terpenuhi, dapat melihat dan mengunduh data pelamar, dapat melihat hasil tes psikotes kandidat. Dapat mengupdate progress rekrutmen yang sedang berlangsung.
-        Manager, dapat mereview dan men share progress rekrutmen yang berlangsung, dapat mereview dan menshare loker yang tersedia website.
