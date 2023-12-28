DROP TABLE IF EXISTS "order";
CREATE TABLE "order" (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    address TEXT,
    phone TEXT,
    code TEXT UNIQUE ON CONFLICT ROLLBACK
)