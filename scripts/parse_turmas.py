import json
import csv

files = [
    'data/2022.1/turmas_2022-1.csv',
    'data/2022.2/turmas_2022-2.csv',
    'data/2023.1/turmas_2023-1.csv',
]

professores = {}
turmas      = {}
matricula_inc = 1
disciplina_professor = {}

for fname in files:
    with open(fname, newline='', encoding="utf8") as csvfile:
        spamreader = csv.reader(csvfile, delimiter=',', quotechar='"')
        i = 0
        for line in spamreader:
            if i == 0:
                i = i + 1
                continue
            i = i + 1
            vars = line
            #try:
                # 0 turma, 1 periodo, 2 professor, 3 horario, 4 vagas_ocupadas, 5 total_vagas, 6 local, 7 cod_disciplina, 8 cod_depto
            turma           = vars[0]
            periodo         = vars[1]
            nome_professor  = vars[2].split('(')[0].strip()
            horario         = vars[3].split('(')[0].strip()
            local           = vars[6]
            cod_disciplina  = vars[7]
            cod_depto       = vars[8]

            if (nome_professor in professores):
                professor = professores[nome_professor]
            else:
                professor = {"nome": nome_professor, "cod_depto": cod_depto, "matricula": str(matricula_inc)}
                professores[nome_professor] = professor
                matricula_inc += 1

            chave_disciplina_professor = cod_disciplina + "." + professor["matricula"]

            disciplina_professor[chave_disciplina_professor] = {
                "cod_disciplina": cod_disciplina,
                "cod_professor": professor["matricula"],
            }

            chave_turma     = cod_disciplina + "." + periodo + "." + turma

            turmas[chave_turma] = {
                "turma": turma, 
                "periodo": periodo, 
                "cod_professor": professor["matricula"],
                "cod_disciplina": cod_disciplina,
                "horario": horario,
                "local": local,
            }
                
            #except Exception as err:
                #print("erro em ")
               # print(line)
                #print(err)
                #break

print("START TRANSACTION;")
print("TRUNCATE TABLE turmas;")
print("DELETE FROM professores;")
print("DELETE FROM disciplina_professor;")

for cod in professores:
    professor = professores[cod]
    print("INSERT INTO professores(matricula, nome, cod_depto) values('" + professor["matricula"] + "','" + professor["nome"] + "'," + professor["cod_depto"] + ");")

for cod in turmas:
    turma = turmas[cod]
    print("INSERT INTO turmas(periodo,cod_professor,cod_disciplina,turma,horario,`local`) values(", end="")
    print("'" + str(turma["periodo"]) + "',", end="")
    print("" + str(turma["cod_professor"]) + ",", end="")
    print("'" + str(turma["cod_disciplina"]) + "',", end="")
    print("'" + str(turma["turma"]) + "',", end="")
    print("'" + str(turma["horario"]) + "',", end="")
    print("'" + str(turma["local"]) + "'", end="")
    print(");")

for cod in disciplina_professor:
    obj = disciplina_professor[cod]
    print("INSERT INTO disciplina_professor(cod_professor,cod_disciplina) values(", end="")
    print("" + str(obj["cod_professor"]) + ",", end="")
    print("'" + str(obj["cod_disciplina"]) + "'", end="")
    print(");")

print("COMMIT;")