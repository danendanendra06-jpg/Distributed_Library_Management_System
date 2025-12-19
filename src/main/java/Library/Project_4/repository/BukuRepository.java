package Library.Project_4.repository;

import Library.Project_4.entity.Buku;
import org.springframework.data.jpa.repository.JpaRepository;

public interface BukuRepository extends JpaRepository<Buku, Integer> {
}