-- Creation of the 'user' table
CREATE TABLE user (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each user, automatically incremented
    last_name VARCHAR(255),                           -- Last name of the user
    first_name VARCHAR(255),                          -- First name of the user
    email VARCHAR(255),                               -- Email address of the user
    password VARCHAR(255),                            -- Password for user authentication
    role VARCHAR(50)                                  -- Role of the user (e.g., admin, user, guest)
);

-- Creation of the 'building' table
CREATE TABLE building (
    building_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each building, automatically incremented
    name VARCHAR(255),                                    -- Name of the building
    address VARCHAR(255)                                  -- Address of the building
);

-- Creation of the 'room' table
CREATE TABLE room (
    room_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,   -- Unique identifier for each room, automatically incremented
    building_id INT UNSIGNED,                          -- Identifier for the building this room is located in
    floor INT,                                         -- Floor number where the room is located
    number VARCHAR(50),                                -- Room number or identification
    capacity INT,                                      -- Capacity of the room (number of people it can accommodate)
    FOREIGN KEY (building_id) REFERENCES building(building_id) -- Link to the building table
);

-- Creation of the 'reservation' table
CREATE TABLE reservation (
    reservation_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,   -- Unique identifier for each reservation, automatically incremented
    user_id INT UNSIGNED,                                     -- User who made the reservation
    room_id INT UNSIGNED,                                     -- Room that is reserved
    start_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,           -- Start time of the reservation
    end_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- End time of the reservation
    FOREIGN KEY (user_id) REFERENCES user(user_id),           -- Link to the user table
    FOREIGN KEY (room_id) REFERENCES room(room_id)            -- Link to the room table
) ENGINE=InnoDB;

-- Creation of the 'course' table
CREATE TABLE course (
    course_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each course, automatically incremented
    name VARCHAR(255),                                  -- Name of the course
    user_id INT UNSIGNED,                               -- User who manages or is responsible for the course
    FOREIGN KEY (user_id) REFERENCES user(user_id)      -- Link to the user table
);

-- Creation of the 'timeslot' table
CREATE TABLE timeslot (
    timeslot_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each timeslot, automatically incremented
    start_time TIME,                                      -- Start time of the timeslot
    end_time TIME                                         -- End time of the timeslot
);

-- Creation of the 'event' table
CREATE TABLE event (
    event_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,   -- Unique identifier for each event, automatically incremented
    name VARCHAR(255),                                  -- Name of the event
    description VARCHAR(500),                           -- Description of the event
    start_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,     -- Start time of the event
    end_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- End time of the event
    user_id INT UNSIGNED NOT NULL,                      -- User who is responsible for or related to the event
    reservation_id INT UNSIGNED NOT NULL,               -- Reservation associated with the event
    FOREIGN KEY (user_id) REFERENCES user(user_id),     -- Link to the user table
    FOREIGN KEY (reservation_id) REFERENCES reservation(reservation_id) -- Link to the reservation table
);
