CREATE DATABASE IF NOT EXISTS MK8;
USE MK8;

DROP TABLE IF EXISTS characters;
DROP TABLE IF EXISTS vehicles;
DROP TABLE IF EXISTS wheels;
DROP TABLE IF EXISTS gliders;
DROP TABLE IF EXISTS customizations;

CREATE TABLE IF NOT EXISTS users (
  username VARCHAR(255) PRIMARY KEY,
  password_hash VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS customizations (
  username VARCHAR(255),
  id FLOAT,
  customization_name VARCHAR(255),
  character_name VARCHAR(255),
  vehicle VARCHAR(255),
  wheel VARCHAR(255),
  glider VARCHAR(255),
  FOREIGN KEY (username) REFERENCES users(username)
);

CREATE TABLE characters (
  name VARCHAR(255) PRIMARY KEY,
  speed FLOAT,
  acceleration FLOAT,
  weight FLOAT,
  handling FLOAT,
  traction FLOAT,
  miniturbo FLOAT
);

INSERT INTO characters (name, speed, acceleration, weight, handling, traction, miniturbo)
VALUES
('Mario', 3.75, 2.5, 3.75, 3.25, 3.75, 2.25),
('Luigi', 3.75, 2.5, 3.75, 3.25, 3.75, 2.25),
('Peach', 3.25, 2.75, 3.25, 3.75, 4, 2.5),
('Yoshi', 3.25, 2.75, 3.25, 3.75, 4, 2.5),
('Bowser', 4.75, 2, 4.75, 2.25, 3.25, 1.75),
('Donkey Kong', 4.25, 2.25, 4.25, 2.75, 3.5, 1.75),
('Toad', 2.75, 3, 2.75, 4.25, 4.25, 2.75),
('Koopa Troopa', 2.75, 3, 2.75, 4.25, 4.25, 2.75),
('Daisy', 3.25, 2.75, 3.25, 3.75, 4, 2.5),
('Shy Guy', 2.75, 3, 2.75, 4.25, 4.25, 2.75),
('Wario', 4.75, 2, 4.75, 2.25, 3.25, 1.75),
('Waluigi', 4.25, 2.25, 4.25, 2.75, 3.5, 1.75),
('Baby Mario', 2.25, 3.25, 2.25, 4.75, 4.5, 3),
('Baby Luigi', 2.25, 3.25, 2.25, 4.75, 4.5, 3),
('Baby Peach', 2.25, 3.25, 2.25, 4.75, 4.5, 3),
('Baby Daisy', 2.25, 3.25, 2.25, 4.75, 4.5, 3);

CREATE TABLE vehicles (
  name VARCHAR(32) PRIMARY KEY,
  speed FLOAT,
  acceleration FLOAT,
  weight FLOAT,
  handling FLOAT,
  traction FLOAT,
  miniturbo FLOAT
);

INSERT INTO vehicles 
  (name, speed, acceleration, weight, handling, traction, miniturbo) 
VALUES 
  ('Standard Kart', 0, 0, 0, 0, 0, 0),
  ('Mach 8', 8, 0.5, -0.25, 0.25, 0, -0.5),
  ('Badwagon', 0, -0.5, 0.5, -0.5, 0.5, -0.75),
  ('Biddybuggy', -0.75, 1.25, -0.5, 0.5, -0.25, 1),
  ('Standard Bike', 0, 0.25, -0.25, 0.5, -0.5, 0.25),
  ('Sports Bike', 0, 0.75, -0.25, 0.75, -1.25, 0.5),
  ('Standard ATV', 0, -0.5, 0.5, -0.5, 0.5, -0.75);

CREATE TABLE wheels (
  name VARCHAR(50),
  speed FLOAT,
  acceleration FLOAT,
  weight FLOAT,
  handling FLOAT,
  traction FLOAT,
  miniturbo FLOAT
);


INSERT INTO wheels (name, speed, acceleration, weight, handling, traction, miniturbo)
VALUES
('Standard', 0, 0, 0, 0, 0, 0),
('Monster', 0, -0.5, 0.5, -0.75, 0.75, 0),
('Roller', -0.5, 1, -0.5, 0.25, -0.25, 1.5),
('Slim', 0.25, -0.25, 0, 0.25, -0.5, 0.25);


CREATE TABLE gliders (
  name VARCHAR(50) PRIMARY KEY,
  speed FLOAT,
  acceleration FLOAT,
  weight FLOAT,
  handling FLOAT,
  traction FLOAT,
  miniturbo FLOAT
);

INSERT INTO gliders (name, speed, acceleration, weight, handling, traction, miniturbo)
VALUES 
('Super Glider', 0, 0, 0, 0, 0, 0),
('Cloud Glider', 0, +0.25, -0.25, 0, 0, +0.25),
('Wario Wing', 0, 0, 0, 0, 0, 0);