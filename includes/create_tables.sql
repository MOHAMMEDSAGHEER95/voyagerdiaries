CREATE TABLE users
  (
     id         SERIAL PRIMARY KEY,
     first_name VARCHAR(50) NOT NULL,
     last_name  VARCHAR(50),
     username   VARCHAR(50) UNIQUE NOT NULL,
     password   VARCHAR(50) NOT NULL
  ); 
CREATE TABLE reviews ( id SERIAL PRIMARY KEY,user_id INTEGER REFERENCES users(id), review TEXT,like_count INTEGER default 0);


CREATE TABLE reviews
  (
     id         SERIAL PRIMARY KEY,
     user_id    INTEGER REFERENCES users(id) NOT NULL,
     review     TEXT NOT NULL,
     like_count INTEGER DEFAULT 0
  );


CREATE TABLE liked_reviews (
  id SERIAL PRIMARY KEY,
  user_id INTEGER NOT NULL REFERENCES users(id),
  review_id INTEGER NOT NULL REFERENCES reviews(id) ON DELETE CASCADE,
  CONSTRAINT unique_user_review UNIQUE (user_id, review_id)
);