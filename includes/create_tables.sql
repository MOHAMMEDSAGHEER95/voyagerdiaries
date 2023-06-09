CREATE TABLE users
  (
     id         SERIAL PRIMARY KEY,
     first_name VARCHAR(50) NOT NULL,
     last_name  VARCHAR(50),
     username   VARCHAR(50) UNIQUE NOT NULL,
     password   VARCHAR(50) NOT NULL,
     is_active BOOLEAN DEFAULT TRUE,
     is_admin BOOLEAN DEFAULT FALSE
  );


CREATE TABLE reviews
  (
     id         SERIAL PRIMARY KEY,
     user_id    INTEGER REFERENCES users(id) NOT NULL,
     review     TEXT NOT NULL,
     like_count INTEGER DEFAULT 0,
     admin_reply VARCHAR(255) DEFAULT ''
  );


CREATE TABLE liked_reviews (
  id SERIAL PRIMARY KEY,
  user_id INTEGER NOT NULL REFERENCES users(id),
  review_id INTEGER NOT NULL REFERENCES reviews(id) ON DELETE CASCADE,
  CONSTRAINT unique_user_review UNIQUE (user_id, review_id)
);