DROP TABLE IF EXISTS "Level";
CREATE TABLE "Level" (
  "id"        SERIAL        NOT NULL,
  "type"      VARCHAR(100)  NOT NULL UNIQUE,
  PRIMARY KEY ("id")
);

INSERT INTO "Level" ("type") VALUES ('administrador'),('biblioteca'),('comum');

DROP TABLE IF EXISTS "State";
CREATE TABLE "State" (
  "id"        SERIAL        NOT NULL,
  "initials"  CHAR(2)       NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "Neighborhood";
CREATE TABLE "Neighborhood" (
  "id"        SERIAL        NOT NULL,
  "name"      VARCHAR(100)  NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "City";
CREATE TABLE "City" (
  "id"            SERIAL        NOT NULL,
  "name"          VARCHAR(100)  NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "Zipcode";
CREATE TABLE "Zipcode" (
  "id"      SERIAL    NOT NULL,
  "number"  CHAR(8)   NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "Address";
CREATE TABLE "Address" (
  "id"            SERIAL        NOT NULL,
  "city"          INTEGER       NOT NULL,
  "zipcode"       INTEGER       NOT NULL,
  "neighborhood"  INTEGER       NOT NULL,
  "state"         INTEGER       NOT NULL,
  "number"        INTEGER       NOT NULL,
  "publicPlace"   VARCHAR(100)  NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT fk_address_city
    FOREIGN KEY ("city") REFERENCES "City" ("id") ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_address_zipcode
    FOREIGN KEY ("zipcode") REFERENCES "Zipcode"("id") ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_address_neighborhood
    FOREIGN KEY ("neighborhood") REFERENCES "Neighborhood" ("id") ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_address_state
    FOREIGN KEY ("state") REFERENCES "State" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "User";
CREATE TABLE "User"(
  "id"        SERIAL        NOT NULL,
  "address"   INTEGER       NOT NULL,
  "name"      VARCHAR(100)  NOT NULL,
  "email"     VARCHAR(100)  NOT NULL  UNIQUE,
  "password"  VARCHAR(128)  NOT NULL,
  "level"     INTEGER       NOT NULL,
  "isActive"  BOOLEAN       NOT NULL  DEFAULT TRUE,
  PRIMARY KEY ("id"),
  CONSTRAINT fk_user_level
    FOREIGN KEY ("level") REFERENCES "Level" ("id") ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_user_address
    FOREIGN KEY ("address") REFERENCES "Address" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "Library";
CREATE TABLE "Library" (
  "id" INTEGER  NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT fk_user_library
    FOREIGN KEY ("id") REFERENCES "User" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "Author";
CREATE TABLE "Author" (
  "id"      SERIAL        NOT NULL,
  "name"    VARCHAR(100)  NOT NULL,
  "deleted" BOOLEAN       NOT NULL DEFAULT FALSE,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "PublishingCompany";
CREATE TABLE "PublishingCompany" (
  "id"      SERIAL        NOT NULL,
  "name"    VARCHAR(100)  NOT NULL,
  "deleted" BOOLEAN       NOT NULL  DEFAULT FALSE,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "Category";
CREATE TABLE "Category" (
  "id"      SERIAL      NOT NULL,
  "name"    VARCHAR(50) NOT NULL,
  "deleted" BOOLEAN     NOT NULL  DEFAULT FALSE,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "Book";
CREATE TABLE "Book" (
  "id"                SERIAL          NOT NULL,
  "name"              VARCHAR(150)    NOT NULL,
  "publishDate"       DATE            NOT NULL,
  "pages"             INTEGER         NULL,
  "cover"             VARCHAR(255)    NULL      DEFAULT 'default.jpg',
  "edition"           INTEGER         NULL,
  "publishingCompany" INTEGER         NULL,
  "synopsis"          VARCHAR(250)    NULL,
  "deleted"           BOOLEAN         NOT NULL  DEFAULT FALSE,
  PRIMARY KEY ("id"),
  CONSTRAINT fk_book_publishingCompany
    FOREIGN KEY ("publishingCompany") REFERENCES "PublishingCompany" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "Library_has_Book";
CREATE TABLE "Library_has_Book" (
  "library"   INTEGER   NOT NULL,
  "book"      INTEGER   NOT NULL,
  PRIMARY KEY ("library","book"),
  CONSTRAINT fk_library_has_book_library
    FOREIGN KEY ("library") REFERENCES "Library" ("id") ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_library_has_book_book
    FOREIGN KEY ("book") REFERENCES "Book" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "Book_Category";
CREATE TABLE "Book_Category" (
  "book"      INTEGER NOT NULL,
  "category"  INTEGER NOT NULL,
  PRIMARY KEY ("book","category"),
  CONSTRAINT fk_book_category_book
    FOREIGN KEY ("book") REFERENCES "Book" ("id") ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_book_category_category
    FOREIGN KEY ("category") REFERENCES "Category" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "Book_Author";
CREATE TABLE "Book_Author" (
  "book"    INTEGER NOT NULL,
  "author"  INTEGER NOT NULL,
  CONSTRAINT fk_book_author_book
    FOREIGN KEY ("book") REFERENCES "Book" ("id"),
  CONSTRAINT fk_book_author_author
    FOREIGN KEY ("author") REFERENCES "Author" ("id")
);

DROP TABLE IF EXISTS "Log";
CREATE TABLE "Log" (
  "id"      SERIAL        NOT NULL,
  "ip"      CIDR          NOT NULL,
  "date"    DATE          NOT NULL,
  "time"    TIME          NOT NULL,
  "message" VARCHAR(255)  NOT NULL,
  "idUser"  INTEGER       NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT fk_log_user
    FOREIGN KEY ("idUser") REFERENCES "User"("id") ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "ForgotPassword";
CREATE TABLE "ForgotPassword" (
  "id"        SERIAL    NOT NULL,
  "expireAt"  TIMESTAMP NOT NULL,
  "token"     CHAR(64)  NOT NULL  UNIQUE,
  "idUser"    INTEGER   NOT NULL,
  "valid"     BOOLEAN   NOT NULL DEFAULT TRUE,
  PRIMARY KEY ("id"),
  CONSTRAINT fk_forgot_password_user
    FOREIGN KEY ("idUser") REFERENCES "User"("id") ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Usuário admin senha 'teste123'
INSERT INTO "Neighborhood" ("name") VALUES ('Indaiá');
INSERT INTO "State" ("initials") VALUES ('SP');
INSERT INTO "City" ("name") VALUES ('Caraguatatuba');
INSERT INTO "Zipcode" ("number") VALUES ('11665030');
INSERT INTO "Address" ("city","state","neighborhood","zipcode","number","publicPlace") VALUES (1,1,1,1,'643','av. rio grande do sul');
INSERT INTO "User" ("name","address","email","password","level") VALUES('admin',1,'admin@hotlibrary.com','535f56e6447ea0fcf3ef1bf5397066d037e9ebb7fd141068e8de9a23ece8eb6e7acf46d0e6bbf17edf2ebe6c80405991be53366138e835c3153019f164340619',1);
