CREATE DATABASE doings_done;
USE doings_done;

/* Проект */
CREATE TABLE project (
id INT NOT NULL AUTO_INCREMENT,
project_name CHAR(30),
PRIMARY KEY (id)
)

/* Пользователь */
CREATE TABLE users (
id INT NOT NULL AUTO_INCREMENT,
date_registration DATE,
email CHAR(30),
name CHAR(30),
password CHAR(32),
contacts TEXT,
project_id INT NOT NULL,
FOREIGN KEY (project_id) REFERENCES project(id),
FOREIGN KEY (task_id) REFERENCES task(id),
PRIMARY KEY (id)
)

/* Задача */
CREATE TABLE task (
id INT NOT NULL AUTO_INCREMENT,
date_creation DATE,
date_complete DATE,
task_name CHAR(30),
task_file CHAR(80),
task_expire DATE,
project_id INT NOT NULL,
user_id INT NOT NULL,
FOREIGN KEY (project_id) REFERENCES project(id),
FOREIGN KEY (user_id) REFERENCES users(id),
PRIMARY KEY (id)
)


CREATE INDEX date_completet_in ON task(date_complete)
CREATE INDEX task_expire_in ON task(task_expire)
CREATE UNIQUE INDEX project_in ON project(project_name)
CREATE UNIQUE INDEX email_in ON users(email)
