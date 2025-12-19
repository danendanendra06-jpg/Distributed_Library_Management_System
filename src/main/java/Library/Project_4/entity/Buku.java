package Library.Project_4.entity;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name = "tbl_buku")
public class Buku {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id_buku")
    private Integer idBuku;

    @Column(name = "buku_id", unique = true, nullable = false)
    private String bukuId;

    @Column(name = "title")
    private String judul; // Pastikan nama variabel ini 'judul'

    @Column(name = "pengarang")
    private String pengarang;

    @Column(name = "penerbit")
    private String penerbit;

    @Column(name = "thn_buku")
    private String tahunBuku;

    @Column(name = "jml")
    private Integer jumlah;

    // --- CONSTRUCTOR ---
    public Buku() {}

    public Buku(String bukuId, String judul, String pengarang, String penerbit, String tahunBuku, Integer jumlah) {
        this.bukuId = bukuId;
        this.judul = judul;
        this.pengarang = pengarang;
        this.penerbit = penerbit;
        this.tahunBuku = tahunBuku;
        this.jumlah = jumlah;
    }

    // --- GETTER & SETTER (Ini yang dicari oleh Service) ---
    
    public Integer getIdBuku() { return idBuku; }
    public void setIdBuku(Integer idBuku) { this.idBuku = idBuku; }

    public String getBukuId() { return bukuId; }
    public void setBukuId(String bukuId) { this.bukuId = bukuId; }

    // Penting: Service memanggil getJudul(), bukan getTitle()
    public String getJudul() { return judul; } 
    public void setJudul(String judul) { this.judul = judul; }

    public String getPengarang() { return pengarang; }
    public void setPengarang(String pengarang) { this.pengarang = pengarang; }

    public String getPenerbit() { return penerbit; }
    public void setPenerbit(String penerbit) { this.penerbit = penerbit; }

    public String getTahunBuku() { return tahunBuku; }
    public void setTahunBuku(String tahunBuku) { this.tahunBuku = tahunBuku; }

    public Integer getJumlah() { return jumlah; }
    public void setJumlah(Integer jumlah) { this.jumlah = jumlah; }
}