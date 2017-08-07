CREATE DATABASE "HOTLIBRARY";

CREATE TABLE "User"(
  "id"        SERIAL        NOT NULL,
  "name"      VARCHAR(100)  NOT NULL,
  "email"     VARCHAR(100)  NOT NULL  UNIQUE,
  "password"  VARCHAR(128)  NOT NULL,
  "isActive"  BOOLEAN       NOT NULL  DEFAULT TRUE,
  "isAdmin"   BOOLEAN       NOT NULL  DEFAULT FALSE,
  PRIMARY KEY ("id")
);

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
