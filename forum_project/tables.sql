CREATE DATABASE IF NOT EXISTS forum_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE forum_db;

-- Πίνακας χρηστών
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Πίνακας threads (συζητήσεις)
CREATE TABLE threads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Πίνακας posts (απαντήσεις)
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    thread_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (thread_id) REFERENCES threads(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert χρηστών (με κωδικούς σε plain text μόνο για δοκιμή - σε κανονικό site θα τους είχες hashed)
INSERT INTO users (username, password, role) VALUES
('walter_white', 'heisenberg123', 'admin'),
('jesse_pinkman', 'yeah_bitch', 'user'),
('saul_goodman', 'better_call_saul', 'user'),
('gustavo_fring', 'los_pollos', 'admin'),
('mike_ehrmantraut', 'half_measures', 'user');

-- Insert threads (συζητήσεις)
INSERT INTO threads (user_id, title) VALUES
(1, 'Why I became Heisenberg'),
(2, 'The best meth cooking moments'),
(3, 'Legal advice for my... uh... clients'),
(4, 'Los Pollos Hermanos - the real business'),
(1, 'My thoughts on Gus Fring'),
(5, 'No more half measures'),
(2, 'Yo, where''s my money?'),
(3, 'Did someone say Breaking Bad?');

-- Insert posts (απαντήσεις)
INSERT INTO posts (thread_id, user_id, content) VALUES
(1, 1, 'I did it for my family. Or did I?'),
(1, 2, 'Mr. White, you''re crazy! But awesome.'),
(1, 5, 'No more half measures, Walter.'),
(2, 2, 'Remember the RV? That was intense!'),
(2, 1, 'Jesse, we need to cook.'),
(2, 4, 'You two are amateurs.'),
(3, 3, 'Better call Saul! Literally.'),
(3, 1, 'Saul, you''re the best criminal lawyer.'),
(4, 4, 'The chicken is the secret.'),
(4, 1, 'I respect you, Gus. But trust? No.'),
(5, 1, 'Gus used me. But I used him more.'),
(5, 4, 'You are not the danger, Walter. I am the danger.'),
(6, 5, 'I told you, no half measures.'),
(6, 2, 'Mike, you''re the man.'),
(7, 2, 'Where''s my money, Mr. White?'),
(7, 1, 'Patience, Jesse. Patience.'),
(8, 3, 'Breaking Bad is the best show ever!'),
(8, 2, 'Yo, you know it!'),
(8, 1, 'Stay out of my territory.'),
(8, 5, 'Just because you shot Jesse James, don''t make you Jesse James.');