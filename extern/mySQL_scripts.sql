--Creation of the "ruchesdb" Database :
CREATE DATABASE ruchesdb

--Creation of the "ruches" Table
CREATE TABLE ruches(
  id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(20) NOT NULL,
  latitude DECIMAL(9,6) NOT NULL,
  longitude DECIMAL(9,6) NOT NULL
);

--Creation of the "ruches_infos" Table
CREATE TABLE ruches_infos(
  id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ruche VARCHAR(20) NOT NULL,
  date DATETIME NOT NULL,
  poids DECIMAL(4,1) NOT NULL,
  temperature INT(3) NOT NULL,
  humidite INT(3) NOT NULL
);

--Adding data to the "ruches_infos" Table
INSERT INTO ruches_infos(ruche,date,poids,temperature,humidite) VALUES ('Ruche A', '2021-06-29 08:30:00', '44.5', '15', '79');
INSERT INTO ruches_infos(ruche,date,poids,temperature,humidite) VALUES ('Ruche A', '2021-06-29 08:00:00', '45', '16', '77');
INSERT INTO ruches_infos(ruche,date,poids,temperature,humidite) VALUES ('Ruche A', '2021-06-29 09:00:00', '45', '17', '80');
INSERT INTO ruches_infos(ruche,date,poids,temperature,humidite) VALUES ('Ruche A', '2021-06-29 09:30:00', '44', '14', '76');
INSERT INTO ruches_infos(ruche,date,poids,temperature,humidite) VALUES ('Ruche B', '2021-06-29 08:00:00', '44.5', '15', '79');
INSERT INTO ruches_infos(ruche,date,poids,temperature,humidite) VALUES ('Ruche B', '2021-06-29 08:30:00', '45', '16', '77');
INSERT INTO ruches_infos(ruche,date,poids,temperature,humidite) VALUES ('Ruche B', '2021-06-29 09:00:00', '45', '17', '80');
INSERT INTO ruches_infos(ruche,date,poids,temperature,humidite) VALUES ('Ruche B', '2021-06-29 09:30:00', '44', '14', '76');