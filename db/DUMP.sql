--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.9
-- Dumped by pg_dump version 9.5.9

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: Address; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Address" (
    id integer NOT NULL,
    city integer NOT NULL,
    zipcode integer NOT NULL,
    neighborhood integer NOT NULL,
    state integer NOT NULL,
    number integer NOT NULL,
    "publicPlace" character varying(100) NOT NULL
);


ALTER TABLE "Address" OWNER TO postgres;

--
-- Name: Address_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Address_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Address_id_seq" OWNER TO postgres;

--
-- Name: Address_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Address_id_seq" OWNED BY "Address".id;


--
-- Name: Author; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Author" (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    deleted boolean DEFAULT false NOT NULL
);


ALTER TABLE "Author" OWNER TO postgres;

--
-- Name: Author_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Author_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Author_id_seq" OWNER TO postgres;

--
-- Name: Author_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Author_id_seq" OWNED BY "Author".id;


--
-- Name: Book; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Book" (
    id integer NOT NULL,
    name character varying(150) NOT NULL,
    "publishDate" date NOT NULL,
    pages integer,
    cover character varying(255),
    edition integer,
    "publishingCompany" integer,
    synopsis character varying(250),
    deleted boolean DEFAULT false NOT NULL
);


ALTER TABLE "Book" OWNER TO postgres;

--
-- Name: Book_Author; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Book_Author" (
    book integer NOT NULL,
    author integer NOT NULL,
    deleted boolean DEFAULT false NOT NULL
);


ALTER TABLE "Book_Author" OWNER TO postgres;

--
-- Name: Book_Category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Book_Category" (
    book integer NOT NULL,
    category integer NOT NULL,
    deleted boolean DEFAULT false NOT NULL
);


ALTER TABLE "Book_Category" OWNER TO postgres;

--
-- Name: Book_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Book_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Book_id_seq" OWNER TO postgres;

--
-- Name: Book_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Book_id_seq" OWNED BY "Book".id;


--
-- Name: Category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Category" (
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    deleted boolean DEFAULT false NOT NULL
);


ALTER TABLE "Category" OWNER TO postgres;

--
-- Name: Category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Category_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Category_id_seq" OWNER TO postgres;

--
-- Name: Category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Category_id_seq" OWNED BY "Category".id;


--
-- Name: City; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "City" (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE "City" OWNER TO postgres;

--
-- Name: City_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "City_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "City_id_seq" OWNER TO postgres;

--
-- Name: City_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "City_id_seq" OWNED BY "City".id;


--
-- Name: ForgotPassword; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "ForgotPassword" (
    id integer NOT NULL,
    "expireAt" timestamp without time zone NOT NULL,
    token character(64) NOT NULL,
    "idUser" integer NOT NULL,
    valid boolean DEFAULT true NOT NULL
);


ALTER TABLE "ForgotPassword" OWNER TO postgres;

--
-- Name: ForgotPassword_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "ForgotPassword_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "ForgotPassword_id_seq" OWNER TO postgres;

--
-- Name: ForgotPassword_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "ForgotPassword_id_seq" OWNED BY "ForgotPassword".id;


--
-- Name: Level; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Level" (
    id integer NOT NULL,
    type character varying(100) NOT NULL
);


ALTER TABLE "Level" OWNER TO postgres;

--
-- Name: Level_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Level_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Level_id_seq" OWNER TO postgres;

--
-- Name: Level_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Level_id_seq" OWNED BY "Level".id;


--
-- Name: Library; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Library" (
    id integer NOT NULL
);


ALTER TABLE "Library" OWNER TO postgres;

--
-- Name: Library_has_Book; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Library_has_Book" (
    library integer NOT NULL,
    book integer NOT NULL,
    deleted boolean DEFAULT false NOT NULL
);


ALTER TABLE "Library_has_Book" OWNER TO postgres;

--
-- Name: Log; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Log" (
    id integer NOT NULL,
    ip cidr NOT NULL,
    date date NOT NULL,
    "time" time without time zone NOT NULL,
    message character varying(255) NOT NULL,
    "idUser" integer NOT NULL
);


ALTER TABLE "Log" OWNER TO postgres;

--
-- Name: Log_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Log_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Log_id_seq" OWNER TO postgres;

--
-- Name: Log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Log_id_seq" OWNED BY "Log".id;


--
-- Name: Neighborhood; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Neighborhood" (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE "Neighborhood" OWNER TO postgres;

--
-- Name: Neighborhood_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Neighborhood_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Neighborhood_id_seq" OWNER TO postgres;

--
-- Name: Neighborhood_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Neighborhood_id_seq" OWNED BY "Neighborhood".id;


--
-- Name: PublishingCompany; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "PublishingCompany" (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    deleted boolean DEFAULT false NOT NULL
);


ALTER TABLE "PublishingCompany" OWNER TO postgres;

--
-- Name: PublishingCompany_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "PublishingCompany_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "PublishingCompany_id_seq" OWNER TO postgres;

--
-- Name: PublishingCompany_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "PublishingCompany_id_seq" OWNED BY "PublishingCompany".id;


--
-- Name: State; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "State" (
    id integer NOT NULL,
    initials character(2) NOT NULL
);


ALTER TABLE "State" OWNER TO postgres;

--
-- Name: State_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "State_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "State_id_seq" OWNER TO postgres;

--
-- Name: State_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "State_id_seq" OWNED BY "State".id;


--
-- Name: User; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "User" (
    id integer NOT NULL,
    address integer NOT NULL,
    name character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(128) NOT NULL,
    level integer NOT NULL,
    "isActive" boolean DEFAULT true NOT NULL
);


ALTER TABLE "User" OWNER TO postgres;

--
-- Name: User_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "User_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "User_id_seq" OWNER TO postgres;

--
-- Name: User_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "User_id_seq" OWNED BY "User".id;


--
-- Name: Zipcode; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Zipcode" (
    id integer NOT NULL,
    number character(8) NOT NULL
);


ALTER TABLE "Zipcode" OWNER TO postgres;

--
-- Name: Zipcode_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Zipcode_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Zipcode_id_seq" OWNER TO postgres;

--
-- Name: Zipcode_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Zipcode_id_seq" OWNED BY "Zipcode".id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Address" ALTER COLUMN id SET DEFAULT nextval('"Address_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Author" ALTER COLUMN id SET DEFAULT nextval('"Author_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Book" ALTER COLUMN id SET DEFAULT nextval('"Book_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Category" ALTER COLUMN id SET DEFAULT nextval('"Category_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "City" ALTER COLUMN id SET DEFAULT nextval('"City_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "ForgotPassword" ALTER COLUMN id SET DEFAULT nextval('"ForgotPassword_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Level" ALTER COLUMN id SET DEFAULT nextval('"Level_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Log" ALTER COLUMN id SET DEFAULT nextval('"Log_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Neighborhood" ALTER COLUMN id SET DEFAULT nextval('"Neighborhood_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "PublishingCompany" ALTER COLUMN id SET DEFAULT nextval('"PublishingCompany_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "State" ALTER COLUMN id SET DEFAULT nextval('"State_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "User" ALTER COLUMN id SET DEFAULT nextval('"User_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Zipcode" ALTER COLUMN id SET DEFAULT nextval('"Zipcode_id_seq"'::regclass);


--
-- Data for Name: Address; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Address" (id, city, zipcode, neighborhood, state, number, "publicPlace") FROM stdin;
1	1	1	1	1	643	av. rio grande do sul
2	1	1	1	1	643	Avenida Rio Grande do Sul
4	3	3	3	1	487	Rua Prudente de Morais
5	4	4	4	1	512	Rua Dois
7	4	4	4	1	78	Rua Dois
8	4	4	4	1	78	Rua Dois
11	1	7	7	1	875	Rua dos Guaranis
10	4	6	6	1	487	Rua José Bonifácio
\.


--
-- Name: Address_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Address_id_seq"', 11, true);


--
-- Data for Name: Author; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Author" (id, name, deleted) FROM stdin;
1	leonel caldela	f
4	oliver bowden	f
5	Sun tzu	f
6	flora figueiredo	f
7	cameron west	f
8	deive pazos	f
2	fulano de tal	t
3	fulano de tal	t
9	markus zusak	f
10	Antoine de Saint-Exupéry	f
\.


--
-- Name: Author_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Author_id_seq"', 10, true);


--
-- Data for Name: Book; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Book" (id, name, "publishDate", pages, cover, edition, "publishingCompany", synopsis, deleted) FROM stdin;
11	ozob: protocolo molotov	2016-06-14	480	poster_ozob_a3.jpg	4	8	O século 22 é uma época escura, feita de cibernética, inteligências artificiais, megacorporações que controlam governos, redes sociais onipresentes, gangues e violência.	f
18	o pequeno principe	1943-04-06	368	O-Pequeno-Principe.jpg	50	9	Apesar da presença explícita de dois personagens e do registro de um diálogo entre o aviador e uma criança, diversos aspectos autobiográficos estão presentes nesta narrativa, publicada pela primeira vez em 1945.	f
21	why so serious	2001-04-15	\N	capas-de-livros-para-crianacas7.jpg	\N	\N	\N	f
22	a culpa é das estrelas	2010-11-25	455	estrelas.jpg	2	11	esse livro é show.	f
13	a menina que roubava livros	2008-03-17	\N	a-menina-que-roubava-livros-capa-filme-1.jpg	10	9	teste.	f
10	ozob	2015-09-15	\N	default.jpg	1	8	essa é uma mensagem de teste.	t
14	a menina que roubava livros	2008-03-17	\N	a-menina-que-roubava-livros-capa-filme-1.jpg	10	9	teste.	t
19	why so serious	2008-08-14	20	Capas-de-Livros-para-Crianças7.jpg	2	10	\N	t
20	teste	2016-02-15	\N	estrelas.jpg	\N	\N	\N	t
16	ozob: protocolo molotov	2016-07-14	548	poster_OZOB_A3.jpg	2	8	essa é uma mensagem de teste.	t
17	ozob: protocolo molotov	2016-04-15	487	poster_OZOB_A3.jpg	2	8	essa é uma mensagem de teste.	t
15	ozob: protocolo molotov	2015-04-16	\N	poster_OZOB_A3.jpg	2	8	essa é uma mensagem de teste.	t
12	assassins creed: renacença	2010-03-25	550	capacherub4.jpg	1	10	esse é o assassins creed, um livro cheio de emoção do inicio ao fim, com personagens clássicos de nossa história.	f
\.


--
-- Data for Name: Book_Author; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Book_Author" (book, author, deleted) FROM stdin;
10	8	f
10	1	f
13	9	f
14	9	f
15	8	f
15	1	f
16	8	f
16	1	f
17	8	f
17	1	f
18	10	f
19	9	f
22	7	f
12	4	t
12	4	t
12	4	f
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	t
11	1	t
11	8	f
11	1	f
\.


--
-- Data for Name: Book_Category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Book_Category" (book, category, deleted) FROM stdin;
15	9	f
15	11	f
16	9	f
16	12	f
16	11	f
17	9	f
17	12	f
17	11	f
18	12	f
19	12	f
22	1	f
11	9	t
11	12	t
12	9	t
12	12	t
12	9	f
12	12	f
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	t
11	12	t
11	11	t
11	9	f
11	12	f
11	11	f
\.


--
-- Name: Book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Book_id_seq"', 22, true);


--
-- Data for Name: Category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Category" (id, name, deleted) FROM stdin;
1	romance	f
2	terror	f
9	ação	f
11	ficção cientifica	f
12	aventura	f
10	outro teste	t
4	teste	t
6	teste	t
3	teste	t
5	teste	t
8	teste	t
7	teste	t
13	biografia	t
14	biografia	f
15	teste	t
16	outro teste	t
17	teste	t
18	teste	t
19	teste	t
20	teste	t
21	teste	t
\.


--
-- Name: Category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Category_id_seq"', 21, true);


--
-- Data for Name: City; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "City" (id, name) FROM stdin;
1	Caraguatatuba
3	Cubatão
4	Guarujá
\.


--
-- Name: City_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"City_id_seq"', 4, true);


--
-- Data for Name: ForgotPassword; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "ForgotPassword" (id, "expireAt", token, "idUser", valid) FROM stdin;
\.


--
-- Name: ForgotPassword_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"ForgotPassword_id_seq"', 1, false);


--
-- Data for Name: Level; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Level" (id, type) FROM stdin;
1	administrador
2	biblioteca
3	comum
\.


--
-- Name: Level_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Level_id_seq"', 3, true);


--
-- Data for Name: Library; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Library" (id) FROM stdin;
10
11
\.


--
-- Data for Name: Library_has_Book; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Library_has_Book" (library, book, deleted) FROM stdin;
10	21	f
10	18	f
10	13	f
10	22	f
10	12	t
10	12	t
10	11	t
10	11	f
\.


--
-- Data for Name: Log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Log" (id, ip, date, "time", message, "idUser") FROM stdin;
1	::1/128	2017-10-23	10:35:08	Fez login	1
2	::1/128	2017-10-24	06:25:52	Fez login	1
3	::1/128	2017-10-24	06:25:52	Fez login	1
4	::1/128	2017-10-25	09:40:25	Fez login	1
5	::1/128	2017-10-25	09:40:41	Fez login	1
6	::1/128	2017-10-25	09:41:25	Fez login	1
7	::1/128	2017-10-25	09:42:30	Fez login	1
8	::1/128	2017-10-25	09:43:14	Fez login	1
9	::1/128	2017-10-25	09:44:15	Fez login	1
10	::1/128	2017-10-25	09:45:07	Fez login	1
11	::1/128	2017-10-25	09:46:56	Fez login	1
12	::1/128	2017-10-25	09:47:29	Fez login	1
13	::1/128	2017-10-25	09:49:07	Fez login	1
14	::1/128	2017-10-25	03:42:31	Fez login	1
15	::1/128	2017-10-25	04:25:45	Cadastrou uma nova categoria	1
16	::1/128	2017-10-25	04:28:39	Cadastrou uma nova categoria	1
17	::1/128	2017-10-25	04:29:07	Cadastrou uma nova categoria	1
18	::1/128	2017-10-25	04:29:36	Cadastrou uma nova categoria	1
19	::1/128	2017-10-25	04:30:25	Cadastrou uma nova categoria	1
20	::1/128	2017-10-25	04:31:13	Cadastrou uma nova categoria	1
21	::1/128	2017-10-25	04:33:14	Cadastrou uma nova categoria	1
22	::1/128	2017-10-26	10:59:37	Fez login	1
23	::1/128	2017-10-26	12:28:31	Cadastrou uma nova categoria	1
24	::1/128	2017-10-26	12:31:12	Cadastrou uma nova categoria	1
25	::1/128	2017-10-26	12:34:08	Cadastrou uma nova categoria	1
26	::1/128	2017-10-26	12:55:17	Cadastrou uma nova categoria	1
27	::1/128	2017-10-26	04:56:58	Fez login	1
28	::1/128	2017-10-26	06:08:57	Ocorreu uma erro ao deletar a categoria	1
29	::1/128	2017-10-26	06:12:54	Ocorreu uma erro ao deletar a categoria	1
30	::1/128	2017-10-26	06:13:06	Ocorreu uma erro ao deletar a categoria	1
31	::1/128	2017-10-26	06:13:17	Ocorreu uma erro ao deletar a categoria	1
32	::1/128	2017-10-26	06:16:16	Ocorreu uma erro ao deletar a categoria	1
33	::1/128	2017-10-26	06:23:43	Deletou uma categoria	1
34	::1/128	2017-10-26	06:24:56	Deletou uma categoria	1
35	::1/128	2017-10-26	06:25:02	Deletou uma categoria	1
36	::1/128	2017-10-26	06:25:07	Deletou uma categoria	1
37	::1/128	2017-10-26	06:25:10	Deletou uma categoria	1
38	::1/128	2017-10-26	06:25:13	Deletou uma categoria	1
39	::1/128	2017-10-26	06:25:16	Deletou uma categoria	1
40	::1/128	2017-10-26	06:26:08	Cadastrou uma nova categoria	1
41	::1/128	2017-10-26	06:26:29	Deletou uma categoria	1
42	::1/128	2017-10-26	06:26:45	Cadastrou uma nova categoria	1
43	::1/128	2017-10-26	06:30:39	Cadastrou uma nova categoria	1
44	::1/128	2017-10-26	06:30:52	Deletou uma categoria	1
45	::1/128	2017-10-26	06:31:09	Cadastrou uma nova categoria	1
46	::1/128	2017-10-26	06:31:18	Deletou uma categoria	1
47	::1/128	2017-10-27	10:58:30	Fez login	1
48	::1/128	2017-10-27	11:05:22	Fez login	1
49	::1/128	2017-10-27	11:05:38	Cadastrou uma nova categoria	1
50	::1/128	2017-10-27	11:07:07	Novo usuário cadastrado no sistema	1
51	::1/128	2017-10-27	11:19:34	Deletou uma categoria	1
52	::1/128	2017-10-27	11:20:01	Cadastrou uma nova categoria	1
53	::1/128	2017-10-27	11:23:19	Deletou uma categoria	1
54	::1/128	2017-10-27	11:24:44	Cadastrou uma nova categoria	1
55	::1/128	2017-10-27	11:25:09	Deletou uma categoria	1
56	::1/128	2017-10-27	11:28:38	Cadastrou uma nova categoria	1
57	::1/128	2017-10-27	11:36:53	Deletou uma categoria	1
58	::1/128	2017-10-27	11:37:51	Cadastrou uma nova categoria	1
59	::1/128	2017-10-27	11:38:01	Deletou uma categoria	1
60	::1/128	2017-10-27	01:55:08	Ocorreu uma erro ao cadastrar o(a) autor(a)	1
61	::1/128	2017-10-27	01:59:10	Ocorreu um erro ao cadastrar o(a) autor(a)	1
62	::1/128	2017-10-27	02:01:18	Cadastrou um novo(a) autor(a)	1
63	::1/128	2017-10-27	02:05:56	Cadastrou um novo(a) autor(a)	1
64	::1/128	2017-10-27	04:55:01	Fez login	1
65	::1/128	2017-10-27	05:18:58	Cadastrou um novo(a) autor(a)	1
66	::1/128	2017-10-27	05:19:18	Cadastrou um novo(a) autor(a)	1
67	::1/128	2017-10-27	05:19:53	Cadastrou um novo(a) autor(a)	1
68	::1/128	2017-10-27	05:20:17	Cadastrou um novo(a) autor(a)	1
69	::1/128	2017-10-27	05:20:46	Cadastrou um novo(a) autor(a)	1
70	::1/128	2017-10-27	06:30:37	Deletou um(a) autor(a)	1
71	::1/128	2017-10-27	06:30:53	Deletou um(a) autor(a)	1
72	::1/128	2017-10-29	12:09:53	Fez login	1
73	::1/128	2017-10-29	01:34:35	Cadastrou uma editora	1
74	::1/128	2017-10-29	01:40:10	Cadastrou uma editora	1
75	::1/128	2017-10-29	01:44:31	Cadastrou uma editora	1
76	::1/128	2017-10-29	01:45:59	Cadastrou uma editora	1
77	::1/128	2017-10-29	01:47:18	Cadastrou uma editora	1
78	::1/128	2017-10-29	01:49:12	Cadastrou uma editora	1
79	::1/128	2017-10-29	02:32:00	Deletou uma editora	1
80	::1/128	2017-10-29	02:33:27	Cadastrou uma editora	1
81	::1/128	2017-10-29	02:33:37	Cadastrou uma editora	1
82	::1/128	2017-10-29	02:33:41	Cadastrou uma editora	1
83	::1/128	2017-10-29	02:33:48	Deletou uma editora	1
84	::1/128	2017-10-30	10:08:24	Fez login	1
85	::1/128	2017-10-30	10:08:37	Cadastrou uma editora	1
86	::1/128	2017-10-30	10:09:14	Cadastrou uma editora	1
87	::1/128	2017-10-31	10:57:59	Fez login	2
88	::1/128	2017-10-31	12:40:11	Fez login	2
89	::1/128	2017-10-31	05:56:06	Fez login	1
90	::1/128	2017-11-01	10:41:49	Fez login	2
91	::1/128	2017-11-01	02:14:06	Cadastrou uma editora	2
92	::1/128	2017-11-01	06:21:08	Fez upload de uma capa de livro	2
93	::1/128	2017-11-01	06:24:21	Fez upload de uma capa de livro	2
94	::1/128	2017-11-01	06:26:38	Fez upload de uma capa de livro	2
95	::1/128	2017-11-01	06:26:48	Ocorreu um erro ao carregar a capa de um livro	2
96	::1/128	2017-11-02	11:05:53	Fez login	1
97	::1/128	2017-11-02	01:24:58	Cadastrou um livro	1
98	::1/128	2017-11-02	01:25:15	Cadastrou um livro	1
99	::1/128	2017-11-02	01:25:46	Cadastrou um livro	1
100	::1/128	2017-11-02	01:25:46	Fez upload de uma capa de livro	1
101	::1/128	2017-11-02	01:26:30	Cadastrou um livro	1
102	::1/128	2017-11-02	01:26:30	Ocorreu um erro ao carregar a capa de um livro	1
103	::1/128	2017-11-02	01:37:31	Cadastrou um livro	1
104	::1/128	2017-11-02	01:37:31	Fez upload de uma capa de livro	1
105	::1/128	2017-11-02	01:55:05	Cadastrou um livro	1
106	::1/128	2017-11-02	01:55:05	Fez upload de uma capa de livro	1
107	::1/128	2017-11-02	02:01:05	Cadastrou um novo(a) autor(a)	1
108	::1/128	2017-11-02	02:02:08	Cadastrou um livro	1
109	::1/128	2017-11-02	02:02:08	Fez upload de uma capa de livro	1
110	::1/128	2017-11-02	02:03:07	Cadastrou um livro	1
111	::1/128	2017-11-02	02:03:07	Fez upload de uma capa de livro	1
112	::1/128	2017-11-02	08:13:42	Fez login	2
113	::1/128	2017-11-02	08:19:38	Cadastrou um livro	2
114	::1/128	2017-11-02	08:19:38	Fez upload de uma capa de livro	2
115	::1/128	2017-11-02	08:51:11	Cadastrou um livro	2
116	::1/128	2017-11-02	08:51:11	Fez upload de uma capa de livro	2
117	::1/128	2017-11-02	08:59:18	Cadastrou um livro	2
118	::1/128	2017-11-02	08:59:18	Fez upload de uma capa de livro	2
119	::1/128	2017-11-03	05:10:59	Fez login	2
120	::1/128	2017-11-03	07:48:48	Cadastrou um novo(a) autor(a)	2
121	::1/128	2017-11-03	07:53:22	Cadastrou um livro	2
122	::1/128	2017-11-03	07:53:22	Fez upload de uma capa de livro	2
123	::1/128	2017-11-03	08:02:47	Cadastrou um livro	2
124	::1/128	2017-11-03	08:02:48	Fez upload de uma capa de livro	2
125	::1/128	2017-11-03	08:22:26	Novo usuário cadastrado no sistema	2
126	::1/128	2017-11-03	08:23:15	Fez login	4
127	::1/128	2017-11-03	08:28:33	Fez login	2
128	::1/128	2017-11-03	08:29:26	Novo usuário cadastrado no sistema	2
129	::1/128	2017-11-03	09:25:33	Novo usuário cadastrado no sistema	2
130	::1/128	2017-11-03	09:26:30	Novo usuário cadastrado no sistema	2
131	::1/128	2017-11-03	09:31:07	Ocorreu um erro ao cadastrar um novo usuário	2
132	::1/128	2017-11-03	09:32:17	Novo usuário cadastrado no sistema	2
133	::1/128	2017-11-03	09:34:55	Novo usuário cadastrado no sistema	2
134	::1/128	2017-11-04	11:47:57	Fez login	1
135	::1/128	2017-11-04	10:02:56	Fez login	2
136	::1/128	2017-11-04	10:23:37	Cadastrou um livro	2
137	::1/128	2017-11-04	11:55:15	Cadastrou um livro	2
138	::1/128	2017-11-04	11:55:15	Fez upload de uma capa de livro	2
139	::1/128	2017-11-04	03:14:11	Fez login	1
141	::1/128	2017-11-04	10:19:33	Usuário alterou a senha	4
142	::1/128	2017-11-04	10:23:28	Usuário alterou a senha	4
143	::1/128	2017-11-04	10:24:25	Usuário alterou a senha	4
144	::1/128	2017-11-04	10:25:09	Usuário alterou a senha	4
145	::1/128	2017-11-04	10:26:49	Usuário alterou a senha	4
146	::1/128	2017-11-04	10:27:53	Usuário alterou a senha	4
147	::1/128	2017-11-04	10:29:12	Usuário alterou a senha	4
148	::1/128	2017-11-04	10:30:29	Usuário alterou a senha	4
149	::1/128	2017-11-04	10:33:51	Usuário alterou a senha	4
150	::1/128	2017-11-05	08:44:46	Fez login	2
151	::1/128	2017-11-05	05:21:17	Fez login	2
152	::1/128	2017-11-05	06:25:41	Ocorreu um erro ao adicionar livros a biblioteca	2
153	::1/128	2017-11-05	06:27:07	Ocorreu um erro ao adicionar livros a biblioteca	2
154	::1/128	2017-11-05	06:27:21	Adicionou livro a biblioteca	2
155	::1/128	2017-11-05	06:31:09	Adicionou livro a biblioteca	2
156	::1/128	2017-11-05	06:39:33	Adicionou livro a biblioteca	2
157	::1/128	2017-11-05	06:49:04	Cadastrou um livro	2
158	::1/128	2017-11-05	06:49:05	Fez upload de uma capa de livro	2
159	::1/128	2017-11-05	06:49:52	Adicionou livro a biblioteca	2
160	::1/128	2017-11-05	07:12:19	Fez login	10
161	::1/128	2017-11-05	07:26:59	Fez login	1
162	::1/128	2017-11-05	07:40:18	Fez login	10
163	::1/128	2017-11-05	07:42:00	Fez login	10
164	::1/128	2017-11-05	07:50:04	Fez login	10
165	::1/128	2017-11-06	09:19:53	Fez login	2
166	::1/128	2017-11-06	09:22:17	Fez login	2
167	::1/128	2017-11-06	09:23:43	Fez login	10
168	::1/128	2017-11-06	09:45:45	Fez login	1
169	::1/128	2017-11-06	03:06:58	Livro deletado com sucesso	1
170	::1/128	2017-11-06	03:07:35	Livro deletado com sucesso	1
171	::1/128	2017-11-06	03:09:39	Livro deletado com sucesso	1
172	::1/128	2017-11-06	03:11:57	Livro deletado com sucesso	1
173	::1/128	2017-11-06	03:13:05	Livro deletado com sucesso	1
174	::1/128	2017-11-06	03:13:27	Livro deletado com sucesso	1
175	::1/128	2017-11-06	03:13:54	Livro deletado com sucesso	1
176	::1/128	2017-11-06	03:14:13	Livro deletado com sucesso	1
177	::1/128	2017-11-06	03:15:10	Livro deletado com sucesso	1
178	::1/128	2017-11-06	03:16:20	Livro deletado com sucesso	1
179	::1/128	2017-11-06	03:19:30	O livro não pode ser deletado	1
180	::1/128	2017-11-06	03:19:38	O livro não pode ser deletado	1
181	::1/128	2017-11-06	03:19:53	Livro deletado com sucesso	1
182	::1/128	2017-11-06	03:20:09	O livro não pode ser deletado	1
183	::1/128	2017-11-06	03:20:20	Livro deletado com sucesso	1
184	::1/128	2017-11-06	03:20:39	Livro deletado com sucesso	1
185	::1/128	2017-11-06	03:20:55	Livro deletado com sucesso	1
186	::1/128	2017-11-06	03:21:11	Livro deletado com sucesso	1
187	::1/128	2017-11-06	03:21:27	O livro não pode ser deletado	1
188	::1/128	2017-11-06	03:21:35	Livro deletado com sucesso	1
189	::1/128	2017-11-06	03:22:40	Livro deletado com sucesso	1
190	::1/128	2017-11-07	08:25:22	Fez login	2
191	::1/128	2017-11-07	08:34:00	O livro não pode ser deletado	2
192	::1/128	2017-11-07	08:42:10	Fez login	10
193	::1/128	2017-11-07	08:50:38	Fez login	2
194	::1/128	2017-11-07	08:54:59	Fez login	10
195	::1/128	2017-11-07	09:41:46	Deletou um livro da biblioteca	10
196	::1/128	2017-11-07	09:44:12	Adicionou livro a biblioteca	10
197	::1/128	2017-11-07	09:44:33	Deletou um livro da biblioteca	10
198	::1/128	2017-11-07	01:45:55	Fez login	2
199	::1/128	2017-11-07	11:01:08	Fez login	2
200	::1/128	2017-11-07	11:53:45	Editou os dados do livro	2
201	::1/128	2017-11-07	11:54:29	Editou os dados do livro	2
202	::1/128	2017-11-07	11:54:52	Editou os dados do livro	2
203	::1/128	2017-11-07	11:56:36	Editou os dados do livro	2
204	::1/128	2017-11-07	11:59:20	Editou os dados do livro	2
205	::1/128	2017-11-08	12:09:44	Editou os dados do livro	2
206	::1/128	2017-11-08	12:09:45	Fez upload de uma capa de livro	2
207	::1/128	2017-11-08	12:10:34	Editou os dados do livro	2
208	::1/128	2017-11-08	12:10:35	Fez upload de uma capa de livro	2
209	::1/128	2017-11-08	12:11:08	Editou os dados do livro	2
210	::1/128	2017-11-08	12:11:08	Fez upload de uma capa de livro	2
211	::1/128	2017-11-08	12:13:35	Editou os dados do livro	2
212	::1/128	2017-11-08	12:14:30	Fez login	10
213	::1/128	2017-11-08	12:14:41	Deletou um livro da biblioteca	10
214	::1/128	2017-11-08	12:14:56	Adicionou livro a biblioteca	10
215	::1/128	2017-11-08	12:15:23	Editou os dados do livro	10
216	::1/128	2017-11-08	12:15:23	Fez upload de uma capa de livro	10
219	::1/128	2017-11-08	12:19:03	Editou os dados do usuário	10
220	::1/128	2017-11-09	08:19:19	Fez login	1
\.


--
-- Name: Log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Log_id_seq"', 220, true);


--
-- Data for Name: Neighborhood; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Neighborhood" (id, name) FROM stdin;
1	Indaiá
3	Vila Elizabeth
4	Acapulco
6	Jardim Enguaguassu (Vicente de Carvalho)
7	Vila Atlântica
\.


--
-- Name: Neighborhood_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Neighborhood_id_seq"', 7, true);


--
-- Data for Name: PublishingCompany; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "PublishingCompany" (id, name, deleted) FROM stdin;
1		t
2	teste	t
3	teste	t
4	teste	t
5	teste	t
6	teste	t
8	nerdbooks	f
9	abril	f
7	teste	t
10	darkside	f
11	dark horse	f
12	mundo nerd	f
\.


--
-- Name: PublishingCompany_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"PublishingCompany_id_seq"', 12, true);


--
-- Data for Name: State; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "State" (id, initials) FROM stdin;
1	SP
\.


--
-- Name: State_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"State_id_seq"', 1, true);


--
-- Data for Name: User; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "User" (id, address, name, email, password, level, "isActive") FROM stdin;
2	2	caio de freitas adriano	caiof.adriano@hotmail.com	02f28cc67759c9e3f86fda8354a6432f95485a506352ebb660f1d8845739d1b37e7a847df585c1f9121e50f73a44f97f33eca3b1e8fa918ac7eb11ef96d6f92e	1	t
1	1	admin	admin@hotlibrary.com	535f56e6447ea0fcf3ef1bf5397066d037e9ebb7fd141068e8de9a23ece8eb6e7acf46d0e6bbf17edf2ebe6c80405991be53366138e835c3153019f164340619	1	t
5	5	biblioteca teste 02	teste02@teste.com	535f56e6447ea0fcf3ef1bf5397066d037e9ebb7fd141068e8de9a23ece8eb6e7acf46d0e6bbf17edf2ebe6c80405991be53366138e835c3153019f164340619	2	t
7	7	biblioteca teste 03	teste03@teste.com	535f56e6447ea0fcf3ef1bf5397066d037e9ebb7fd141068e8de9a23ece8eb6e7acf46d0e6bbf17edf2ebe6c80405991be53366138e835c3153019f164340619	2	t
8	8	biblioteca teste 04	teste04@teste.com	535f56e6447ea0fcf3ef1bf5397066d037e9ebb7fd141068e8de9a23ece8eb6e7acf46d0e6bbf17edf2ebe6c80405991be53366138e835c3153019f164340619	2	t
11	11	biblioteca de teste 06	teste06@teste.com	535f56e6447ea0fcf3ef1bf5397066d037e9ebb7fd141068e8de9a23ece8eb6e7acf46d0e6bbf17edf2ebe6c80405991be53366138e835c3153019f164340619	2	t
4	4	biblioteca	caiof.adriano28@gmail.com	02f28cc67759c9e3f86fda8354a6432f95485a506352ebb660f1d8845739d1b37e7a847df585c1f9121e50f73a44f97f33eca3b1e8fa918ac7eb11ef96d6f92e	2	t
10	10	biblioteca de teste 05	teste05@teste.com	535f56e6447ea0fcf3ef1bf5397066d037e9ebb7fd141068e8de9a23ece8eb6e7acf46d0e6bbf17edf2ebe6c80405991be53366138e835c3153019f164340619	2	t
\.


--
-- Name: User_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"User_id_seq"', 11, true);


--
-- Data for Name: Zipcode; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Zipcode" (id, number) FROM stdin;
1	11665030
3	11550030
4	11445050
6	11450040
7	11662030
\.


--
-- Name: Zipcode_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Zipcode_id_seq"', 7, true);


--
-- Name: Address_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Address"
    ADD CONSTRAINT "Address_pkey" PRIMARY KEY (id);


--
-- Name: Author_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Author"
    ADD CONSTRAINT "Author_pkey" PRIMARY KEY (id);


--
-- Name: Book_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Book"
    ADD CONSTRAINT "Book_pkey" PRIMARY KEY (id);


--
-- Name: Category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Category"
    ADD CONSTRAINT "Category_pkey" PRIMARY KEY (id);


--
-- Name: City_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "City"
    ADD CONSTRAINT "City_pkey" PRIMARY KEY (id);


--
-- Name: ForgotPassword_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "ForgotPassword"
    ADD CONSTRAINT "ForgotPassword_pkey" PRIMARY KEY (id);


--
-- Name: ForgotPassword_token_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "ForgotPassword"
    ADD CONSTRAINT "ForgotPassword_token_key" UNIQUE (token);


--
-- Name: Level_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Level"
    ADD CONSTRAINT "Level_pkey" PRIMARY KEY (id);


--
-- Name: Level_type_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Level"
    ADD CONSTRAINT "Level_type_key" UNIQUE (type);


--
-- Name: Library_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Library"
    ADD CONSTRAINT "Library_pkey" PRIMARY KEY (id);


--
-- Name: Log_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Log"
    ADD CONSTRAINT "Log_pkey" PRIMARY KEY (id);


--
-- Name: Neighborhood_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Neighborhood"
    ADD CONSTRAINT "Neighborhood_pkey" PRIMARY KEY (id);


--
-- Name: PublishingCompany_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "PublishingCompany"
    ADD CONSTRAINT "PublishingCompany_pkey" PRIMARY KEY (id);


--
-- Name: State_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "State"
    ADD CONSTRAINT "State_pkey" PRIMARY KEY (id);


--
-- Name: User_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "User"
    ADD CONSTRAINT "User_email_key" UNIQUE (email);


--
-- Name: User_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "User"
    ADD CONSTRAINT "User_pkey" PRIMARY KEY (id);


--
-- Name: Zipcode_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Zipcode"
    ADD CONSTRAINT "Zipcode_pkey" PRIMARY KEY (id);


--
-- Name: fk_address_city; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Address"
    ADD CONSTRAINT fk_address_city FOREIGN KEY (city) REFERENCES "City"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_address_neighborhood; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Address"
    ADD CONSTRAINT fk_address_neighborhood FOREIGN KEY (neighborhood) REFERENCES "Neighborhood"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_address_state; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Address"
    ADD CONSTRAINT fk_address_state FOREIGN KEY (state) REFERENCES "State"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_address_zipcode; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Address"
    ADD CONSTRAINT fk_address_zipcode FOREIGN KEY (zipcode) REFERENCES "Zipcode"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_book_author_author; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Book_Author"
    ADD CONSTRAINT fk_book_author_author FOREIGN KEY (author) REFERENCES "Author"(id);


--
-- Name: fk_book_author_book; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Book_Author"
    ADD CONSTRAINT fk_book_author_book FOREIGN KEY (book) REFERENCES "Book"(id);


--
-- Name: fk_book_category_book; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Book_Category"
    ADD CONSTRAINT fk_book_category_book FOREIGN KEY (book) REFERENCES "Book"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_book_category_category; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Book_Category"
    ADD CONSTRAINT fk_book_category_category FOREIGN KEY (category) REFERENCES "Category"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_book_publishingcompany; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Book"
    ADD CONSTRAINT fk_book_publishingcompany FOREIGN KEY ("publishingCompany") REFERENCES "PublishingCompany"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_forgot_password_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "ForgotPassword"
    ADD CONSTRAINT fk_forgot_password_user FOREIGN KEY ("idUser") REFERENCES "User"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_library_has_book_book; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Library_has_Book"
    ADD CONSTRAINT fk_library_has_book_book FOREIGN KEY (book) REFERENCES "Book"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_library_has_book_library; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Library_has_Book"
    ADD CONSTRAINT fk_library_has_book_library FOREIGN KEY (library) REFERENCES "Library"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_log_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Log"
    ADD CONSTRAINT fk_log_user FOREIGN KEY ("idUser") REFERENCES "User"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_address; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "User"
    ADD CONSTRAINT fk_user_address FOREIGN KEY (address) REFERENCES "Address"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_level; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "User"
    ADD CONSTRAINT fk_user_level FOREIGN KEY (level) REFERENCES "Level"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: fk_user_library; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Library"
    ADD CONSTRAINT fk_user_library FOREIGN KEY (id) REFERENCES "User"(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

