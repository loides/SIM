/*
drop database sim_webapp;
drop table if exists Person;
*/

/*create database sim_webapp; */

use 4407114_webapp;

CREATE TABLE pet (
    id integer AUTO_INCREMENT primary key,
    name    varchar(128),
    type varchar(128),
    weight    varchar(64),
    bornDate varchar(32),  
    location   varchar(64)
);

/* index over name to accellerate select with field name */
create index pet_name on pet(name);  
/* index over location to accellerate select with field name */
create index pet_location on pet(location); 
