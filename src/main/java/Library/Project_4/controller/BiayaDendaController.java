package Library.Project_4.controller;

import Library.Project_4.entity.BiayaDenda;
import Library.Project_4.service.BiayaDendaService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/biaya-denda")
public class BiayaDendaController {

    private final BiayaDendaService service;

    public BiayaDendaController(BiayaDendaService service) {
        this.service = service;
    }

    @GetMapping
    public List<BiayaDenda> list() {
        return service.findAll();
    }

    @GetMapping("/{id}")
    public BiayaDenda get(@PathVariable Integer id) {
        return service.findById(id);
    }

    @PostMapping
    public BiayaDenda create(@RequestBody BiayaDenda biayaDenda) {
        return service.save(biayaDenda);
    }

    @PutMapping("/{id}")
    public BiayaDenda update(@PathVariable Integer id, @RequestBody BiayaDenda biayaDenda) {
        return service.update(id, biayaDenda);
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable Integer id) {
        service.delete(id);
    }
}
