package Library.Project_4.entity;

import jakarta.persistence.*;

@Entity
@Table(name = "tbl_member")
public class Member {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id_member")
    private Integer idMember;

    @Column(name = "nama_lengkap")
    private String namaLengkap;

    @Column(name = "username", unique = true)
    private String username;

    @Column(name = "alamat", columnDefinition = "TEXT")
    private String alamat;

    @Column(name = "nomor_telepon")
    private String nomorTelepon;

    // Constructor, Getter, Setter
    public Member() {
    }

    public Integer getIdMember() {
        return idMember;
    }

    public void setIdMember(Integer idMember) {
        this.idMember = idMember;
    }

    public String getNamaLengkap() {
        return namaLengkap;
    }

    public void setNamaLengkap(String namaLengkap) {
        this.namaLengkap = namaLengkap;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getAlamat() {
        return alamat;
    }

    public void setAlamat(String alamat) {
        this.alamat = alamat;
    }

    public String getNomorTelepon() {
        return nomorTelepon;
    }

    public void setNomorTelepon(String nomorTelepon) {
        this.nomorTelepon = nomorTelepon;
    }
}