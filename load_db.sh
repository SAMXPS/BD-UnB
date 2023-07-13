docker exec -i db mysql --default-character-set=utf8 -uroot -proot@pass db_unb < dados/bd_unb_drop_tables.sql
docker exec -i db mysql --default-character-set=utf8 -uroot -proot@pass db_unb < dados/bd_unb_schema.sql
docker exec -i db mysql --default-character-set=utf8 -uroot -proot@pass db_unb < dados/bd_unb_data.sql