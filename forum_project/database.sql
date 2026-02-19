CREATE DATABASE IF NOT EXISTS database_forum;

CREATE TABLE IF NOT EXISTS
users(
    user_id INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(254) UNIQUE,
    email VARCHAR(254),
    phone VARCHAR(254),
    user_password VARCHAR(254),
    role enum('user','admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id)
);
CREATE TABLE IF NOT EXISTS
posts(
    post_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_title TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(post_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS
threads(
    thread_id INT NOT NULL AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(thread_id),
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Insert χρηστών (διορθωμένο)
INSERT INTO users (user_name, user_password, role) VALUES
('walter_white', 'heisenberg123', 'admin'),
('jesse_pinkman', 'yeah_bitch', 'user'),
('saul_goodman', 'better_call_saul', 'user'),
('gustavo_fring', 'los_pollos', 'admin'),
('mike_ehrmantraut', 'half_measures', 'user');

-- Insert posts (ως κύρια θέματα)
INSERT INTO posts (user_id, post_title) VALUES
(1, 'Why I became Heisenberg'),
(2, 'The best meth cooking moments'),
(3, 'Legal advice for my... uh... clients'),
(4, 'Los Pollos Hermanos - the real business'),
(1, 'My thoughts on Gus Fring'),
(5, 'No more half measures'),
(2, 'Yo, where is my money?'),
(3, 'Did someone say Breaking Bad?');

-- Insert threads (απαντήσεις)
INSERT INTO threads (post_id, user_id, content) VALUES
(1, 1, 'I did it for my family. Or did I?'),
(1, 2, 'Mr. White, you are crazy! But awesome.'),
(1, 5, 'No more half measures, Walter.'),
(2, 2, 'Remember the RV? That was intense!'),
(2, 1, 'Jesse, we need to cook.'),
(2, 4, 'You two are amateurs.'),
(3, 3, 'Better call Saul! Literally.'),
(3, 1, 'Saul, you are the best criminal lawyer.'),
(4, 4, 'The chicken is the secret.'),
(4, 1, 'I respect you, Gus. But trust? No.'),
(5, 1, 'Gus used me. But I used him more.'),
(5, 4, 'You are not the danger, Walter. I am the danger.'),
(6, 5, 'I told you, no half measures.'),
(6, 2, 'Mike, you are the man.'),
(7, 2, 'Where is my money, Mr. White?'),
(7, 1, 'Patience, Jesse. Patience.'),
(8, 3, 'Breaking Bad is the best show ever!'),
(8, 2, 'Yo, you know it!'),
(8, 1, 'Stay out of my territory.'),
(8, 5, 'Just because you shot Jesse James, does not make you Jesse James.');



