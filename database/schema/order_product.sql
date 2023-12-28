DROP TABLE IF EXISTS order_product;
CREATE TABLE order_product (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    amount INTEGER,
    product_id INTEGER,
    order_id INTEGER,
    FOREIGN KEY (product_id) REFERENCES product(id),
    FOREIGN KEY (order_id) REFERENCES "order"(id)
);