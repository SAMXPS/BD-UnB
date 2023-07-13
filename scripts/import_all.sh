docker exec -i db mysql --default-character-set=utf8 -uroot -proot@pass db_unb < deptos.sql
docker exec -i db mysql --default-character-set=utf8 -uroot -proot@pass db_unb < disciplinas.sql
docker exec -i db mysql --default-character-set=utf8 -uroot -proot@pass db_unb < turmas.sql
