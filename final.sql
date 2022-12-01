/* Handle conflict in testing; simply rerun script */
DROP TABLE IF EXISTS contact;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS feedback;

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
    gender CHAR(1) NOT NULL,                            /* M, F, U */
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
    seconds_since_epoch INT,
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

/* >>password => "bonaparte" */
INSERT INTO users (username, email, password)
VALUES ('napoleon', 'napoleon@domain.com', '$2y$10$YHVXlAvuSmveONz3Bo5r2./QVpnZCW/4W3wvIeWE.QNvUCAe48Sru');

/* >>password => "jackson" */
INSERT INTO users (username, email, password)
VALUES ('michael', 'michael@domain.com', '$2y$10$F.5h5dY/fYnmoRq.slhM4.67dpei0BU/7J4sLBErsZGNkLOZIIm.W');

/* SEED PRODUCT TABLE*/
/* >>PRODUCT TYPE #1 */
SET @model_a := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'ZIPPED_HOODIE', 'hoodies', 'black', 'S',  'U', 50.00, 49, 10, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'ZIPPED_HOODIE', 'hoodies', 'black', 'M',  'U', 50.00, 49, 10, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_a, 'ZIPPED_HOODIE', 'hoodies', 'black', 'XL',  'U', 50.00, 50, 10, 0, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

/* >>PRODUCT TYPE #2 */
SET @model_b := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_b, 'PATTERN_T-SHIRT', 'tops', 'white', 'S',  'U', 12.99, 20, 15, 0, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_b, 'PATTERN_T-SHIRT', 'tops', 'white', 'M',  'U', 12.99, 19, 15, 1, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

/* >>PRODUCT TYPE #3 */
SET @model_c := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_c, 'SPORTS_BRA', 'sportswear', 'black', 'XS',  'F', 19.99, 20, 12, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_c, 'SPORTS_BRA', 'sportswear', 'black', 'S',  'F', 19.99, 20, 12, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

SET @model_d := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_d, 'BOMBER_JACKET', 'jackets', 'white', 'M',  'U', 31.99, 15, 4, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_d, 'BOMBER_JACKET', 'jackets', 'white', 'L',  'U', 31.99, 15, 4, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

SET @model_e := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_e, 'JOGGERS', 'trousers', 'white', 'S',  'U', 24.99, 24, 38, 1, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_e, 'JOGGERS', 'trousers', 'white', 'M',  'U', 24.99, 23, 38, 2, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_e, 'JOGGERS', 'trousers', 'white', 'L', 'U', 24.99, 24, 38, 1, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

SET @model_f := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_f, 'POLO_SHIRT', 'tops', 'black', 'S',  'U', 17.99, 8, 57, 2, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_f, 'POLO_SHIRT', 'tops', 'black', 'M',  'U', 17.99, 6, 57, 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

SET @model_g := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_g, 'LONG_SHORTS', 'shorts', 'black', 'S',  'M', 22.99, 25, 4, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_g, 'LONG_SHORTS', 'shorts', 'black', 'M',  'M', 22.99, 25, 4, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_g, 'LONG_SHORTS', 'shorts', 'black', 'L',  'M', 22.99, 25, 4, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

SET @model_h := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_h, 'LEGGINGS', 'sportswear', 'black', 'S', 'F', 12.99, 9, 18, 1, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_h, 'LEGGINGS', 'sportswear', 'black', 'M', 'F',  12.99, 10, 18, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

SET @model_i := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_i, 'GYM_SHORTS', 'shorts', 'white', 'XS',  'F', 8.99, 5, 2, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_i, 'GYM_SHORTS', 'shorts', 'white', 'S',  'F', 8.99, 5, 2, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-09-01 05-30-01");

SET @model_j := UUID();
INSERT INTO products (model, name, category, color, size, gender, price, stock, views, bought_all_time, avg_rating, description, date_time)
VALUES (@model_j, 'SILK_SCARF', 'accessories', 'black', 'OS', 'U', 150.00, 1, 97, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', "2022-11-11 05-30-02");

/* Seeding orders table */
/*>>HOODIE ORDERS */
INSERT INTO orders (uid, pid, status, date_time)
VALUES (2, 1, 'delivered', "2022-09-04 06-30-53");

INSERT INTO orders (uid, pid, status, date_time)
VALUES (3, 2, 'refunded', "2022-09-08 14-23-21");

/*>>T-SHIRT ORDERS */
INSERT INTO orders (uid, pid, status, date_time)
VALUES (4, 5, 'delivered', "2022-09-12 11-53-21");

/*>>JOGGERS ORDERS */
INSERT INTO orders (uid, pid, status, date_time)
VALUES (5, 10, 'delivered', "2022-09-16 22-05-01");

INSERT INTO orders (uid, pid, status, date_time)
VALUES (6, 11, 'delivered', "2022-09-20 18-23-12");

INSERT INTO orders (uid, pid, status, date_time)
VALUES (2, 11, 'dispatched', "2022-09-24 01-23-22");

INSERT INTO orders (uid, pid, status, date_time)
VALUES (3, 12, 'delivered', "2022-09-28 04-23-44");

/*>>POLO SHIRT ORDERS */
INSERT INTO orders (uid, pid, status, date_time)
VALUES (4, 13, 'delivered', "2022-09-30 15-38-22");
INSERT INTO orders (uid, pid, status, date_time)
VALUES (5, 13, 'processing', "2022-10-04 11-11-23");

INSERT INTO orders (uid, pid, status, date_time)
VALUES (6, 14, 'delivered', "2022-10-08 21-23-09");
INSERT INTO orders (uid, pid, status, date_time)
VALUES (2, 14, 'delivered', "2022-10-12 21-53-51");
INSERT INTO orders (uid, pid, status, date_time)
VALUES (3, 14, 'delivered', "2022-10-16 14-23-21");
INSERT INTO orders (uid, pid, status, date_time)
VALUES (4, 14, 'delivered', "2022-10-20 15-58-59");

/*>>LEGGINGS ORDERS */
INSERT INTO orders (uid, pid, status, date_time)
VALUES (5, 18, 'refunded', "2022-10-24 20-20-20");

/* Seeding feedback table */
/*>>HOODIE FEEDBACK */
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('julius', @model_a, "Excellent product.", 5, 1666698294);
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('genghis', @model_a, "Shattered expectations really.", 1, 1666784694);

/*>>T-SHIRT FEEDBACK */
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('elon', @model_b, "Pretty cool.", 5, 1666871094);

/*>>JOGGERS FEEDBACK */
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('napoleon', @model_e, "Satisfied customer.", 5, 1666957494);
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('michael', @model_e, "Well-made, fits baggier than expected.", 4, 1667043894);
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('genghis', @model_e, "Meh.", 3, 1667130294);

/*>>POLO SHIRT FEEDBACK */
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('elon', @model_f, "Nice addition to my wardrobe.", 5, 1667216694);
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('genghis', @model_f, "Better than some.", 5, 1667303094);
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('elon', @model_f, "A fine gift for a nephew of mine.", 5, 1667389494);

/*>>LEGGINGS FEEDBACK */
INSERT INTO feedback (username, model, review, rating, seconds_since_epoch)
VALUES ('napoleon', @model_h, "She did not approve.", 2, 1667475894);
