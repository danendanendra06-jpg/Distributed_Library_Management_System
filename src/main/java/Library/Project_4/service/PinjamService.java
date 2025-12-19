package Library.Project_4.service;

import Library.Project_4.entity.Pinjam;
import Library.Project_4.repository.PinjamRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class PinjamService {

    private final PinjamRepository repository;

    public PinjamService(PinjamRepository repository) {
        this.repository = repository;
    }

    public List<Pinjam> findAll() {
        return repository.findAll();
    }

    public Pinjam findById(Integer id) {
        return repository.findById(id).orElse(null);
    }

    public Pinjam save(Pinjam pinjam) {
        return repository.save(pinjam);
    }

    public Pinjam update(Integer id, Pinjam newData) {
        Optional<Pinjam> existing = repository.findById(id);
        if (existing.isPresent()) {
            Pinjam data = existing.get();
            data.setPinjamId(newData.getPinjamId());
            data.setIdMember(newData.getIdMember());
            data.setBukuId(newData.getBukuId());
            data.setStatus(newData.getStatus());
            data.setTglPinjam(newData.getTglPinjam());
            data.setLamaPinjam(newData.getLamaPinjam());
            data.setTglBalik(newData.getTglBalik());
            data.setTglKembali(newData.getTglKembali());
            return repository.save(data);
        }
        return null;
    }

    public void delete(Integer id) {
        repository.deleteById(id);
    }
}
