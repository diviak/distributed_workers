###About

I was trying to keep it simple as possible and used just simple PDO for it instead of e.g. doctrine. I hope that installation process will work for you.

I did use `SKIP LOCKED` feature introduced in MySQL v8.0.1

###Installation 

**Docker**

run `docker-compose up`

**Application**

run `docker exec -it php bash`
run `composer install`

**Database**

visit `http://localhost:3307/`

import `app/migrations/database.sql`

**Data seeding**
  
run `console/application db:seed`

**Worker**

run `console/application worker:run`