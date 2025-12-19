package Library.Project_4.entity;

import jakarta.persistence.*;

@Entity
@Table(name = "tbl_pinjam")
public class Pinjam {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id_pinjam")
    private Integer idPinjam;

    @Column(name = "pinjam_id")
    private String pinjamId;

    @Column(name = "id_member")
    private Integer idMember;

    @Column(name = "buku_id")
    private String bukuId;

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
    public Integer getIdPinjam() {
        return idPinjam;
    }

    public void setIdPinjam(Integer idPinjam) {
        this.idPinjam = idPinjam;
    }

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

    public String getBukuId() {
        return bukuId;
    }

    public void setBukuId(String bukuId) {
        this.bukuId = bukuId;
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
