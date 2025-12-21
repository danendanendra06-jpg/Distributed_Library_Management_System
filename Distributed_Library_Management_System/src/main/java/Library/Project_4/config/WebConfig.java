package Library.Project_4.config;

import org.springframework.context.annotation.Configuration;
import org.springframework.web.servlet.config.annotation.CorsRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;

@Configuration
public class WebConfig implements WebMvcConfigurer {

    @Override
    public void addCorsMappings(CorsRegistry registry) {
        registry.addMapping("/**") // Allow all endpoints
                .allowedOrigins("*") // Allow all origins (localhost:80, etc)
                .allowedMethods("GET", "POST", "PUT", "DELETE") // Allow common methods
                .allowedHeaders("*"); // Allow all headers
    }
}
