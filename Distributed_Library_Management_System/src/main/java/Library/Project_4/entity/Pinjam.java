package Library.Project_4.entity;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name = "tbl_pinjam")
public class Pinjam {

    @Id
    @Column(name = "pinjam_id")
    private String pinjamId;

    @Column(name = "id_member")
    private Integer idMember;

    @Column(name = "id_buku")
    private Integer idBuku;

    @Column(name = "status")
    private String status;

    @Column(name = "tgl_pinjam")
    private String tglPinjam;

    @Column(name = "lama_pinjam")
    private Integer lamaPinjam;

    @Column(name = "tgl_balik")
    private String tglBalik;

    @Column(name = "tgl_kembali")
    private String tglKembali;

    // Getters and Setters

    public String getPinjamId() {
        return pinjamId;
    }

    public void setPinjamId(String pinjamId) {
        this.pinjamId = pinjamId;
    }

    public Integer getIdMember() {
        return idMember;
    }

    public void setIdMember(Integer idMember) {
        this.idMember = idMember;
    }

    public Integer getIdBuku() {
        return idBuku;
    }

    public void setIdBuku(Integer idBuku) {
        this.idBuku = idBuku;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getTglPinjam() {
        return tglPinjam;
    }

    public void setTglPinjam(String tglPinjam) {
        this.tglPinjam = tglPinjam;
    }

    public Integer getLamaPinjam() {
        return lamaPinjam;
    }

    public void setLamaPinjam(Integer lamaPinjam) {
        this.lamaPinjam = lamaPinjam;
    }

    public String getTglBalik() {
        return tglBalik;
    }

    public void setTglBalik(String tglBalik) {
        this.tglBalik = tglBalik;
    }

    public String getTglKembali() {
        return tglKembali;
    }

    public void setTglKembali(String tglKembali) {
        this.tglKembali = tglKembali;
    }
}
