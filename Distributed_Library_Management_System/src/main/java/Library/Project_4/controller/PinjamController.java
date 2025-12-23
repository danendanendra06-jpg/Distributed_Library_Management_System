package Library.Project_4.controller;

import Library.Project_4.entity.Pinjam;
import Library.Project_4.service.PinjamService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/pinjam")
public class PinjamController {

    private final PinjamService service;

    public PinjamController(PinjamService service) {
        this.service = service;
    }

    @GetMapping
    public List<Pinjam> list() {
        return service.findAll();
    }

    @GetMapping("/{id}")
    public Pinjam get(@PathVariable String id) {
        return service.findById(id);
    }

    @PostMapping
    public Pinjam create(@RequestBody Pinjam pinjam) {
        return service.save(pinjam);
    }

    @PutMapping("/{id}")
    public Pinjam update(@PathVariable String id, @RequestBody Pinjam pinjam) {
        return service.update(id, pinjam);
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable String id) {
        service.delete(id);
    }
}
