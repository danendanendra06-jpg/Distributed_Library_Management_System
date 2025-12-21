package Library.Project_4.controller;

import java.util.List;

import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import Library.Project_4.entity.Buku;
import Library.Project_4.service.BukuService;

@RestController
@RequestMapping("/api/buku")
public class BukuController {

    private final BukuService service;

    public BukuController(BukuService service) {
        this.service = service;
    }

    // ================= SINGLE OPERATIONS =================

    // GET Semua
    @GetMapping
    public List<Buku> list() {
        return service.findAll();
    }

    // GET Satu by ID
    @GetMapping("/{id}")
    public Buku get(@PathVariable Integer id) {
        return service.findById(id);
    }

    // POST Satu
    @PostMapping
    public Buku create(@RequestBody Buku buku) {
        return service.save(buku);
    }

    // PUT Satu (Update by ID)
    @PutMapping("/{id}")
    public Buku update(@PathVariable Integer id, @RequestBody Buku buku) {
        return service.update(id, buku);
    }

    // DELETE Satu (Delete by ID)
    @DeleteMapping("/{id}")
    public void delete(@PathVariable Integer id) {
        service.delete(id);
    }

    // ================= BATCH OPERATIONS (LEBIH DARI SATU) =================

    // POST Banyak (Insert list buku)
    // URL: http://localhost:8080/api/buku/batch
    @PostMapping("/batch")
    public List<Buku> createBatch(@RequestBody List<Buku> listBuku) {
        return service.saveAll(listBuku);
    }

    // PUT Banyak (Update list buku - pastikan ada ID di dalam JSON-nya)
    @PutMapping("/batch")
    public List<Buku> updateBatch(@RequestBody List<Buku> listBuku) {
        // saveAll di JPA otomatis melakukan update jika ID sudah ada di DB
        return service.saveAll(listBuku); 
    }

    // DELETE Banyak (Hapus berdasarkan list ID)
    // URL: http://localhost:8080/api/buku/batch
    @DeleteMapping("/batch")
    public void deleteBatch(@RequestBody List<Integer> listId) {
        service.deleteAll(listId);
    }
}