CREATE DATABASE IF NOT EXISTS pizzeria CHARACTER SET UTF8 COLLATE utf8_general_ci ;

USE pizzeria ;

CREATE TABLE pizzas (
    nom VARCHAR(255) NOT NULL PRIMARY KEY ,
    prix_vente DECIMAL(4,2) ,
    note_consommateur INT 
) ENGINE = InnoDB ;

CREATE TABLE Ventes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    date_vente DATE ,
    nom_pizza VARCHAR(255) ,
    FOREIGN KEY (nom_pizza) REFERENCES pizzas(nom) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB ;

CREATE TABLE produits (
    nom VARCHAR(255) NOT NULL PRIMARY KEY ,
    prix_kg DECIMAL(4,2) ,
    allergene BOOLEAN 
) ENGINE = InnoDB ;

CREATE TABLE ingredients (
    nom VARCHAR(255) ,
    FOREIGN KEY (nom) REFERENCES produits(nom) ON UPDATE CASCADE ON DELETE CASCADE ,
    nom_pizza VARCHAR(255) ,
    FOREIGN KEY (nom_pizza) REFERENCES pizzas(nom) ON UPDATE CASCADE ON DELETE CASCADE ,
    quantite INT ,
    PRIMARY KEY (nom,nom_pizza)
) ENGINE = InnoDB ;

INSERT INTO pizzas (nom,prix_vente) VALUES ('4fromages',7.00) ,
('Auvergnate',7.00) ,
('Calzone',9) ,
('Chèvre',9.60) ,
('Chèvre-miel',10.20) ,
('Espagnole',6.80) , 
('Hawaïenne',11.60) ,
('Kebab',8.30) , 
('Margherita',6.00) ,
('Pepperoni',8.50) ,
('Truffade',9.40) ;

INSERT INTO produits (nom,prix_kg,allergene) VALUES ('Ananas',2.53,false) ,
('Anchois',48.00,false) ,
('Boeuf haché',22.12,false) ,
('Câpres',49.00,false) ,
('Champignons',3.60,true) , 
('Chorizo',14.00,false) , 
('Crème fraiche',14.00,true) ,
('Emmental râpé',0.45,true) ,
('Fromage de chèvre',3.50,true) ,
('Jambon',27.69,false) ,
('Kebab',8.05,false) ,
('Lardons',8.05,false) ,
('Miel',19.60,false) ,
('Mozzarella',11.00,true) ,
('Oignons',0.42,false) ,
('Olives',7.38,false) ,
('Poivrons',2.50,false) ,
('Poulet',12.70,false) ,
('Saint Nectaire',17.00,true) , 
('Sauce tomate',2.36,false) ,
('Saumon fumé',29.00,true) ,
('Sel',18.00,false) ,
('Tome fraiche',9.30,true) ;

INSERT INTO ingredients (nom_pizza,nom) VALUES ('4fromages','Crème fraiche') ,
('4fromages','Emmental râpé') ,
('4fromages','Fromage de chèvre') ,
('4fromages','Mozzarella') ,
('4fromages','Saint Nectaire') ,
('Auvergnate','Crème fraiche') ,
('Auvergnate','Câpres') ,
('Auvergnate','Tome fraiche') ,
('Auvergnate','Sel') ,
('Calzone','Sauce tomate') ,
('Calzone','Jambon') ,
('Calzone','Emmental râpé') ,
('Calzone','Champignons') ,
('Chèvre','Crème fraiche') ,
('Chèvre','Fromage de chèvre') ,
('Chèvre','Emmental râpé') ,
('Chèvre-miel','Crème fraiche') ,
('Chèvre-miel','Fromage de chèvre') ,
('Chèvre-miel','Emmental râpé') ,
('Chèvre-miel','Miel') ,
('Espagnole','Anchois') , 
('Espagnole','Câpres') , 
('Espagnole','Champignons') , 
('Espagnole','Chorizo') , 
('Espagnole','Sauce tomate') , 
('Hawaïenne','Ananas') ,
('Hawaïenne','Oignons') ,
('Hawaïenne','Poivrons') ,
('Hawaïenne','Poulet') ,
('Hawaïenne','Sauce tomate') ,
('Hawaïenne','Sel') ,
('Kebab','Kebab') , 
('Kebab','Oignons') ,
('Kebab','Poivrons') ,
('Kebab','Crème fraiche') ,
('Kebab','Sel') ,
('Margherita','Crème fraiche') ,
('Margherita','Olives') ,
('Margherita','Mozzarella') ,
('Margherita','Emmental râpé') ,
('Pepperoni','Sauce tomate') ,
('Pepperoni','Sel') ,
('Pepperoni','Mozzarella') ,
('Pepperoni','Chorizo') ,
('Pepperoni','Emmental râpé') ,
('Truffade','Champignons') ,
('Truffade','Crème fraiche') ,
('Truffade','Jambon') ,
('Truffade','Emmental râpé') ;

INSERT INTO ventes (date_vente,nom_pizza) VALUES ('2021-09-01','Calzone') ,
('2021-08-27','Hawaïenne') ;

UPDATE pizzas SET note_consommateur = ROUND(5*RAND()) ;