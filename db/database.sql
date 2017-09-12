CREATE DATABASE "HOTLIBRARY";

CREATE TABLE "Level" (
  "id"        SERIAL        NOT NULL,
  "type"      VARCHAR(100)  NOT NULL UNIQUE,
  PRIMARY KEY ("id")
);

INSERT INTO "Level" ("type") VALUES ('administrador'),('biblioteca'),('comum');

CREATE TABLE "User"(
  "id"        SERIAL        NOT NULL,
  "name"      VARCHAR(100)  NOT NULL,
  "email"     VARCHAR(100)  NOT NULL  UNIQUE,
  "password"  VARCHAR(128)  NOT NULL,
  "level"     INTEGER       NOT NULL,
  "isActive"  BOOLEAN       NOT NULL  DEFAULT TRUE,
  PRIMARY KEY ("id"),
  CONSTRAINT fk_user_level
    FOREIGN KEY ("level") REFERENCES "Level" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
);
-- Usuário admin senha 'teste123'
INSERT INTO "User" ("name","email","password","level") VALUES('admin','admin@hotlibrary.com','535f56e6447ea0fcf3ef1bf5397066d037e9ebb7fd141068e8de9a23ece8eb6e7acf46d0e6bbf17edf2ebe6c80405991be53366138e835c3153019f164340619',1);

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
