-- Creation table utilisateur
CREATE TABLE utilisateur (
    uti_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uti_nom VARCHAR(255),
    uti_prenom VARCHAR(255),
    uti_email VARCHAR(255),
    uti_password VARCHAR(255),
    uti_role VARCHAR(50)
);

-- Creation table batiment
CREATE TABLE batiment (
    bat_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bat_nom VARCHAR(255),
    bat_adresse VARCHAR(255)
);

-- Creation table salle
CREATE TABLE salle (
    sal_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sal_bat_id INT UNSIGNED,
    sal_etage INT,
    sal_numero VARCHAR(50),
    sal_capacite INT,
    FOREIGN KEY (sal_bat_id) REFERENCES batiment(bat_id)
);

-- Creation table reservation
CREATE TABLE reservation (
    res_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    res_uti_id INT UNSIGNED,
    res_sal_id INT UNSIGNED,
    res_heure_debut TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    res_heure_fin TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (res_uti_id) REFERENCES utilisateur(uti_id),
    FOREIGN KEY (res_sal_id) REFERENCES salle(sal_id)
) ENGINE=InnoDB;

-- Creation table cours
CREATE TABLE cours (
    cou_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cou_nom VARCHAR(255),
    cou_uti_id INT UNSIGNED,
    FOREIGN KEY (cou_uti_id) REFERENCES utilisateur(uti_id)
);

-- Creation table creneau
CREATE TABLE creneau (
    crn_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    crn_heure_debut TIME,
    crn_heure_fin TIME
);

-- Creation table evenement
CREATE TABLE evenement (
    evt_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    evt_nom VARCHAR(255),
    evt_description VARCHAR(500),
    evt_heure_debut TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    evt_heure_fin TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    evt_uti_id INT UNSIGNED NOT NULL,
    evt_res_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (evt_uti_id) REFERENCES utilisateur(uti_id),
    FOREIGN KEY (evt_res_id) REFERENCES reservation(res_id)
);
