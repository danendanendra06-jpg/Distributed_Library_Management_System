package Library.Project_4.controller;

import Library.Project_4.entity.Denda;
import Library.Project_4.service.DendaService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/denda")
public class DendaController {

    private final DendaService service;

    public DendaController(DendaService service) {
        this.service = service;
    }

    @GetMapping
    public List<Denda> list() {
        return service.findAll();
    }

    @GetMapping("/{id}")
    public Denda get(@PathVariable Integer id) {
        return service.findById(id);
    }

    @PostMapping
    public Denda create(@RequestBody Denda denda) {
        return service.save(denda);
    }

    @PutMapping("/{id}")
    public Denda update(@PathVariable Integer id, @RequestBody Denda denda) {
        return service.update(id, denda);
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable Integer id) {
        service.delete(id);
    }
}
