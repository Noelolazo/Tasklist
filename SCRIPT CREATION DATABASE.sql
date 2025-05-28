DROP DATABASE IF EXISTS TASKMANAGER;
CREATE DATABASE IF NOT EXISTS TASKMANAGER;
USE TASKMANAGER;

-- Tabla User
CREATE TABLE User (
    User_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Phone_number INT,
    Status BIT NOT NULL
);
-- Tabla Group
CREATE TABLE `Group` (
    Group_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255)
);

-- Tabla Conexiones
CREATE TABLE User_connections (
    Connection_ID CHAR(36) PRIMARY KEY,
    User_ID INT NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Date_connected DATETIME DEFAULT NOW(),
    Date_disconnected DATETIME,
    FOREIGN KEY (User_ID) REFERENCES User(User_ID)
);

-- Tabla historial de conexiones
CREATE TABLE User_connections_history (
    History_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Date_connected DATETIME DEFAULT NOW(),
    Date_disconnected DATETIME DEFAULT NOW(),
    FOREIGN KEY (User_ID) REFERENCES User(User_ID)
);

-- Tabla List
CREATE TABLE List (
    List_ID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    Description TEXT
);

-- Tabla Task (con columna Status agregada)
CREATE TABLE Task (
    Task_ID INT AUTO_INCREMENT PRIMARY KEY,
    List_ID INT,
    Title VARCHAR(255),
    Description TEXT,
    Deadline DATE,
    Location VARCHAR(255),
    Status ENUM('pending', 'in_progress', 'done') DEFAULT 'pending',
    FOREIGN KEY (List_ID) REFERENCES List(List_ID) ON DELETE CASCADE
);

-- Tabla User_Group
CREATE TABLE User_Group (
    User_ID INT,
    Group_ID INT,
    PRIMARY KEY (User_ID, Group_ID),
    FOREIGN KEY (User_ID) REFERENCES User(User_ID) ON DELETE CASCADE,
    FOREIGN KEY (Group_ID) REFERENCES `Group`(Group_ID) ON DELETE CASCADE
);

-- Tabla List_User_Access (con ENUMs actualizados)
CREATE TABLE List_User_Access (
    List_ID INT,
    User_ID INT,
    Role ENUM('read_only', 'writer', 'owner') NOT NULL,
    Status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    PRIMARY KEY (List_ID, User_ID),
    FOREIGN KEY (List_ID) REFERENCES List(List_ID) ON DELETE CASCADE,
    FOREIGN KEY (User_ID) REFERENCES User(User_ID) ON DELETE CASCADE
);

-- Tabla List_Group_Access (con ENUMs actualizados)
CREATE TABLE List_Group_Access (
    List_ID INT,
    Group_ID INT,
    Role ENUM('read_only', 'writer', 'owner') NOT NULL,
    Status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    PRIMARY KEY (List_ID, Group_ID),
    FOREIGN KEY (List_ID) REFERENCES List(List_ID) ON DELETE CASCADE,
    FOREIGN KEY (Group_ID) REFERENCES `Group`(Group_ID) ON DELETE CASCADE
);

-- Tabla Invitation (con ENUM Status)
CREATE TABLE Invitation (
    Invitation_ID INT AUTO_INCREMENT PRIMARY KEY,
    User_ID INT,
    List_ID INT,
    Status ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',
    FOREIGN KEY (User_ID) REFERENCES User(User_ID) ON DELETE CASCADE,
    FOREIGN KEY (List_ID) REFERENCES List(List_ID) ON DELETE CASCADE
);
