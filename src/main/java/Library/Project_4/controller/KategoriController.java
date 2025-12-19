package Library.Project_4.controller;

import Library.Project_4.entity.Kategori;
import Library.Project_4.service.KategoriService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/kategori")
public class KategoriController {

    private final KategoriService service;

    public KategoriController(KategoriService service) {
        this.service = service;
    }

    @GetMapping
    public List<Kategori> list() {
        return service.findAll();
    }

    @GetMapping("/{id}")
    public Kategori get(@PathVariable Integer id) {
        return service.findById(id);
    }

    @PostMapping
    public Kategori create(@RequestBody Kategori kategori) {
        return service.save(kategori);
    }

    @PutMapping("/{id}")
    public Kategori update(@PathVariable Integer id, @RequestBody Kategori kategori) {
        return service.update(id, kategori);
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable Integer id) {
        service.delete(id);
    }
}
