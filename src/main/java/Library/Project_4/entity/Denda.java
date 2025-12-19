package Library.Project_4.entity;

import jakarta.persistence.*;

@Entity
@Table(name = "tbl_denda")
public class Denda {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id_denda")
    private Integer idDenda;

    @Column(name = "pinjam_id")
    private String pinjamId;

    @Column(name = "denda")
    private String denda;

    @Column(name = "lama_waktu")
    private Integer lamaWaktu;

    @Column(name = "tgl_denda")
    private String tglDenda;

    // Getters and Setters
    public Integer getIdDenda() {
        return idDenda;
    }

    public void setIdDenda(Integer idDenda) {
        this.idDenda = idDenda;
    }

    public String getPinjamId() {
        return pinjamId;
    }

    public void setPinjamId(String pinjamId) {
        this.pinjamId = pinjamId;
    }

    public String getDenda() {
        return denda;
    }

    public void setDenda(String denda) {
        this.denda = denda;
    }

    public Integer getLamaWaktu() {
        return lamaWaktu;
    }

    public void setLamaWaktu(Integer lamaWaktu) {
        this.lamaWaktu = lamaWaktu;
    }

    public String getTglDenda() {
        return tglDenda;
    }

    public void setTglDenda(String tglDenda) {
        this.tglDenda = tglDenda;
    }
}
