-- Active: 1708568149717@@127.0.0.1@3306@nwdb
CREATE TABLE categories(  
    category_id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    category_name VARCHAR(128) NOT NULL COMMENT 'Category Name',
    category_small_desc VARCHAR(255),
    category_status CHAR(3) DEFAULT 'ACT' COMMENT 'Status',
    create_time DATETIME COMMENT 'Create Time' DEFAULT CURRENT_TIMESTAMP,
    update_time DATETIME COMMENT 'Update Time' DEFAULT CURRENT_TIMESTAMP
) COMMENT 'Table for Categories';