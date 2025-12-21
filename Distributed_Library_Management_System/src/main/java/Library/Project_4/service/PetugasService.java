package Library.Project_4.service;

import Library.Project_4.entity.Petugas;
import Library.Project_4.repository.PetugasRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class PetugasService {

    private final PetugasRepository repository;

    public PetugasService(PetugasRepository repository) {
        this.repository = repository;
    }

    public List<Petugas> findAll() {
        return repository.findAll();
    }

    public Petugas findById(String id) {
        return repository.findById(id).orElse(null);
    }

    public Petugas save(Petugas petugas) {
        return repository.save(petugas);
    }

    public Petugas update(String id, Petugas newData) {
        Optional<Petugas> existing = repository.findById(id);
        if (existing.isPresent()) {
            Petugas data = existing.get();
            // ID (Pk) usually not updated
            data.setUser(newData.getUser());
            data.setPass(newData.getPass());
            data.setNama(newData.getNama());
            data.setTempatLahir(newData.getTempatLahir());
            data.setTglLahir(newData.getTglLahir());
            data.setAlamat(newData.getAlamat());
            data.setTelepon(newData.getTelepon());
            data.setEmail(newData.getEmail());
            data.setTglBergabung(newData.getTglBergabung());
            data.setFoto(newData.getFoto());
            return repository.save(data);
        }
        return null;
    }

    public void delete(String id) {
        repository.deleteById(id);
    }
}
