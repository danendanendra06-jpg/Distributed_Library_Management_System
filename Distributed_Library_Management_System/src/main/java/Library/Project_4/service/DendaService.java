package Library.Project_4.service;

import Library.Project_4.entity.Denda;
import Library.Project_4.repository.DendaRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class DendaService {

    private final DendaRepository repository;

    public DendaService(DendaRepository repository) {
        this.repository = repository;
    }

    public List<Denda> findAll() {
        return repository.findAll();
    }

    public Denda findById(Integer id) {
        return repository.findById(id).orElse(null);
    }

    public Denda save(Denda denda) {
        return repository.save(denda);
    }

    public Denda update(Integer id, Denda newData) {
        Optional<Denda> existing = repository.findById(id);
        if (existing.isPresent()) {
            Denda data = existing.get();
            data.setPinjamId(newData.getPinjamId());
            data.setDenda(newData.getDenda());
            data.setLamaWaktu(newData.getLamaWaktu());
            data.setTglDenda(newData.getTglDenda());
            return repository.save(data);
        }
        return null;
    }

    public void delete(Integer id) {
        repository.deleteById(id);
    }
}
