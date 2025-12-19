package Library.Project_4.entity;

import jakarta.persistence.*;

@Entity
@Table(name = "tbl_biaya_denda")
public class BiayaDenda {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id_biaya_denda")
    private Integer idBiayaDenda;

    @Column(name = "harga_denda")
    private String hargaDenda;

    @Column(name = "stat")
    private String stat;

    @Column(name = "tgl_tetap")
    private String tglTetap;

    // Getters and Setters
    public Integer getIdBiayaDenda() {
        return idBiayaDenda;
    }

    public void setIdBiayaDenda(Integer idBiayaDenda) {
        this.idBiayaDenda = idBiayaDenda;
    }

    public String getHargaDenda() {
        return hargaDenda;
    }

    public void setHargaDenda(String hargaDenda) {
        this.hargaDenda = hargaDenda;
    }

    public String getStat() {
        return stat;
    }

    public void setStat(String stat) {
        this.stat = stat;
    }

    public String getTglTetap() {
        return tglTetap;
    }

    public void setTglTetap(String tglTetap) {
        this.tglTetap = tglTetap;
    }
}
