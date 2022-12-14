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

CREATE TABLE contact (
  cid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  forename VARCHAR(64),
  email VARCHAR(64) NOT NULL,  
  phone varchar(15) NOT NULL,
  message text NOT NULL,
  PRIMARY KEY(cid)
);

/* SEED USERS TABLE */
INSERT INTO users (username, email, password, privileges)
VALUES ('admin', 'admin@domain.ac.uk', 'password', true);         /* NOTE: admin must have uid=1, and does since first entry to AUTO_INCREMENT */

INSERT INTO users (username, email, password)
VALUES ('julius', 'julius@domain.com', 'caesar');

INSERT INTO users (username, email, password)
VALUES ('genghis', 'carlos@domain.com', 'khan');

INSERT INTO users (username, email, password)
VALUES ('elon', 'elon@domain.com', 'musk');

/* SEED PRODUCT TABLE*/
/* >>PRODUCT TYPE #1 */
SET @model_a := UUID();
INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'S',  50.00, 25, 200, 3, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NOW());

INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'M',  50.00, 50, 200, 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NOW());

INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'L',  50.00, 50, 200, 15, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NOW());

INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'XL',  50.00, 30, 200, 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NOW());

/* >>PRODUCT TYPE #2 */
SET @model_b := UUID();
INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_b, 'SUN_T-SHIRT', 't-shirt', 'red', 'S',  17.99, 1000, 50, 300, 2.5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NOW());

/* >>PRODUCT TYPE #3 */
SET @model_c := UUID();
INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_c, 'OCEAN_T-SHIRT', 't-shirt', 'blue', 'M',  20.99, 1000, 50, 300, 3.75, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NOW());

/* Seeding orders table */
INSERT INTO orders (uid, pid, status, date_time)
VALUES (1, 1, 'delivered', NOW());

INSERT INTO orders (uid, pid, status, date_time)
VALUES (1, 2, 'refunded', NOW());

INSERT INTO orders (uid, pid, status, date_time)
VALUES (2, 2, 'dispatched', NOW());

/* Seeding feedback table */
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('julius', @model_a, "Excellent product.", 5, UNIX_TIMESTAMP(CURRENT_TIMESTAMP));

INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('genghis', @model_b, "Satisfied customer.", 5, UNIX_TIMESTAMP(CURRENT_TIMESTAMP));

INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('elon', @model_c, "It was okay.", 3, UNIX_TIMESTAMP(CURRENT_TIMESTAMP));
