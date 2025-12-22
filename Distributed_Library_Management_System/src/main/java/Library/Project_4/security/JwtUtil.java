package Library.Project_4.security;

import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
import java.nio.charset.StandardCharsets;
import java.util.Base64;
import java.util.Date;

public class JwtUtil {

    private static final String SECRET_KEY = "ini-secret-key-yang-sangat-rahasia-project-dts-library";
    // 1 Hour validity
    private static final long EXPIRATION_TIME = 3600000;

    // Generate Simple JWT-like token (Header.Payload.Signature)
    public static String generateToken(String role, String userId, String username) {
        try {
            long nowMillis = System.currentTimeMillis();
            long expMillis = nowMillis + EXPIRATION_TIME;

            // Simple Payload JSON
            String payloadJson = String.format(
                    "{\"role\":\"%s\", \"userId\":\"%s\", \"username\":\"%s\", \"exp\":%d}",
                    role, userId, username, expMillis);

            String header = Base64.getUrlEncoder().withoutPadding()
                    .encodeToString("{\"alg\":\"HS256\",\"typ\":\"JWT\"}".getBytes(StandardCharsets.UTF_8));
            String payload = Base64.getUrlEncoder().withoutPadding()
                    .encodeToString(payloadJson.getBytes(StandardCharsets.UTF_8));

            String dataToSign = header + "." + payload;
            String signature = hmacSha256(dataToSign, SECRET_KEY);

            return dataToSign + "." + signature;

        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }

    // Validate and Parse Token
    public static boolean validateToken(String token) {
        try {
            String[] parts = token.split("\\.");
            if (parts.length != 3)
                return false;

            String header = parts[0];
            String payload = parts[1];
            String signature = parts[2];

            // Re-sign and compare
            String expectedSign = hmacSha256(header + "." + payload, SECRET_KEY);
            if (!expectedSign.equals(signature))
                return false;

            // Check Expiry
            String payloadJson = new String(Base64.getUrlDecoder().decode(payload), StandardCharsets.UTF_8);
            // Simple parsing (avoid huge deps)
            long exp = extractExp(payloadJson);
            if (System.currentTimeMillis() > exp)
                return false;

            return true;
        } catch (Exception e) {
            return false;
        }
    }

    private static String hmacSha256(String data, String key) {
        try {
            Mac sha256_HMAC = Mac.getInstance("HmacSHA256");
            SecretKeySpec secret_key = new SecretKeySpec(key.getBytes(StandardCharsets.UTF_8), "HmacSHA256");
            sha256_HMAC.init(secret_key);
            return Base64.getUrlEncoder().withoutPadding()
                    .encodeToString(sha256_HMAC.doFinal(data.getBytes(StandardCharsets.UTF_8)));
        } catch (Exception e) {
            throw new RuntimeException("Failed to calculate HMAC");
        }
    }

    private static long extractExp(String json) {
        // Very basic extraction, assumed format "exp":12345
        String search = "\"exp\":";
        int start = json.indexOf(search);
        if (start == -1)
            return 0;
        start += search.length();
        int end = json.indexOf("}", start);
        if (end == -1)
            end = json.length();
        String num = json.substring(start, end).replaceAll("[^0-9]", "");
        return Long.parseLong(num);
    }
}
