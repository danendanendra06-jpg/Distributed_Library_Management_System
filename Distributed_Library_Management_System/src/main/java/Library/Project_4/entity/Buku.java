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

    @Column(name = "id_kategori")
    private Integer idKategori;

    @Column(name = "sampul")
    private String sampul;

    @Column(name = "isbn")
    private String isbn;

    @Column(name = "lampiran")
    private String lampiran;

    @Column(name = "title")
    private String judul;

    @Column(name = "penerbit")
    private String penerbit;

    @Column(name = "pengarang")
    private String pengarang;

    @Column(name = "thn_buku")
    private String tahunBuku;

    @Column(name = "isi", columnDefinition = "TEXT")
    private String isi;

    @Column(name = "jml")
    private Integer jumlah;

    @Column(name = "tgl_masuk")
    private String tglMasuk;

    @Column(name = "gambar_buku")
    private String gambarBuku;

    // --- CONSTRUCTOR ---
    public Buku() {
    }

    public Buku(Integer idKategori, String isbn, String judul, String pengarang, String penerbit, String tahunBuku,
            Integer jumlah) {
        this.idKategori = idKategori;
        this.isbn = isbn;
        this.judul = judul;
        this.pengarang = pengarang;
        this.penerbit = penerbit;
        this.tahunBuku = tahunBuku;
        this.jumlah = jumlah;
    }

    // --- GETTER & SETTER ---

    public Integer getIdBuku() {
        return idBuku;
    }

    public void setIdBuku(Integer idBuku) {
        this.idBuku = idBuku;
    }

    public Integer getIdKategori() {
        return idKategori;
    }

    public void setIdKategori(Integer idKategori) {
        this.idKategori = idKategori;
    }

    public String getSampul() {
        return sampul;
    }

    public void setSampul(String sampul) {
        this.sampul = sampul;
    }

    public String getIsbn() {
        return isbn;
    }

    public void setIsbn(String isbn) {
        this.isbn = isbn;
    }

    public String getLampiran() {
        return lampiran;
    }

    public void setLampiran(String lampiran) {
        this.lampiran = lampiran;
    }

    public String getJudul() {
        return judul;
    }

    public void setJudul(String judul) {
        this.judul = judul;
    }

    public String getPengarang() {
        return pengarang;
    }

    public void setPengarang(String pengarang) {
        this.pengarang = pengarang;
    }

    public String getPenerbit() {
        return penerbit;
    }

    public void setPenerbit(String penerbit) {
        this.penerbit = penerbit;
    }

    public String getTahunBuku() {
        return tahunBuku;
    }

    public void setTahunBuku(String tahunBuku) {
        this.tahunBuku = tahunBuku;
    }

    public String getIsi() {
        return isi;
    }

    public void setIsi(String isi) {
        this.isi = isi;
    }

    public Integer getJumlah() {
        return jumlah;
    }

    public void setJumlah(Integer jumlah) {
        this.jumlah = jumlah;
    }

    public String getTglMasuk() {
        return tglMasuk;
    }

    public void setTglMasuk(String tglMasuk) {
        this.tglMasuk = tglMasuk;
    }

    public String getGambarBuku() {
        return gambarBuku;
    }

    public void setGambarBuku(String gambarBuku) {
        this.gambarBuku = gambarBuku;
    }
}