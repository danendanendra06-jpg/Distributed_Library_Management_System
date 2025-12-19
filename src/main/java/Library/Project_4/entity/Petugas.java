package Library.Project_4.entity;

import jakarta.persistence.*;

@Entity
@Table(name = "tbl_petugas")
public class Petugas {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id_login")
    private Integer idLogin;

    @Column(name = "anggota_id")
    private String anggotaId;

    @Column(name = "user")
    private String user;

    @Column(name = "pass")
    private String pass;

    @Column(name = "level")
    private String level;

    @Column(name = "nama")
    private String nama;

    @Column(name = "tempat_lahir")
    private String tempatLahir;

    @Column(name = "tgl_lahir")
    private String tglLahir;

    @Column(name = "jenkel")
    private String jenkel;

    @Column(name = "alamat", columnDefinition = "TEXT")
    private String alamat;

    @Column(name = "telepon")
    private String telepon;

    @Column(name = "email")
    private String email;

    @Column(name = "tgl_bergabung")
    private String tglBergabung;

    @Column(name = "foto")
    private String foto;

    // Getters and Setters
    public Integer getIdLogin() {
        return idLogin;
    }

    public void setIdLogin(Integer idLogin) {
        this.idLogin = idLogin;
    }

    public String getAnggotaId() {
        return anggotaId;
    }

    public void setAnggotaId(String anggotaId) {
        this.anggotaId = anggotaId;
    }

    public String getUser() {
        return user;
    }

    public void setUser(String user) {
        this.user = user;
    }

    public String getPass() {
        return pass;
    }

    public void setPass(String pass) {
        this.pass = pass;
    }

    public String getLevel() {
        return level;
    }

    public void setLevel(String level) {
        this.level = level;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getTempatLahir() {
        return tempatLahir;
    }

    public void setTempatLahir(String tempatLahir) {
        this.tempatLahir = tempatLahir;
    }

    public String getTglLahir() {
        return tglLahir;
    }

    public void setTglLahir(String tglLahir) {
        this.tglLahir = tglLahir;
    }

    public String getJenkel() {
        return jenkel;
    }

    public void setJenkel(String jenkel) {
        this.jenkel = jenkel;
    }

    public String getAlamat() {
        return alamat;
    }

    public void setAlamat(String alamat) {
        this.alamat = alamat;
    }

    public String getTelepon() {
        return telepon;
    }

    public void setTelepon(String telepon) {
        this.telepon = telepon;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getTglBergabung() {
        return tglBergabung;
    }

    public void setTglBergabung(String tglBergabung) {
        this.tglBergabung = tglBergabung;
    }

    public String getFoto() {
        return foto;
    }

    public void setFoto(String foto) {
        this.foto = foto;
    }
}
