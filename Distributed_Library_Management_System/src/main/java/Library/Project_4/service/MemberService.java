package Library.Project_4.service;

import Library.Project_4.entity.Member;
import Library.Project_4.repository.MemberRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class MemberService {

    private final MemberRepository repository;

    public MemberService(MemberRepository repository) {
        this.repository = repository;
    }

    // --- SINGLE OPERATION (Satu Data) ---

    public List<Member> findAll() {
        return repository.findAll();
    }

    public Member findById(Integer id) {
        return repository.findById(id).orElse(null);
    }

    public Member save(Member member) {
        return repository.save(member);
    }

    public Member update(Integer id, Member memberBaru) {
        Optional<Member> existing = repository.findById(id);
        if (existing.isPresent()) {
            Member member = existing.get();
            // Update data (ID jangan diubah)
            member.setNamaLengkap(memberBaru.getNamaLengkap());
            member.setUsername(memberBaru.getUsername());
            member.setAlamat(memberBaru.getAlamat());
            member.setNomorTelepon(memberBaru.getNomorTelepon());
            return repository.save(member);
        }
        return null;
    }

    public void delete(Integer id) {
        repository.deleteById(id);
    }

    // --- BATCH OPERATION (Banyak Data Sekaligus) ---

    // Simpan banyak member sekaligus
    public List<Member> saveAll(List<Member> listMember) {
        return repository.saveAll(listMember);
    }

    // Hapus banyak member berdasarkan list ID
    public void deleteAll(List<Integer> listId) {
        repository.deleteAllById(listId);
    }
}
