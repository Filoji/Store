DROP TABLE IF EXISTS product;
CREATE TABLE product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    description TEXT,
    short_description TEXT,
    image TEXT UNIQUE ON CONFLICT ABORT,
    forwarded INTEGER DEFAULT 0,
    price INTEGER,
    amount INTEGER DEFAULT 0
);