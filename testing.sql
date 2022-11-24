/* Handle conflict in testing; simply rerun script */
DROP DATABASE cs2tp;
CREATE DATABASE cs2tp;
USE cs2tp;

CREATE TABLE users (
    uid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    forename VARCHAR(64),
    surname VARCHAR(64),
    username VARCHAR(16),
    email VARCHAR(64),
    password TINYTEXT,
    PRIMARY KEY(uid)
);

CREATE TABLE products (
    pid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    model VARCHAR(48),
    name VARCHAR(128),
    category VARCHAR(32),
    color VARCHAR(32),
    size CHAR(3),                   o                    /* S,M,L,XL,XXL,3XL,OS */
    price DOUBLE,
    stock INT,
    views INT,
    bought_all_time BIGINT,
    avg_rating DOUBLE,
    description TEXT,
    date_time DATETIME,
    PRIMARY KEY(pid)
);

CREATE TABLE orders (
    tid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,      /* base64(SHA-256(base64('$username:$timestamp'))) */
    uid SMALLINT UNSIGNED,
    pid SMALLINT UNSIGNED,
    status VARCHAR(32),                                 /* processing/dispatched/delivered/cancelled/refunded */
    time INT,                                           /* set in php via UNIX_TIMESTAMP(now()) */
    PRIMARY KEY(tid)
);

CREATE TABLE feedback (
    fid SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    model VARCHAR(48),
    username VARCHAR(16),
    review LONGTEXT,
    rating INT,
    time INT,                                           /* '' */
    PRIMARY KEY(fid)
);

/* SEED USERS TABLE */
INSERT INTO users (username, email, password)
VALUES ('admin', 'admin@domain.ac.uk', 'password');         /* NOTE: admin must have uid=1, and does since first entry to AUTO_INCREMENT */

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
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'S',  50.00, 25, 200, 3, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', GETDATE());

INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'M',  50.00, 50, 200, 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', GETDATE());

INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'L',  50.00, 50, 200, 15, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', GETDATE());

INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'CASUAL_SWEATSHIRT', 'sweatshirt', 'white', 'XL',  50.00, 30, 200, 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', GETDATE());

/* >>PRODUCT TYPE #2 */
SET @model_b := UUID();
INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_b, 'SUN_T-SHIRT', 't-shirt', 'red', 'S',  17.99, 1000, 50, 300, 2.5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', GETDATE());

/* >>PRODUCT TYPE #3 */
SET @model_c := UUID();
INSERT INTO products (model, name, category, color, size, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_c, 'OCEAN_T-SHIRT', 't-shirt', 'blue', 'M',  20.99, 1000, 50, 300, 3.75, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', GETDATE());

/* Seeding orders table */
INSERT INTO orders (uid, pid, status)
VALUES (1, 1, 'delivered');

INSERT INTO orders (uid, pid, status)
VALUES (1, 2, 'refunded');

INSERT INTO orders (uid, pid, status)
VALUES (2, 2, 'dispatched');

/* Seeding feedback table */
INSERT INTO feedback (username, model, review, rating, time)
VALUES ('julius', @model_a, "Excellent product.", 5, UNIX_TIMESTAMP(now()));

INSERT INTO feedback (username, model, review, rating, time)
VALUES ('genghis', @model_b, "Satisfied customer.", 5, UNIX_TIMESTAMP(now()));

INSERT INTO feedback (username, model, review, rating, time)
VALUES ('elon', @model_c, "It was okay.", 3, UNIX_TIMESTAMP(now()));
