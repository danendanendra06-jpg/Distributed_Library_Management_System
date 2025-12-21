package Library.Project_4.controller;

import Library.Project_4.entity.Member;
import Library.Project_4.entity.Petugas;
import Library.Project_4.repository.MemberRepository;
import Library.Project_4.repository.PetugasRepository;
import org.springframework.web.bind.annotation.*;

import java.util.HashMap;
import java.util.Map;

@RestController
@RequestMapping("/api/auth")
public class AuthController {

    private final MemberRepository memberRepository;
    private final PetugasRepository petugasRepository;

    public AuthController(MemberRepository memberRepository, PetugasRepository petugasRepository) {
        this.memberRepository = memberRepository;
        this.petugasRepository = petugasRepository;
    }

    @PostMapping("/login")
    public Map<String, Object> login(@RequestBody LoginRequest request) {
        Map<String, Object> response = new HashMap<>();

        // Check if Admin (Petugas)
        Petugas petugas = petugasRepository.findByUser(request.getUsername());
        if (petugas != null && petugas.getPass().equals(request.getPassword())) {
            response.put("status", "success");
            response.put("role", "Petugas");
            response.put("user", petugas);
            response.put("token", "dummy-token-petugas-" + petugas.getIdPetugas()); // In real app use JWT
            return response;
        }

        // Check if Member
        Member member = memberRepository.findByUsername(request.getUsername());
        if (member != null && member.getPassword() != null && member.getPassword().equals(request.getPassword())) {
            response.put("status", "success");
            response.put("role", "Member");
            response.put("user", member);
            response.put("token", "dummy-token-member-" + member.getIdMember());
            return response;
        }

        response.put("status", "error");
        response.put("message", "Username atau Password salah");
        return response;
    }

    // Register Member
    @PostMapping("/register")
    public Member register(@RequestBody Member member) {
        // Simple registration, ensure username is unique handled by DB constraint
        if (member.getPassword() == null || member.getPassword().isEmpty()) {
            member.setPassword("123456"); // Default if generic
        }
        return memberRepository.save(member);
    }

    // DTO Inner Class
    public static class LoginRequest {
        private String username;
        private String password;

        public String getUsername() {
            return username;
        }

        public void setUsername(String username) {
            this.username = username;
        }

        public String getPassword() {
            return password;
        }

        public void setPassword(String password) {
            this.password = password;
        }
    }
}
