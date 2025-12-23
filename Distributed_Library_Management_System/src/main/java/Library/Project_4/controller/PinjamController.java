package Library.Project_4.controller;

import Library.Project_4.entity.Pinjam;
import Library.Project_4.service.PinjamService;
import org.springframework.web.bind.annotation.*;
import jakarta.servlet.http.HttpServletRequest;

import java.util.List;

@RestController
@RequestMapping("/api/pinjam")
public class PinjamController {

    private final PinjamService service;

    public PinjamController(PinjamService service) {
        this.service = service;
    }

    @GetMapping
    public List<Pinjam> list(HttpServletRequest request) {
        String role = (String) request.getAttribute("userRole");
        String userId = (String) request.getAttribute("userId");

        // If Member, filter only their loans? For now, let's just return all (or you
        // can filter)
        // Ideally: if (Member) return service.findByMemberId(userId);
        return service.findAll();
    }

    @GetMapping("/{id}")
    public Pinjam get(@PathVariable String id) {
        return service.findById(id);
    }

    @PostMapping
    public Pinjam create(@RequestBody Pinjam pinjam, HttpServletRequest request) {
        String role = (String) request.getAttribute("userRole");
        String userId = (String) request.getAttribute("userId");

        if ("Member".equalsIgnoreCase(role)) {
            // Force Member to borrow for themselves only
            pinjam.setIdMember(Integer.parseInt(userId));
            pinjam.setStatus("Dipinjam"); // Enforce status
        }

        return service.save(pinjam);
    }

    @PutMapping("/{id}")
    public Pinjam update(@PathVariable String id, @RequestBody Pinjam pinjam, HttpServletRequest request) {
        String role = (String) request.getAttribute("userRole");
        if ("Member".equalsIgnoreCase(role)) {
            throw new RuntimeException("Akses Ditolak: Member tidak boleh mengubah status peminjaman.");
        }
        return service.update(id, pinjam);
    }

    @DeleteMapping("/{id}")
    public void delete(@PathVariable String id, HttpServletRequest request) {
        String role = (String) request.getAttribute("userRole");
        if ("Member".equalsIgnoreCase(role)) {
            throw new RuntimeException("Akses Ditolak: Member tidak boleh menghapus data peminjaman.");
        }
        service.delete(id);
    }
}
