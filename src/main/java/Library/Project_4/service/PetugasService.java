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

    public Petugas findById(Integer id) {
        return repository.findById(id).orElse(null);
    }

    public Petugas save(Petugas petugas) {
        return repository.save(petugas);
    }

    public Petugas update(Integer id, Petugas newData) {
        Optional<Petugas> existing = repository.findById(id);
        if (existing.isPresent()) {
            Petugas data = existing.get();
            data.setAnggotaId(newData.getAnggotaId());
            data.setUser(newData.getUser());
            data.setPass(newData.getPass());
            data.setLevel(newData.getLevel());
            data.setNama(newData.getNama());
            data.setTempatLahir(newData.getTempatLahir());
            data.setTglLahir(newData.getTglLahir());
            data.setJenkel(newData.getJenkel());
            data.setAlamat(newData.getAlamat());
            data.setTelepon(newData.getTelepon());
            data.setEmail(newData.getEmail());
            data.setTglBergabung(newData.getTglBergabung());
            data.setFoto(newData.getFoto());
            return repository.save(data);
        }
        return null;
    }

    public void delete(Integer id) {
        repository.deleteById(id);
    }
}
