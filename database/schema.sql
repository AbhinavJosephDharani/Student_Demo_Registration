-- Student Demo Registration Database Schema

-- Create database
CREATE DATABASE IF NOT EXISTS student_demo_registration;
USE student_demo_registration;

-- Create time slots table
CREATE TABLE time_slots (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date_time VARCHAR(50) NOT NULL,
    time_range VARCHAR(50) NOT NULL,
    max_seats INT DEFAULT 6,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create students table
CREATE TABLE students (
    id VARCHAR(8) PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    project_title VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    time_slot_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (time_slot_id) REFERENCES time_slots(id)
);

-- Insert default time slots
INSERT INTO time_slots (date_time, time_range) VALUES
('4/19/2070', '6:00 PM – 7:00 PM'),
('4/19/2070', '7:00 PM – 8:00 PM'),
('4/19/2070', '8:00 PM – 9:00 PM'),
('4/20/2070', '6:00 PM – 7:00 PM'),
('4/20/2070', '7:00 PM – 8:00 PM'),
('4/20/2070', '8:00 PM – 9:00 PM');

-- Create indexes for better performance
CREATE INDEX idx_student_time_slot ON students(time_slot_id);
CREATE INDEX idx_student_email ON students(email); 