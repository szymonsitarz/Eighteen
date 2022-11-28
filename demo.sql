/* Handle conflict in testing; simply rerun script */
DROP DATABASE IF EXISTS cs2tp;
CREATE DATABASE cs2tp;
USE cs2tp;

/* NOTE: Any NOT NULL field is set in register.php */
CREATE TABLE users (
    uid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    forename VARCHAR(64),
    surname VARCHAR(64),
    username VARCHAR(16) NOT NULL,
    email VARCHAR(64) NOT NULL,
    password TINYTEXT NOT NULL,
    privileges BOOLEAN DEFAULT FALSE,
    banned BOOLEAN DEFAULT FALSE,
    timeout_stamp INT,
    timeout_duration INT,
    PRIMARY KEY(uid)
);

/* NOTE: Products of the same model but different size, must share these fields:
    1. views
    2. avg_rating
    3. description 

    Why? Because each product listing groups together all sizes on a single page, 
        therefore shares views, avg_rating and description.
*/
CREATE TABLE products (
    pid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    model VARCHAR(48) NOT NULL,
    name VARCHAR(128) NOT NULL,
    category VARCHAR(32) NOT NULL,
    color VARCHAR(32),
    size CHAR(3) NOT NULL,                              /* S,M,L,XL,XXL,3XL,OS */
    price DOUBLE NOT NULL,
    stock INT DEFAULT 0,
    views INT DEFAULT 0,
    bought_all_time BIGINT DEFAULT 0,
    avg_rating DOUBLE DEFAULT 0,
    description TEXT,
    date_time DATETIME DEFAULT NOW(),
    PRIMARY KEY(pid)
);

CREATE TABLE orders (
    tid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,      /* base64(SHA-256(base64('$username:$timestamp'))) */
    uid SMALLINT UNSIGNED NOT NULL,
    pid SMALLINT UNSIGNED NOT NULL,
    status VARCHAR(32) DEFAULT "processing",            /* processing/dispatched/delivered/cancelled/refunded */
    date_time DATETIME DEFAULT NOW(),
    PRIMARY KEY(tid)
);

CREATE TABLE feedback (
    fid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    model VARCHAR(48) NOT NULL,
    username VARCHAR(16) NOT NULL,
    review LONGTEXT,
    rating INT NOT NULL,
    seconds_since_epoch INT DEFAULT UNIX_TIMESTAMP(CURRENT_TIMESTAMP),
    PRIMARY KEY(fid)
);

/* SEED USERS TABLE */
/* >>password => "password" */
INSERT INTO users (username, email, password, privileges)
VALUES ('admin', 'admin@domain.ac.uk', '$2y$10$zyWUmQmdYxZOStAgctHRw.u7vgnMeunS2DxUEATvh6y/CLIhULzje', true);         /* NOTE: admin must have uid=1, and does since first entry to AUTO_INCREMENT */

/* >>password => "caesar" */
INSERT INTO users (username, email, password)
VALUES ('julius', 'julius@domain.com', '$2y$10$vAiVC77oQJn3ylwqiXZH7OihcgxJJjVHLRcWtyhQRkNMpoDlqNbQG');

/* >>password => "khan" */
INSERT INTO users (username, email, password)
VALUES ('genghis', 'carlos@domain.com', '$2y$10$s.74gjCCcMBwWZ2eGQTA.udrVAK9a3a8EpmBQl1IAiSGwnXDmFnMG');

/* >>password => "musk" */
INSERT INTO users (username, email, password)
VALUES ('elon', 'elon@domain.com', '$2y$10$Yuk2IQ7TlPhI7NruJTZiH.hF/v/Hd337BOaEJG11IU8pd3k1HpDbe');

/* SEED PRODUCT TABLE*/
/* >>PRODUCT TYPE #1 */
SET @model_a := UUID();
INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'S',  50.00, 9, 10, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-11-22 09-31-04");

INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'M',  50.00, 10, 10, 0, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-11-27 20-18-32");

INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', '2XL',  50.00, 10, 10, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-11-27 20-19-55");

/* >>PRODUCT TYPE #2 */
SET @model_b := UUID();
INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_b, 'SUN_T-SHIRT', 't-shirt', 'red', 'S',  17.99, 20, 15, 1, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-11-27 20-19-10");

/* >>PRODUCT TYPE #3 */
SET @model_c := UUID();
INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_c, 'OCEAN_T-SHIRT', 't-shirt', 'blue', 'M',  20.99, 50, 12, 1, 2.5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-11-25 05-29-11");

/* Seeding orders table */
INSERT INTO orders (uid, pid, status, date_time)
VALUES (2, 1, 'delivered', "2022-11-28 08-00-13");

INSERT INTO orders (uid, pid, status, date_time)
VALUES (3, 3, 'refunded', "2022-11-27 11-53-21");

INSERT INTO orders (uid, pid, status, date_time)
VALUES (4, 2, 'dispatched', "2022-11-28 20-20-20");

/* Seeding feedback table */
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('julius', @model_a, "Excellent product.", 5, 1669628396);

INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('genghis', @model_a, "Disappointed with the fabric quality...", 1, 1669659396);

INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('elon', @model_b, "Satisfied customer. Came as expected and promptly.", 5, 166966939);

INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('elon', @model_c, "I have high hopes in terms of product quality but I ordered 5 weeks ago and it has still not arrived..", 5, 1669668396);
