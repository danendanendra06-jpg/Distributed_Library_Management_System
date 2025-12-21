package Library.Project_4.repository;

import Library.Project_4.entity.Petugas;
import org.springframework.data.jpa.repository.JpaRepository;

public interface PetugasRepository extends JpaRepository<Petugas, String> {
    Petugas findByUser(String user);
}
