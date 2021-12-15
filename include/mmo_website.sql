DROP DATABASE IF EXISTS CONTINENTAL_CONQUEST;
CREATE DATABASE CONTINENTAL_CONQUEST; 

USE CONTINENTAL_CONQUEST;

-- MYSQL DIDN'T ALLOW US TO USE CHARACTER AS A TABLE RENAMED TO CHARACTERS.
/*
DROP TABLE IF EXISTS CHAR_BAG;
DROP TABLE IF EXISTS CHAR_SLOTS;
DROP TABLE IF EXISTS ITEM_STATS;
DROP TABLE IF EXISTS ITEM_CLASS_REQ;
DROP TABLE IF EXISTS ITEM;
DROP TABLE IF EXISTS RACE_ABILITY;
DROP TABLE IF EXISTS CLASS_ABILITY;
DROP TABLE IF EXISTS ABILITY;
DROP TABLE IF EXISTS CHAR_SLOTS;
DROP TABLE IF EXISTS PARTY;
DROP TABLE IF EXISTS CHARACTERS;
DROP TABLE IF EXISTS GUILD;
DROP TABLE IF EXISTS ADMINS;
DROP TABLE IF EXISTS PLAYERS;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS FRIENDLIST;
DROP TABLE IF EXISTS TICKET;
*/

CREATE TABLE USERS (
	Acct_ID INTEGER auto_increment,
	Fname VARCHAR(20) NOT NULL,
	Lname VARCHAR(20) NOT NULL,
	Username VARCHAR(20) NOT NULL,
    Password VARCHAR(16) NOT NULL,
	Birthday DATE NOT NULL,
	Email VARCHAR(40) NOT NULL,
	PRIMARY KEY (Acct_ID)
);

-- NEED TO USE NULL FOR PLAYERS WHEN INSERTING THEM IF GUILDS HAVE NOT BEEN SUBMITTED YET!
-- OR INSERT GUILDS FIRST ASSIGN LEADER AS NULL AND THEN UPDATE OR CHANGE GUILD TO NOT 
-- CONSTRAIN A FOREIGN KEY TO PLAYER TABLE.
CREATE TABLE PLAYERS (
	Player_ID INTEGER NOT NULL,
    Playtime VARCHAR(30) NOT NULL,
    Sub_status TINYINT(1) NOT NULL,
	Guild VARCHAR(30) DEFAULT NULL,
    PRIMARY KEY (Player_ID),
    FOREIGN KEY (Player_ID) REFERENCES USERS (Acct_ID),
    FOREIGN KEY (GUILD) REFERENCES GUILD (Guild_name);
);

CREATE TABLE ADMINS (
	Admin_ID INTEGER NOT NULL,
    Perm_level INTEGER NOT NULL,
    PRIMARY KEY (Admin_ID),
    FOREIGN KEY (Admin_ID) REFERENCES USERS (Acct_ID) 
);

CREATE TABLE GUILD (
	Guild_name VARCHAR(30) NOT NULL,
    Leader_ID INTEGER NOT NULL,
    XP INTEGER NOT NULL,
    Level INTEGER NOT NULL,
    Gold INTEGER NOT NULL,
    PRIMARY KEY (Guild_name),
    FOREIGN KEY (Leader_ID) REFERENCES PLAYERS (Player_ID) 
);

CREATE TABLE FRIEND_LIST (
	Acct_ID INTEGER NOT NULL,
    Friend_ID INTEGER NOT NULL,
    PRIMARY KEY (Acct_ID, Friend_ID),
    FOREIGN KEY (Acct_ID) REFERENCES PLAYERS (Player_ID),
    FOREIGN KEY (Friend_ID) REFERENCES PLAYERS (Player_ID)
);

CREATE TABLE TICKET (
	Ticket_ID INTEGER NOT NULL auto_increment,
    Issue VARCHAR(500) NOT NULL,
    Category VARCHAR(30) NOT NULL,
    Date DATE NOT NULL,
    Player_ID INTEGER NOT NULL,
    Admin_ID INTEGER,
    Status VARCHAR(15) NOT NULL,
	PRIMARY KEY (Ticket_ID),
    FOREIGN KEY (Player_ID) REFERENCES PLAYERS (Player_ID),
    FOREIGN KEY (Admin_ID) REFERENCES ADMINS (Admin_ID)
);

CREATE TABLE CLASS (
	Name VARCHAR(30) NOT NULL,
    Description VARCHAR(300) NOT NULL,
    PRIMARY KEY (Name)
);

CREATE TABLE RACE (
	Name VARCHAR(30) NOT NULL,
    Description VARCHAR(300) NOT NULL,
    PRIMARY KEY(Name)
);

CREATE TABLE CHARACTERS (
	Acct_ID INTEGER NOT NULL,
    Name VARCHAR(20) NOT NULL UNIQUE,
    Lvl INTEGER NOT NULL,
    XP INTEGER NOT NULL,
    Gold INTEGER NOT NULL,
    Location VARCHAR(30) NOT NULL,
    Race VARCHAR(30) NOT NULL,
    Class VARCHAR(30) NOT NULL,
    Party_ID INTEGER,
    PRIMARY KEY(Acct_ID, Name),
    FOREIGN KEY (Acct_ID) REFERENCES PLAYERS (Player_ID),
    FOREIGN KEY (Race) REFERENCES RACE (Name),
    FOREIGN KEY (Class) REFERENCES CLASS (Name),
    FOREIGN KEY (Party_ID) REFERENCES PARTY (Party_id)
);

CREATE TABLE PARTY (
	Party_id INTEGER NOT NULL,
    Ch_name VARCHAR(20) NOT NULL,
    PRIMARY KEY (Party_id, Ch_name),
    FOREIGN KEY (Ch_name) REFERENCES CHARACTERS (Name)
);

CREATE TABLE ABILITY (
	Name VARCHAR(30) NOT NULL,
    Mana_Cost INTEGER NOT NULL,
    Description VARCHAR(300) NOT NULL,
    Damage INTEGER NOT NULL,
    Lv_Req INTEGER NOT NULL,
    Cooldown INTEGER NOT NULL,
    PRIMARY KEY (Name)
);

CREATE TABLE RACE_ABILITY (
	Abil_name VARCHAR(30) NOT NULL,
    Race VARCHAR(30) NOT NULL,
    PRIMARY KEY(Abil_name, Race),
    FOREIGN KEY (Abil_name) REFERENCES ABILITY (Name),
    FOREIGN KEY (Race) REFERENCES RACE (Name)
);

CREATE TABLE CLASS_ABILITY (
	Abil_name VARCHAR(30) NOT NULL,
    Class VARCHAR(30) NOT NULL,
    PRIMARY KEY (Abil_name, Class),
    FOREIGN KEY (Abil_name) REFERENCES ABILITY (Name),
    FOREIGN KEY (Class) REFERENCES CLASS (Name)
);

CREATE TABLE ITEM (
	Item_ID INTEGER AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    Type VARCHAR(30) NOT NULL,
    Sell_price INTEGER NOT NULL,
    Rarity VARCHAR(30) NOT NULL,
    Description VARCHAR(100) DEFAULT NULL,
    Item_Category VARCHAR(30) NOT NULL,
    Base_Dmg VARCHAR(30),
    Base_Def VARCHAR(30),
    PRIMARY KEY (Item_ID)
);
CREATE TABLE ITEM_CLASS_REQ (
	Item_ID INTEGER NOT NULL,
    Class VARCHAR(30) NOT NULL,
    PRIMARY KEY (Item_ID, Class),
    FOREIGN KEY (Item_ID) REFERENCES ITEM (Item_ID),
    FOREIGN KEY (Class) REFERENCES CLASS (Name)
);

CREATE TABLE ITEM_STATS (
	Item_ID INTEGER,
    Atk INTEGER,
    Def INTEGER,
    HP INTEGER,
    MP INTEGER,
    Spd INTEGER,
    PRIMARY KEY (Item_ID),
    FOREIGN KEY (Item_ID) REFERENCES ITEM (Item_ID)
);
CREATE TABLE CHAR_SLOTS (
	Acc_ID INTEGER NOT NULL,
    Char_Name VARCHAR(30),
    Item_ID INTEGER,
    Slot_Type VARCHAR(30),
    PRIMARY KEY (Acc_ID, Char_Name, Slot_Type),
    FOREIGN KEY (Acc_ID) REFERENCES PLAYERS (Player_ID),
    FOREIGN KEY (Char_Name) REFERENCES CHARACTERS (Name),
    FOREIGN KEY (Item_ID) REFERENCES ITEM (Item_ID)
);

CREATE TABLE CHAR_BAG (
	Acc_ID INTEGER NOT NULL,
    Char_Name VARCHAR(30) NOT NULL,
    Item_ID INTEGER NOT NULL,
    PRIMARY KEY(Acc_ID, Char_Name, Item_ID),
	FOREIGN KEY(Acc_ID, Char_Name) REFERENCES CHARACTERS (Acct_ID, Name),
    FOREIGN KEY (Item_ID) REFERENCES ITEM (Item_ID)
);

CREATE TABLE CHAR_STATS (
	Acc_ID INTEGER NOT NULL,
    Char_Name VARCHAR(30) NOT NULL,
    Atk INTEGER NOT NULL,
    Def INTEGER NOT NULL,
    HP INTEGER NOT NULL,
    MP INTEGER NOT NULL,
    Spd INTEGER NOT NULL,
    PRIMARY KEY (Acc_ID, Char_Name),
    FOREIGN KEY (Acc_ID) REFERENCES CHARACTERS (Acct_ID),
    FOREIGN KEY (Char_Name) REFERENCES CHARACTERS (Name)
);
INSERT INTO USERS (Fname, Lname, Username, Password, Birthday, Email) 
VALUES 
('John', 'Smith', 'jsmith', 'jsmith1993', '1996-06-06', 'john.smith@gmail.com'),
('John', 'Sena', 'jsena', 'jsena1993', '1997-06-06', 'john.sena@gmail.com'),
('John', 'Tev', 'jtevh', 'jtev1995', '1995-02-06', 'john.tev@gmail.com'),
('Henry', 'Smith', 'hsmith', 'hsmith1993', '1993-02-01', 'henry.smith@gmail.com'),
('Terry', 'Smith', 'tsmith', 'tsmith1993', '1993-01-05', 't.smith@gmail.com'),
('Andre', 'Astin', 'Aastin', 'Aastin1281', '1983-01-05', 'a.astin@gmail.com'),
('John', 'Posh', 'jposh', 'posh1993', '1972-07-05', 'j.posh@hotmail.com'),
('Sarah', 'Posh', 'sposh', 'posh1975', '1982-02-05', 's.posh@hotmail.com'),
('Apostolos', 'Blizzscon', 'bscon', 'test2021', '1991-06-01', 'a.scon@hotmail.com'),
('Quentin', 'Jenfingers', 'jquen', 'test2020','1992-05-01', 'a.jen@gmail.com'),
('Beau', 'McCranberry', 'bmcran', 'test2019', '1902-02-02', 'b.mccran@gmail.com'),
('Sam', 'Cast', 'castS', 'cast1975-21a', '1965-02-05', 's.cast@hotmail.com');
('Mike', 'Hawk', 'hawkseyjr', 'password', '2014-09-08', 'mikehawk@email.au');
SELECT * FROM USERS;

-- NEED TO USE NULL FOR PLAYERS WHEN INSERTING THEM IF GUILDS HAVE NOT BEEN SUBMITTED YET!
-- OR INSERT GUILDS FIRST ASSIGN LEADER AS NULL AND THEN UPDATE OR CHANGE GUILD TO NOT 
-- CONSTRAIN A FOREIGN KEY TO PLAYER TABLE.
INSERT INTO PLAYERS (Player_ID, Playtime, Sub_status, Guild)
VALUES
(1, '500.5', 0, NULL),
(2, '250.2', 0, NULL),
(3, '300.5', 0, NULL),
(5, '240.5', 1, NULL),
(6, '230.1', 1, NULL),
(7, '220.5', 0, NULL),
(8, '750.2', 0, NULL),
(9, '50.2', 0, NULL),
(11, '65', 1, NULL);

INSERT INTO ADMINS (Admin_ID, Perm_level)
VALUES 
(4, 5),
(10, 5),
(12, 5);

INSERT INTO GUILD 	(Guild_name, Leader_ID, XP, Level, Gold)
VALUES 
('Little Fockers', 3, 75000, 15, 150000),
('The Avengers', 5, 50000, 10, 200000),
('The Married Men', 6, 25000, 5, 2552000),
('The Vaccum Cowboys', 7, 40000, 8, 212410),
('Tenderloin Lovers', 8, 10000, 2, 12512512),
('The Gentle Giants', 9, 60000, 12, 250500),
('Glorious Eels', 11, 15000, 3, 50250);

SELECT * FROM USERS, Players WHERE USERS.Acct_ID = Player_ID;
UPDATE PLAYERS SET Guild = 'Little Fockers' WHERE Player_ID = 3;
UPDATE PLAYERS SET Guild = 'The Avengers' WHERE Player_ID = 5;
UPDATE PLAYERS SET Guild = 'The Married Men' WHERE Player_ID = 6;
UPDATE PLAYERS SET Guild = 'The Vaccum Cowboys' WHERE Player_ID = 7;
UPDATE PLAYERS SET Guild = 'Tenderloin Lovers' WHERE Player_ID = 8;
UPDATE PLAYERS SET Guild = 'The Gentle Giants' WHERE Player_ID = 9;
UPDATE PLAYERS SET Guild = 'Glorious Eels' WHERE Player_ID = 11;

/*
UPDATE PLAYERS SET Guild = NULL WHERE Player_ID >= 1;
*/
INSERT FRIEND_LIST (Acct_ID, Friend_ID) VALUES
(1,2), (2, 1), (1, 3), (3, 1), (1,5), (5,1),
(2,5), (5,2), (1,6), (6,1), (1,7), (7,1),(1,8), (8,1);

INSERT INTO TICKET (Issue, Category, Date, Player_ID, Admin_ID, Status)
VALUES
('Stuck at a certain location, can\'t move character.', 'Gameplay', '2020-05-05', 1, NULL, 'Pending'),
('Forgot Password, and the password of my email.', 'Login', '2021-07-05', 2, 12, 'Resolved'),
('Game glitched and my character got a level reset, lots 1 million experience.', 'Gameplay', '2021-08-05', 6, 12, 'Under Review');

INSERT INTO CLASS (Name, Description) 
VALUES
('Warrior', 'Battles in close combat with a sword'),
('Shaman', 'Utilizes long range combat and close combat when necessary'), 
('Rogue', 'Uses Daggers to inflict bursts of damage in close combat'), 
('Ranger', 'Uses Bows to inflict damage from a long range. Useful in sieges.'), 
('Sorcerer', 'Inflicts serious damage using Staff\'s from a long range. Very weak defense.'),
('Necromancer', 'Uses summons to inflict damage to opponents. Weak defense.'),
('Hierophant', 'Uses ancient healing powers to restore health to allies. Strong close combat, weak Defense');

INSERT INTO RACE (Name, Description)
VALUES
('Human', 'An adaptive race with versatile and wide-spread stats but no starting ability.'),
('Elf', 'Agile folk with inate elven magic that allows them to cast simple spells.'),
('Orc', 'Bloodthirsty brutes with excellent might and the ability to call upon the powers of their ancestors.'),
('Dark Elf', 'Strong Atk, HP weaker Defense, and average speed, stronger in the night.'),
('Dwarf', 'Impressive artisans, great craftsmen, and very strong Defense and HP, average at the other departments');

INSERT INTO CHARACTERS (Acct_ID, Name, Lvl, XP, Gold, Location, Race, Class, Party_ID)
VALUES 
(1, 'AlexanderTheGreat', 50, 1000001, 50000, 'AmityVille', 'Human', 'Warrior', NULL),
(1, 'SirJohnKnight', 40, 800001, 25000, 'JacksonVille', 'Dark Elf', 'Rogue', NULL),
(1, 'AttilaTheHun', 25, 500001, 15000, 'City Townhall', 'Elf', 'Ranger', NULL),
(2, 'JasonMamoa', 75, 1500001, 400000, 'Hospital', 'Orc', 'Warrior', NULL),
(2, 'NotYourEveryDayHero', 60, 1200001, 35250, 'Beach', 'Orc', 'Hierophant', NULL),
(2, 'TheTerminator', 95, 1900001, 65002, 'AmityVille Castle', 'Dark Elf', 'Ranger', NULL),
(7, 'BabyCarrot', 55, 1100001, 125000, 'City Townhall', 'Dwarf', 'Warrior', NULL),
(8, 'TenderLove', 35, 700001, 15000, 'AmityVille', 'Elf', 'Hierophant', NULL);

INSERT INTO ABILITY (Name, Mana_Cost, Description, Damage, Lv_Req, Cooldown)
VALUES 
('Valor', 50, 'Decreases defense by 50 but increases Attack by 100, Speed by 100 for 10 seconds.', 0, 15, 500),
('Force of Nature', 25, 'Increases HP by 200.', 0, 10, 150),
('Healing Prowess', 100, 'Heals 200 HP to yourself and nearby allies', 0, 10, 150),
('Light Step', 0, 'Increases speed during day time by 200', 0, 25, 0),
('Insight', 0, 'Increases accuracy during day time by 500', 0, 15, 0),
('Blood Thirst', 0, 'Increases attack by 50 during night time', 0, 1, 0),
('Deadly Instict', 0, 'Increases defense by 100 when HP is under 25%', 0, 1, 0),
('Cleanse', 100, 'Removes paralysis from you and your allies.', 0, 15, 200),
('Quick Step', 200, 'Increase speed by 150 for 30 seconds.', 0, 20, 120),
('Silent Movement', 0, 'Increases speed by 50 at night', 0, 50, 0),
('Backstab', 200, 'Inflicts 200 damage, an additional 400 if attacked from behind', 200, 15, 50),
('Fake Attack', 150, 'Forces the opponent to show their back for 1 second', 0, 10, 75),
('Fire Blitz', 200, 'Attacks the opponent with a blast of fire causing 500 damage', 500, 15, 120),
('Tomb Raid', 500, 'Summon 10 corpses that attack twice every second causing 25 damage per attack.', 0, 35, 200),
('Iron Shield', 150, 'Increases defense by 500 for 15 seconds.', 0, 35, 300),
('Arrow Storm', 120, 'Crowd the enemy with a quick barrage of 15 arrows in 5 seconds. Unable to move.', 750, 55, 300),
('Eagle Eye', 0, 'Increases your attacks by 50 when a bow is equipped', 50, 1, 0),
('Sharpshooter', 200, 'Increases your basic attack range by 500 for 30 seconds', 0, 55, 300),
('Fifth Eye', 300, 'Increases your speed and defense by 200 for 30 seconds', 0, 20, 180),
('Forest Wisedom', 150, 'Increases your HP by 1000 for 5 minutes', 0, 15, 600),
('Spirit Call', 200, 'Convert your MP to Attack for 30 seconds.', 0, 35, 200);

INSERT INTO RACE_ABILITY (Abil_name, Race) 
VALUES
('Light Step', 'Elf'),
('Insight', 'Elf'),
('Blood Thirst', 'Dark Elf'),
('Silent Movement', 'Dark Elf'),
('Quick Step', 'Human'),
('Deadly Instict', 'Human'),
('Force of Nature', 'Orc'),
('Forest Wisedom', 'Orc');

INSERT INTO CLASS_ABILITY (Abil_name, Class) 
VALUES
('Healing Prowess', 'Hierophant'),
('Cleanse', 'Hierophant'),
('Fake Attack', 'Rogue'),
('Backstab', 'Rogue'),
('Fire Blitz', 'Sorcerer'),
('Tomb Raid','Necromancer'),
('Arrow Storm', 'Ranger'),
('Sharpshooter', 'Ranger'),
('Eagle Eye', 'Ranger'),
('Fifth Eye', 'Shaman'),
('Spirit Call', 'Shaman'),
('Iron Shield', 'Warrior'),
('Valor', 'Warrior');

INSERT INTO ITEM (Name, Type, Sell_price, Rarity, Item_Category, Base_Dmg, Base_Def)
VALUES
('Sword of Might', 'Sword', 1500, 'Normal', 'Weapon', 200, 0),
('Headgear of Bravery', 'Helmet', 600, 'Normal', 'Armor', 0, 50),
('Chestplate of Bravery', 'Chest', 2000, 'Normal', 'Armor', 0, 100),
('Gaiters of Bravery', 'Legs', 1500, 'Normal', 'Armor', 0, 80),
('Boots of Bravery', 'Boots', 750, 'Normal', 'Armor', 0, 60),
('Necklace of Valor', 'Necklace', 300, 'Normal', 'Accessory', 0, 0),
('Earring of Valor', 'Earring', 300, 'Normal', 'Accessory', 0, 0),
('Ring of Valor', 'Ring', 300, 'Normal', 'Accessory', 0, 0),
('Staff of Wisedom', 'Staff', 2500, 'Normal', 'Weapon', 100, 0),
('Helmet of Wisedom', 'Helmet', 2500, 'Normal', 'Armor', 0, 80),
('Armour of Wisedom', 'Chest', 1000, 'Normal', 'Armor', 0, 85),
('Leggings of Wisedom', 'Legs', 800, 'Normal', 'Armor', 0, 65),
('Boots of Wisedom', 'Boots', 1200, 'Normal', 'Armor', 0, 55),
('Necklace of Nature', 'Necklace', 300, 'Normal', 'Accessory', 0, 0),
('Earring of Nature', 'Earring', 300, 'Normal', 'Accessory', 0, 0),
('Ring of Nature', 'Ring', 300, 'Normal', 'Accessory', 0, 0),
('Hunting Dagger', 'Dagger', 1500, 'Normal', 'Weapon', 300, 0),
('Assasin\'s Helmet', 'Helmet', 1500, 'Normal', 'Armor', 0, 40),
('Assasin\'s Shirt', 'Chest', 1500, 'Normal', 'Armor', 0, 65),
('Assasin\'s Shorts', 'Legs', 1200, 'Normal', 'Armor', 0, 65),
('Assasin\'s Boots', 'Boots', 1200, 'Normal', 'Armor', 0, 45),
('Necklace of Sixth Sense', 'Necklace', 300, 'Normal', 'Accessory', 0, 0),
('Earring of Sixth Sense', 'Earring', 300, 'Normal', 'Accessory', 0, 0),
('Ring of Sixth Sense', 'Ring', 300, 'Normal', 'Accessory', 0, 0),
('Dragon Slayer', 'Bow', 2300, 'Normal', 'Weapon', 500, 0),
('Mountain Soul Leather Headgear', 'Helmet', 1500, 'Normal', 'Armor', 0, 50),
('Mountain Soul Leather Vest', 'Chest', 1500, 'Normal', 'Armor', 0, 65),
('Mountain Soul Leather Pants', 'Legs', 1200, 'Normal', 'Armor', 0, 65),
('Mountain Soul Leather Boots', 'Boots', 800, 'Normal', 'Armor', 0, 65),
('Sniper\'s Necklace', 'Necklace', 300, 'Normal', 'Accessory', 0, 0),
('Sniper\'s Earring', 'Earring', 300, 'Normal', 'Accessory', 0, 0),
('Sniper\'s Ring', 'Ring', 300, 'Normal', 'Accessory', 0, 0),
('Staff of Sorcery', 'Staff', 2300, 'Normal', 'Weapon', 400, 0),
('Helmet of Mysticism', 'Helmet', 800, 'Normal', 'Armor', 0, 60),
('Tunic of Mysticism', 'Chest', 800, 'Normal', 'Armor', 0, 60),
('Gaiters of Mysticism', 'Legs', 800, 'Normal', 'Armor', 0, 40),
('Boots of Mysticism', 'Boots', 600, 'Normal', 'Armor', 0, 35),
('Necklace of Darkness', 'Necklace', 300, 'Normal', 'Accessory', 0, 0),
('Earring of Darkness', 'Earring', 300, 'Normal', 'Accessory', 0, 0),
('Ring of Darkness', 'Ring', 300, 'Normal', 'Accessory', 0, 0);

INSERT INTO ITEM_CLASS_REQ (Item_ID, Class)
VALUES
(1, 'Warrior'), (2, 'Warrior'), (3, 'Warrior'), (4, 'Warrior'), (5, 'Warrior'), (6, 'Warrior'), (7, 'Warrior'), (8, 'Warrior'),
(9, 'Shaman'), (10, 'Shaman'), (11, 'Shaman'), (12, 'Shaman'), (13, 'Shaman'), (14, 'Shaman'), (15, 'Shaman'), (16, 'Shaman'),
(17, 'Rogue'), (18, 'Rogue'), (19, 'Rogue'), (20, 'Rogue'), (21, 'Rogue'), (22, 'Rogue'), (23, 'Rogue'), (24, 'Rogue'),
(25, 'Ranger'), (26, 'Ranger'), (27, 'Ranger'), (28, 'Ranger'), (29, 'Ranger'), (30, 'Ranger'), (31, 'Ranger'), (32, 'Ranger'),
(33, 'Sorcerer'), (34, 'Sorcerer'), (35, 'Sorcerer'), (36, 'Sorcerer'), (37, 'Sorcerer'), (38, 'Sorcerer'), (39, 'Sorcerer'), (40, 'Sorcerer'),
(33, 'Necromancer'), (34, 'Necromancer'), (35, 'Necromancer'), (36, 'Necromancer'), (37, 'Necromancer'), (38, 'Necromancer'), (39, 'Necromancer'), (40, 'Necromancer'),
(33, 'Hierophant'), (34, 'Hierophant'), (35, 'Hierophant'), (36, 'Hierophant'), (37, 'Hierophant'), (38, 'Hierophant'), (39, 'Hierophant'), (40, 'Hierophant');

SELECT * FROM ITEM, ITEM_CLASS_REQ WHERE ITEM.Item_ID=ITEM_CLASS_REQ.Item_ID;