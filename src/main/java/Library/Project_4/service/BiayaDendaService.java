package Library.Project_4.service;

import Library.Project_4.entity.BiayaDenda;
import Library.Project_4.repository.BiayaDendaRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class BiayaDendaService {

    private final BiayaDendaRepository repository;

    public BiayaDendaService(BiayaDendaRepository repository) {
        this.repository = repository;
    }

    public List<BiayaDenda> findAll() {
        return repository.findAll();
    }

    public BiayaDenda findById(Integer id) {
        return repository.findById(id).orElse(null);
    }

    public BiayaDenda save(BiayaDenda biayaDenda) {
        return repository.save(biayaDenda);
    }

    public BiayaDenda update(Integer id, BiayaDenda newData) {
        Optional<BiayaDenda> existing = repository.findById(id);
        if (existing.isPresent()) {
            BiayaDenda data = existing.get();
            data.setHargaDenda(newData.getHargaDenda());
            data.setStat(newData.getStat());
            data.setTglTetap(newData.getTglTetap());
            return repository.save(data);
        }
        return null;
    }

    public void delete(Integer id) {
        repository.deleteById(id);
    }
}
