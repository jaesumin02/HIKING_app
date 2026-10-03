CREATE DATABASE IF NOT EXISTS ramos_hiking;
USE ramos_hiking;

CREATE TABLE IF NOT EXISTS trails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    difficulty VARCHAR(50) NOT NULL,
    length_km DECIMAL(4,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO trails (name, location, difficulty, length_km, description) VALUES
('Mount Batulao', 'Nasugbu, Batangas', 'Moderate', 7.5, 'Famous scenic trail with rolling ridges and panoramic views.'),
('Mount Pico de Loro', 'Maragondon, Cavite', 'Difficult', 9.0, 'Known for its iconic monolith peak and lush forest canopy.');