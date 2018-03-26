-- Table: public.posts

-- DROP TABLE public.posts;

CREATE TABLE public.posts
(
  id integer NOT NULL DEFAULT nextval('posts_id_seq'::regclass),
  title character varying(255) NOT NULL,
  content text NOT NULL,
  is_active boolean NOT NULL,
  category_id integer NOT NULL,
  created_at timestamp(0) without time zone,
  updated_at timestamp(0) without time zone,
  slug character varying(255),
  CONSTRAINT posts_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.posts
  OWNER TO dev;

-- Index: public.posts_slug_index

-- DROP INDEX public.posts_slug_index;

CREATE INDEX posts_slug_index
  ON public.posts
  USING btree
  (slug COLLATE pg_catalog."default");

