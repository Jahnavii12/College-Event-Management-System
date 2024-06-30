-- Create the database
CREATE DATABASE IF NOT EXISTS cems
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE cems;

-- Enable foreign key checks
SET FOREIGN_KEY_CHECKS = 0;

-- Start transaction (optional)
START TRANSACTION;

-- Event Types Table
CREATE TABLE IF NOT EXISTS event_types (
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    type_title VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert some sample event types
INSERT INTO event_types (type_title) VALUES
('Technical Events'),
('Gaming Events'),
('Main Events'),
('Fun Events');

-- Events Table
CREATE TABLE IF NOT EXISTS events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT NOT NULL,
    event_title VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    Date DATE NOT NULL,
    time TIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    image_link VARCHAR(255) NOT NULL,
    staff_coordinator VARCHAR(255) NOT NULL,
    student_coordinator VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (type_id) REFERENCES event_types(type_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO events (type_id, event_title, price, Date, time, location, image_link, staff_coordinator, student_coordinator)
VALUES
(1, 'Keyboard Ninja', 100.00, '2024-03-23', '11:00:00', 'Computer Lab 1', 'images/keyboardninja.jpg', 'Preeti', 'Purva'),
(2, 'Pubg', 50.00, '2024-03-25', '12:00:00', 'Room No 204', 'images/pubg.jpg', 'Shoaib', 'Dipika'),
(3, 'Neon Cricket', 100.00, '2024-03-26', '18:00:00', 'Auditorium', 'images/neoncricket.jpg', 'Samarth', 'Sharom'),
(4, 'Mehendi', 50.00, '2024-03-25', '13:00:00', 'Auditorium', 'images/mehandi.jpg', 'Mansi', 'Sakshi');



-- Staff Coordinator Table
CREATE TABLE IF NOT EXISTS staff_coordinator (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    event_id INT NOT NULL,
    FOREIGN KEY (event_id) REFERENCES events(event_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Student Coordinator Table
CREATE TABLE IF NOT EXISTS student_coordinator (
    sc_id INT AUTO_INCREMENT PRIMARY KEY,
    st_name VARCHAR(255) NOT NULL,
    event_id INT NOT NULL,
    FOREIGN KEY (event_id) REFERENCES events(event_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Event Info Table
-- Event Info Table
CREATE TABLE IF NOT EXISTS event_info (
    info_id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    img_link VARCHAR(255) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES events(event_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Registered Events Table
CREATE TABLE IF NOT EXISTS registered_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES events(event_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admins Table
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Registered Table
CREATE TABLE IF NOT EXISTS registered (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    usn VARCHAR(20) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES events(event_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Participant Table
CREATE TABLE IF NOT EXISTS participant (
    participant_id INT AUTO_INCREMENT PRIMARY KEY,
    usn VARCHAR(20) NOT NULL,
    name VARCHAR(255) NOT NULL,
    branch VARCHAR(50) NOT NULL,
    sem INT NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    college VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Feedback Table
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

CREATE TABLE IF NOT EXISTS event_registrations (
    registration_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES events(event_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    first_place VARCHAR(255) NOT NULL,
    second_place VARCHAR(255) NOT NULL,
    third_place VARCHAR(255) NOT NULL,
    result_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(event_id)
)


CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    card_number VARCHAR(16) NOT NULL,
    exp_date VARCHAR(10) NOT NULL,
    cvv VARCHAR(3) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);



-- End transaction (optional)
COMMIT;

-- Set foreign key checks back to 1
SET FOREIGN_KEY_CHECKS = 1;
