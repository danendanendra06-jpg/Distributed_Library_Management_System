package Library.Project_4.entity;

import jakarta.persistence.*;

@Entity
@Table(name = "tbl_kategori")
public class Kategori {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id_kategori")
    private Integer idKategori;

    @Column(name = "nama_kategori")
    private String namaKategori;

    // Getters and Setters
    public Integer getIdKategori() {
        return idKategori;
    }

    public void setIdKategori(Integer idKategori) {
        this.idKategori = idKategori;
    }

    public String getNamaKategori() {
        return namaKategori;
    }

    public void setNamaKategori(String namaKategori) {
        this.namaKategori = namaKategori;
    }
}
