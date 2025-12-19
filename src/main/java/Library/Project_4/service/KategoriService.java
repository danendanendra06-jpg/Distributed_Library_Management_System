package Library.Project_4.service;

import Library.Project_4.entity.Kategori;
import Library.Project_4.repository.KategoriRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class KategoriService {

    private final KategoriRepository repository;

    public KategoriService(KategoriRepository repository) {
        this.repository = repository;
    }

    public List<Kategori> findAll() {
        return repository.findAll();
    }

    public Kategori findById(Integer id) {
        return repository.findById(id).orElse(null);
    }

    public Kategori save(Kategori kategori) {
        return repository.save(kategori);
    }

    public Kategori update(Integer id, Kategori newData) {
        Optional<Kategori> existing = repository.findById(id);
        if (existing.isPresent()) {
            Kategori data = existing.get();
            data.setNamaKategori(newData.getNamaKategori());
            return repository.save(data);
        }
        return null;
    }

    public void delete(Integer id) {
        repository.deleteById(id);
    }
}
