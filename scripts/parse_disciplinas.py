import json
import csv

files = [
    'data/2022.1/disciplinas_2022-1.csv',
    'data/2022.2/disciplinas_2022-2.csv',
    'data/2023.1/disciplinas_2023-1.csv',
]

disciplinas = {}

for fname in files:
    with open(fname, newline='') as csvfile:
        spamreader = csv.reader(csvfile, delimiter=',', quotechar='"')
        i = 0
        for line in spamreader:
            if i == 0:
                i = i + 1
                continue
            i = i + 1
            vars = line
            try:
                cod  = vars[0]
                nome = vars[1]
                cod_depto = vars[2]
                disciplinas[cod] = {"cod": cod, "nome": nome, "cod_depto": cod_depto}
            except:
                continue

for cod in disciplinas:
    disciplina = disciplinas[cod]
    print("INSERT INTO disciplinas(cod, nome, cod_depto) values('" + disciplina["cod"] + "','" + disciplina["nome"] + "'," + disciplina["cod_depto"] + ");")