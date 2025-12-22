package Library.Project_4.service;

import Library.Project_4.entity.Petugas;
import Library.Project_4.repository.PetugasRepository;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class PetugasService {

    private final PetugasRepository repository;

    public PetugasService(PetugasRepository repository) {
        this.repository = repository;
    }

    public List<Petugas> findAll() {
        return repository.findAll();
    }

    public Petugas findById(String id) {
        return repository.findById(id).orElse(null);
    }

    public Petugas save(Petugas petugas) {
        // Hash password if not already hashed (simple heuristic or always hash)
        // Assuming implementation always sends raw password
        petugas.setPass(getMd5(petugas.getPass()));
        return repository.save(petugas);
    }

    public Petugas update(String id, Petugas newData) {
        Optional<Petugas> existing = repository.findById(id);
        if (existing.isPresent()) {
            Petugas data = existing.get();
            data.setUser(newData.getUser());

            // Only update password if provided and not empty
            if (newData.getPass() != null && !newData.getPass().isEmpty()) {
                data.setPass(getMd5(newData.getPass()));
            }

            data.setNama(newData.getNama());
            data.setTempatLahir(newData.getTempatLahir());
            data.setTglLahir(newData.getTglLahir());
            data.setAlamat(newData.getAlamat());
            data.setTelepon(newData.getTelepon());
            data.setEmail(newData.getEmail());
            data.setTglBergabung(newData.getTglBergabung());
            data.setFoto(newData.getFoto());
            return repository.save(data);
        }
        return null;
    }

    private String getMd5(String input) {
        try {
            java.security.MessageDigest md = java.security.MessageDigest.getInstance("MD5");
            byte[] messageDigest = md.digest(input.getBytes());
            java.math.BigInteger no = new java.math.BigInteger(1, messageDigest);
            String hashtext = no.toString(16);
            while (hashtext.length() < 32) {
                hashtext = "0" + hashtext;
            }
            return hashtext;
        } catch (Exception e) {
            throw new RuntimeException(e);
        }
    }

    public void delete(String id) {
        repository.deleteById(id);
    }
}
