--
-- PostgreSQL database dump
--

\restrict jtTeBWR1iEx77ccfZeDu1uTLbT94h9G6xUDg1vL0LmwfOwo7KbTwng64363D3FT

-- Dumped from database version 18.6 (Ubuntu 18.6-0ubuntu0.26.04.1)
-- Dumped by pg_dump version 18.6 (Ubuntu 18.6-0ubuntu0.26.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: campanhas; Type: TABLE; Schema: public; Owner: cdqc
--

CREATE TABLE public.campanhas (
    id integer NOT NULL,
    titulo character varying(255),
    descricao text,
    url_imagem character varying(255),
    data_criacao timestamp without time zone,
    user_id integer
);


ALTER TABLE public.campanhas OWNER TO cdqc;

--
-- Name: campanhas_id_seq; Type: SEQUENCE; Schema: public; Owner: cdqc
--

CREATE SEQUENCE public.campanhas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.campanhas_id_seq OWNER TO cdqc;

--
-- Name: campanhas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cdqc
--

ALTER SEQUENCE public.campanhas_id_seq OWNED BY public.campanhas.id;


--
-- Name: doacoes; Type: TABLE; Schema: public; Owner: cdqc
--

CREATE TABLE public.doacoes (
    id integer NOT NULL,
    valor numeric,
    data timestamp without time zone,
    id_volun integer
);


ALTER TABLE public.doacoes OWNER TO cdqc;

--
-- Name: doacoes_id_seq; Type: SEQUENCE; Schema: public; Owner: cdqc
--

CREATE SEQUENCE public.doacoes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.doacoes_id_seq OWNER TO cdqc;

--
-- Name: doacoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cdqc
--

ALTER SEQUENCE public.doacoes_id_seq OWNED BY public.doacoes.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: cdqc
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(255),
    password character varying(255),
    nome character varying(255),
    nascimento date,
    admin boolean
);


ALTER TABLE public.users OWNER TO cdqc;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: cdqc
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO cdqc;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cdqc
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: voluntarios; Type: TABLE; Schema: public; Owner: cdqc
--

CREATE TABLE public.voluntarios (
    id integer NOT NULL,
    cpf character varying(14),
    telefone character varying(20),
    data_volun timestamp without time zone,
    user_id integer
);


ALTER TABLE public.voluntarios OWNER TO cdqc;

--
-- Name: voluntarios_id_seq; Type: SEQUENCE; Schema: public; Owner: cdqc
--

CREATE SEQUENCE public.voluntarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.voluntarios_id_seq OWNER TO cdqc;

--
-- Name: voluntarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cdqc
--

ALTER SEQUENCE public.voluntarios_id_seq OWNED BY public.voluntarios.id;


--
-- Name: campanhas id; Type: DEFAULT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.campanhas ALTER COLUMN id SET DEFAULT nextval('public.campanhas_id_seq'::regclass);


--
-- Name: doacoes id; Type: DEFAULT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.doacoes ALTER COLUMN id SET DEFAULT nextval('public.doacoes_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: voluntarios id; Type: DEFAULT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.voluntarios ALTER COLUMN id SET DEFAULT nextval('public.voluntarios_id_seq'::regclass);


--
-- Data for Name: campanhas; Type: TABLE DATA; Schema: public; Owner: cdqc
--

COPY public.campanhas (id, titulo, descricao, url_imagem, data_criacao, user_id) FROM stdin;
1	teste	teste	https://www.sp.senai.br/images/senai.svg	2026-10-14 11:25:54.112887	0
\.


--
-- Data for Name: doacoes; Type: TABLE DATA; Schema: public; Owner: cdqc
--

COPY public.doacoes (id, valor, data, id_volun) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: cdqc
--

COPY public.users (id, email, password, nome, nascimento, admin) FROM stdin;
0	adm@gmail.com	adm123	Administrador	2010-05-01	t
4	gomes@gmail.com	gomes	Rafael	1979-12-12	f
\.


--
-- Data for Name: voluntarios; Type: TABLE DATA; Schema: public; Owner: cdqc
--

COPY public.voluntarios (id, cpf, telefone, data_volun, user_id) FROM stdin;
\.


--
-- Name: campanhas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cdqc
--

SELECT pg_catalog.setval('public.campanhas_id_seq', 1, true);


--
-- Name: doacoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cdqc
--

SELECT pg_catalog.setval('public.doacoes_id_seq', 1, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cdqc
--

SELECT pg_catalog.setval('public.users_id_seq', 8, true);


--
-- Name: voluntarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cdqc
--

SELECT pg_catalog.setval('public.voluntarios_id_seq', 1, true);


--
-- Name: campanhas campanhas_pkey; Type: CONSTRAINT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.campanhas
    ADD CONSTRAINT campanhas_pkey PRIMARY KEY (id);


--
-- Name: doacoes doacoes_pkey; Type: CONSTRAINT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.doacoes
    ADD CONSTRAINT doacoes_pkey PRIMARY KEY (id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: voluntarios voluntarios_pkey; Type: CONSTRAINT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.voluntarios
    ADD CONSTRAINT voluntarios_pkey PRIMARY KEY (id);


--
-- Name: campanhas fk_users; Type: FK CONSTRAINT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.campanhas
    ADD CONSTRAINT fk_users FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: voluntarios fk_users; Type: FK CONSTRAINT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.voluntarios
    ADD CONSTRAINT fk_users FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: doacoes fk_voluntarios; Type: FK CONSTRAINT; Schema: public; Owner: cdqc
--

ALTER TABLE ONLY public.doacoes
    ADD CONSTRAINT fk_voluntarios FOREIGN KEY (id_volun) REFERENCES public.voluntarios(id);


--
-- PostgreSQL database dump complete
--

\unrestrict jtTeBWR1iEx77ccfZeDu1uTLbT94h9G6xUDg1vL0LmwfOwo7KbTwng64363D3FT

