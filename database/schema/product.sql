DROP TABLE IF EXISTS product;
CREATE TABLE product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    description TEXT,
    short_description TEXT,
    image TEXT UNIQUE ON CONFLICT ABORT,
    forwarded INTEGER,
    price INTEGER,
    amount INTEGER
);