# Super basic open room messaging system

- This is a super basic open room chat system, it's partly ajax and partly not.
- Ajax stuff can be found in the messages.php file if you want to look

```
I left the log in and sign up functions up to the normal browser behavior (loading/reloading).
Any errors here will occur with a link to go back, and can be seen in the URL on the redirect page.
```

For this code to work you need to set up your database for this chat system

## Prerequisites

- Make a database named messages or whatever you like.
- Make a table, you can name it whatever here it's called chat

  ```
  CREATE TABLE public.chat
  (
  id integer NOT NULL DEFAULT nextval('ajax_stuff_id_seq'::regclass),
  user_id character varying(255) COLLATE pg_catalog."default",
  username character varying(255) COLLATE pg_catalog."default",
  message character varying(255) COLLATE pg_catalog."default",
  created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT ajax_stuff_pkey PRIMARY KEY (id),
  CONSTRAINT chat_username_fkey FOREIGN KEY (username)
  REFERENCES public.log_in (username) MATCH SIMPLE
  )
  ```

- Make a table for users to log in/ sign up I called mine Log_in

```

CREATE TABLE public.log_in
(
user_id integer NOT NULL DEFAULT nextval('log_in_user_id_seq'::regclass),
username character varying(255) COLLATE pg_catalog."default",
email character varying(255) COLLATE pg_catalog."default",
password character varying(255) COLLATE pg_catalog."default",
CONSTRAINT log_in_pkey PRIMARY KEY (user_id),
CONSTRAINT username_log UNIQUE (username)
)

```

## Connect to your database

Inside the services/db_connect.php you need to change the connection details

```

`$conn = pg_connect("host=localhost port=5432 dbname={Yor database name} user={your postgres user name usually it's just postgres} password={the password you use to log in} options='--client_encoding=UTF8'");

```

Once this is done you should be able to use your PG admin to play around in the front end by reusing this connection code.

## If it's not working the PHP ini file might need to be tweaked a bit

- In EXAMPP it's located in the EXAMPP root folder php/php.ini
- Uncomment the following line in php.ini by removing the ";"

```
;extension=php_pgsql.dll
```

[Read more about the PHP ini file here](https://mediatemple.net/community/products/dv/204403894/how-can-i-edit-the-php.ini-file#:~:text=ini%20file%20is%20the%20default,server%20in%20the%20%2Fpublic_html%20folder.)
