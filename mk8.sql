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
  ('Pipe Frame', 0, 0.25, -0.25, 0.5, -0.5, 0.25),
  ('Mach 8', 8, 0.5, -0.25, 0.25, 0, -0.5),
  ('Steel Driver', 0, -0.5, 0.5, -0.5, 0.5, -0.75),
  ('Cat Cruiser', 0, 0, 0, 0, 0, 0),
  ('Circuit Special', 0.5, -0.25, 0.25, 0, -1, -0.5),
  ('Tri-Speeder', 0, -0.5, 0.5, -0.5, 0.5, -0.75),
  ('Badwagon', 0, -0.5, 0.5, -0.5, 0.5, -0.75),
  ('Prancer', 0, 0, 0, 0, 0, 0),
  ('Biddybuggy', -0.75, 1.25, -0.5, 0.5, -0.25, 1),
  ('Landship', -0.75, 1.25, -0.5, 0.5, -0.25, 1),
  ('Sneeker', 0, 0, 0, 0, 0, 0),
  ('Sports Coupe', 0.5, -0.25, 0.25, 0, -1, -0.5),
  ('Gold Standard', 0.5, -0.25, 0.25, 0, -1, -0.5),
  ('Standard Bike', 0, 0.25, -0.25, 0.5, -0.5, 0.25),
  ('Comet', 0, 0.75, -0.25, 0.75, -1.25, 0.5),
  ('Sports Bike', 0, 0.75, -0.25, 0.75, -1.25, 0.5),
  ('The Duke', 0, 0, 0, 0, 0, 0),
  ('Flame Rider', 0, 0.25, -0.25, 0.5, -0.5, 0.25),
  ('Varmint', 0, 0.25, -0.25, 0.5, -0.5, 0.25),
  ('Mr. Scooty', -0.75, 1.25, -0.5, 0.5, -0.25, 1),
  ('Jet Bike', 0, 0.75, -0.25, 0.75, -1.25, 0.5),
  ('Yoshi Bike', 0, 0.75, -0.25, 0.75, -1.25, 0.5),
  ('Standard ATV', 0, -0.5, 0.5, -0.5, 0.5, -0.75),
  ('Wild Wiggler', 0, 0.25, -0.25, 0.5, -0.5, 0.25),
  ('Teddy Buggy', 0, 0, 0, 0, 0, 0);

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
('Slim', 0.25, -0.25, 0, 0.25, -0.5, 0.25),
('Slick', 0.5, -0.25, 0.25, 0, -1, 0.25),
('Metal', 0.25, -0.5, 0.5, 0, -0.5, 0),
('Button', -0.5, 1, -0.5, 0.25, -0.25, 1.5),
('Off-Road', 0, 0, 0, 0, 0, 0),
('Sponge', -0.25, 0.25, -0.25, -0.25, 0.5, 0.75),
('Wood', -0.25, 0.25, -0.25, -0.25, 0.5, 0.75),
('Cushion', -0.25, 0.25, -0.25, -0.25, 0.5, 0.75),
('Blue Standard', 0, 0, 0, 0, 0, 0),
('Hot Monster', 0, -0.5, 0.5, -0.75, 0.75, 0),
('Azure Roller', -0.5, 1, -0.5, 0.25, -0.25, 1.5),
('Crimson Slim', 0.25, -0.25, 0, 0.25, -0.5, 0.25),
('Cyber Slick', 0.5, -0.25, 0.25, 0, -1, 0.25),
('Retro Off-Road', 0, 0, 0, 0, 0, 0),
('Gold Tires', 0.25, -0.5, 0.5, 0, -0.5, 0),
('GLA Tires', 0, 0, 0, 0, 0, 0);


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
('Wario Wing', 0, 0, 0, 0, 0, 0),
('Waddle Wing', 0, 0, 0, 0, 0, 0),
('Peach Parasol', 0, +0.25, -0.25, 0, 0, +0.25),
('Parachute', 0, +0.25, -0.25, 0, 0, +0.25),
('Parafoil', 0, +0.25, -0.25, 0, 0, +0.25),
('Flower Glider', 0, +0.25, -0.25, 0, 0, +0.25),
('Bowser Kite', 0, +0.25, -0.25, 0, 0, +0.25),
('Plane Glider', 0, 0, 0, 0, 0, 0),
('MKTV Parafoil', 0, +0.25, -0.25, 0, 0, +0.25),
('Gold Glider', 0, 0, 0, 0, 0, 0);