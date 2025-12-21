package Library.Project_4.service;

import Library.Project_4.entity.Buku;
import Library.Project_4.repository.BukuRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class BukuService {

    private final BukuRepository repository;

    public BukuService(BukuRepository repository) {
        this.repository = repository;
    }

    // --- SINGLE OPERATION (Satu Data) ---

    public List<Buku> findAll() {
        return repository.findAll();
    }

    public Buku findById(Integer id) {
        return repository.findById(id).orElse(null);
    }

    public Buku save(Buku buku) {
        return repository.save(buku);
    }

    public Buku update(Integer id, Buku bukuBaru) {
        Optional<Buku> existing = repository.findById(id);
        if (existing.isPresent()) {
            Buku buku = existing.get();
            // Update data (ID jangan diubah)
            buku.setIdKategori(bukuBaru.getIdKategori());
            buku.setIsbn(bukuBaru.getIsbn());
            buku.setSampul(bukuBaru.getSampul());
            buku.setLampiran(bukuBaru.getLampiran());
            buku.setJudul(bukuBaru.getJudul());
            buku.setPengarang(bukuBaru.getPengarang());
            buku.setPenerbit(bukuBaru.getPenerbit());
            buku.setTahunBuku(bukuBaru.getTahunBuku());
            buku.setIsi(bukuBaru.getIsi());
            buku.setJumlah(bukuBaru.getJumlah());
            buku.setTglMasuk(bukuBaru.getTglMasuk());
            buku.setGambarBuku(bukuBaru.getGambarBuku());
            return repository.save(buku);
        }
        return null; // Atau throw exception jika tidak ketemu
    }

    public void delete(Integer id) {
        repository.deleteById(id);
    }

    // --- BATCH OPERATION (Banyak Data Sekaligus) ---

    // Simpan banyak buku sekaligus
    public List<Buku> saveAll(List<Buku> listBuku) {
        return repository.saveAll(listBuku);
    }

    // Hapus banyak buku berdasarkan list ID
    public void deleteAll(List<Integer> listId) {
        repository.deleteAllById(listId);
    }
}