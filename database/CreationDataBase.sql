CREATE DATABASE IF NOT EXISTS DBQuizProjet;

USE DBQuizProjet;

CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'User',
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Quiz (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    description VARCHAR(255) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    question_text VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL,

    CONSTRAINT FK_quiz_id FOREIGN KEY (quiz_id) REFERENCES quiz(id)
);

CREATE TABLE answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    answer_text VARCHAR(255) NOT NULL,
    is_correct BOOLEAN NOT NULL,

    CONSTRAINT FK_question_answer FOREIGN KEY (question_id) REFERENCES questions(id)
);

CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    score DOUBLE,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT FK_user_result_id FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT FK_quiz_result_id FOREIGN KEY (quiz_id) REFERENCES quiz(id)
);

CREATE TABLE sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    session_token VARCHAR(100) NOT NULL,
    expiration INT NOT NULL,

    CONSTRAINT FK_user_session_id FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE captcha (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(10) NOT NULL,
    image BLOB NOT NULL,
);