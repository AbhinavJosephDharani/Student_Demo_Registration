-- Test data for Student Demo Registration System
-- Use this to populate the database with sample data for testing

USE student_demo_registration;

-- Insert sample students
INSERT INTO students (id, first_name, last_name, project_title, email, phone, time_slot_id) VALUES
('12345678', 'John', 'Doe', 'Web Development Portfolio', 'john.doe@student.edu', '555-123-4567', 1),
('23456789', 'Jane', 'Smith', 'E-commerce Platform', 'jane.smith@student.edu', '555-234-5678', 1),
('34567890', 'Mike', 'Johnson', 'Mobile App Development', 'mike.johnson@student.edu', '555-345-6789', 2),
('45678901', 'Sarah', 'Williams', 'Data Visualization Dashboard', 'sarah.williams@student.edu', '555-456-7890', 2),
('56789012', 'David', 'Brown', 'Social Media Platform', 'david.brown@student.edu', '555-567-8901', 3),
('67890123', 'Emily', 'Davis', 'Online Learning System', 'emily.davis@student.edu', '555-678-9012', 3),
('78901234', 'Robert', 'Miller', 'Inventory Management System', 'robert.miller@student.edu', '555-789-0123', 4),
('89012345', 'Lisa', 'Wilson', 'Real Estate Website', 'lisa.wilson@student.edu', '555-890-1234', 4),
('90123456', 'James', 'Taylor', 'Restaurant Ordering System', 'james.taylor@student.edu', '555-901-2345', 5),
('01234567', 'Amanda', 'Anderson', 'Fitness Tracking App', 'amanda.anderson@student.edu', '555-012-3456', 5);

-- This will populate the database with 10 sample students across different time slots
-- You can run this after importing the main schema to test the system functionality 