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

import Library.Project_4.entity.Member;
import Library.Project_4.service.MemberService;

@RestController
@RequestMapping("/api/member")
public class MemberController {

    private final MemberService service;

    public MemberController(MemberService service) {
        this.service = service;
    }

    // ================= SINGLE OPERATIONS =================

    // GET Semua
    @GetMapping
    public List<Member> list() {
        return service.findAll();
    }

    // GET Satu by ID
    @GetMapping("/{id}")
    public Member get(@PathVariable Integer id) {
        return service.findById(id);
    }

    // POST Satu
    @PostMapping
    public Member create(@RequestBody Member member) {
        return service.save(member);
    }

    // PUT Satu (Update by ID)
    @PutMapping("/{id}")
    public Member update(@PathVariable Integer id, @RequestBody Member member) {
        return service.update(id, member);
    }

    // DELETE Satu (Delete by ID)
    @DeleteMapping("/{id}")
    public void delete(@PathVariable Integer id) {
        service.delete(id);
    }

    // ================= BATCH OPERATIONS (LEBIH DARI SATU) =================

    // POST Banyak (Insert list member)
    // URL: http://localhost:8080/api/member/batch
    @PostMapping("/batch")
    public List<Member> createBatch(@RequestBody List<Member> listMember) {
        return service.saveAll(listMember);
    }

    // PUT Banyak (Update list member - pastikan ada ID di dalam JSON-nya)
    @PutMapping("/batch")
    public List<Member> updateBatch(@RequestBody List<Member> listMember) {
        // saveAll di JPA otomatis melakukan update jika ID sudah ada di DB
        return service.saveAll(listMember);
    }

    // DELETE Banyak (Hapus berdasarkan list ID)
    // URL: http://localhost:8080/api/member/batch
    @DeleteMapping("/batch")
    public void deleteBatch(@RequestBody List<Integer> listId) {
        service.deleteAll(listId);
    }
}
