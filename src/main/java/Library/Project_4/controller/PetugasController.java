package Library.Project_4.controller;

import Library.Project_4.entity.Petugas;
import Library.Project_4.service.PetugasService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/petugas")
public class PetugasController {

    private final PetugasService service;

    public PetugasController(PetugasService service) {
        this.service = service;
    }

    @GetMapping
    public List<Petugas> list() {
        return service.findAll();
    }

    @GetMapping("/{id}")
    public Petugas get(@PathVariable Integer id) {
        return service.findById(id);
    }

    @PostMapping
    public Petugas create(@RequestBody Petugas petugas) {
        return service.save(petugas);
    }

    @PutMapping("/{id}")
    public Petugas update(@PathVariable Integer id, @RequestBody Petugas petugas) {
        return service.update(id, petugas);
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable Integer id) {
        service.delete(id);
    }
}
