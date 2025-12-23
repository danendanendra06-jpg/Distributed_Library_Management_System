package Library.Project_4.service;

import Library.Project_4.entity.Pinjam;
import Library.Project_4.repository.PinjamRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class PinjamService {

    private final PinjamRepository repository;
    private final Library.Project_4.repository.BukuRepository bukuRepository;

    public PinjamService(PinjamRepository repository, Library.Project_4.repository.BukuRepository bukuRepository) {
        this.repository = repository;
        this.bukuRepository = bukuRepository;
    }

    public List<Pinjam> findAll() {
        return repository.findAll();
    }

    public Pinjam findById(String id) {
        return repository.findById(id).orElse(null);
    }

    public Pinjam save(Pinjam pinjam) {
        if (pinjam.getPinjamId() == null || pinjam.getPinjamId().isEmpty()) {
            pinjam.setPinjamId("PJ" + (System.currentTimeMillis() % 1000000));
        }

        // Stock management logic for new loan
        if ("Dipinjam".equalsIgnoreCase(pinjam.getStatus())) {
            Library.Project_4.entity.Buku buku = bukuRepository.findById(pinjam.getIdBuku()).orElse(null);
            if (buku != null && buku.getJumlah() > 0) {
                buku.setJumlah(buku.getJumlah() - 1);
                bukuRepository.save(buku);
            } else if (buku != null && buku.getJumlah() <= 0) {
                throw new RuntimeException("Stok buku habis!");
            }
        }

        return repository.save(pinjam);
    }

    public Pinjam update(String id, Pinjam newData) {
        Optional<Pinjam> existing = repository.findById(id);
        if (existing.isPresent()) {
            Pinjam data = existing.get();

            // Prevent edit if already returned
            if ("Dikembalikan".equalsIgnoreCase(data.getStatus())
                    && !"Dikembalikan".equalsIgnoreCase(newData.getStatus())) {
                // Trying to change from Returned to something else? Or just prevent any edit?
                // User Requirement: "kalo statusny sudah 'dikembalikkan' tidak dapat diedit
                // lagi"
                // So we should just block updates if current status is Dikembalikan, UNLESS
                // it's an admin correction?
                // Let's assume strict rule: Cannot edit if already returned.
                return data; // Return existing without change, or throw exception
            }

            // Check for Return Event (Dipinjam -> Dikembalikan)
            if ("Dipinjam".equalsIgnoreCase(data.getStatus()) && "Dikembalikan".equalsIgnoreCase(newData.getStatus())) {
                Library.Project_4.entity.Buku buku = bukuRepository.findById(data.getIdBuku()).orElse(null);
                if (buku != null) {
                    buku.setJumlah(buku.getJumlah() + 1); // Return stock
                    bukuRepository.save(buku);
                }
            }

            // Update fields
            data.setIdMember(newData.getIdMember());
            data.setIdBuku(newData.getIdBuku());
            data.setStatus(newData.getStatus());
            data.setTglPinjam(newData.getTglPinjam());
            data.setLamaPinjam(newData.getLamaPinjam());
            data.setTglBalik(newData.getTglBalik());
            data.setTglKembali(newData.getTglKembali());
            return repository.save(data);
        }
        return null;
    }

    public void delete(String id) {
        repository.deleteById(id);
    }
}
