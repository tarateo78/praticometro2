CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "email" varchar not null,
  "email_verified_at" datetime,
  "password" varchar not null,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "users_email_unique" on "users"("email");
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE INDEX "cache_expiration_index" on "cache"("expiration");
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE INDEX "cache_locks_expiration_index" on "cache_locks"("expiration");
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "tests"(
  "id"	integer NOT NULL,
  "testo"	varchar,
  "numero"	integer,
  "valuta"	decimal,
  "data"	datetime,
  "created_at"	datetime,
  "updated_at"	datetime,
  PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "practices"(
  "id"	INTEGER,
  "codice"	TEXT,
  "is_in_corso"	INTEGER,
  "titolo"	TEXT,
  "titolo_esteso"	TEXT,
  "zona"	TEXT,
  "strade"	TEXT,
  "cup"	TEXT,
  "rup"	TEXT,
  "importo"	decimal,
  "finanziamento"	TEXT,
  "finanziamento_note"	TEXT,
  "is_rl"	INTEGER,
  "is_mims"	INTEGER,
  "rl_codice"	TEXT,
  "mims_codice"	TEXT,
  "fascicolo"	TEXT,
  "determina_gruppo"	TEXT,
  "gruppo"	TEXT,
  "avvio_servizio_at"	datetime,
  "is_avvio_progettazione"	INTEGER,
  "avvio_progettazione_at"	INTEGER,
  "progettista"	TEXT,
  "sicurezza"	TEXT,
  "fte_at"	datetime DEFAULT NULL,
  "def_at"	datetime DEFAULT NULL,
  "ese_at"	datetime DEFAULT NULL,
  "scadenza_progetto_at"	datetime DEFAULT NULL,
  "is_cds"	INTEGER,
  "cds_avvio_at"	datetime DEFAULT NULL,
  "cds_chiusa_at"	datetime DEFAULT NULL,
  "appunti_progettazione"	TEXT,
  "is_avvio_gara"	INTEGER,
  "contratto_at"	datetime DEFAULT NULL,
  "scadenza_affidamento_at"	datetime DEFAULT NULL,
  "is_lavori_in_corso"	INTEGER,
  "direttore_lavori"	TEXT,
  "assistente_dl"	TEXT,
  "consegna_lavori_at"	datetime DEFAULT NULL,
  "impresa"	TEXT,
  "lavori_note"	TEXT,
  "is_cre"	INTEGER,
  "cre_at"	datetime DEFAULT NULL,
  "scadenza_esecuzione_at"	datetime DEFAULT NULL,
  "pratica_note"	TEXT,
  "is_bdap"	INTEGER,
  "is_bdap_convalidato"	INTEGER,
  "bdap_note"	TEXT,
  "is_sito_internet"	INTEGER,
  "sito_internet_nota"	TEXT,
  "modifica_at"	datetime DEFAULT NULL,
  "modifica_utente"	TEXT,
  "coordinate"	TEXT,
  "file_count"	INTEGER,
  "file_effettivi_count"	INTEGER,
  "file_nuovi"	TEXT,
  "check_at"	datetime DEFAULT NULL,
  "is_cancellato"	INTEGER,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "user_practice"(
  "id"	integer NOT NULL,
  "user_id"	integer NOT NULL,
  "practice_id"	integer NOT NULL,
  "priority"	integer NOT NULL DEFAULT '0',
  "note"	varchar,
  "created_at"	datetime,
  "updated_at"	datetime,
  PRIMARY KEY("id" AUTOINCREMENT),
  FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade,
  FOREIGN KEY("practice_id") REFERENCES "practices"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "colonnes"(
  "nome"	TEXT,
  "testo"	TEXT,
  "tipo"	TEXT,
  "ordine"	INTEGER,
  "is_selezionabile"	INTEGER,
  "is_visibile"	INTEGER,
  PRIMARY KEY("nome")
);

INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2026_04_06_142026_create_posts_table',1);
INSERT INTO migrations VALUES(5,'2026_05_10_054237_create_tests_table',2);
INSERT INTO migrations VALUES(7,'2026_05_26_103439_create_user_practice_table',3);
