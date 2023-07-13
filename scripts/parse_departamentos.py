import json

files = [
    'data/2022.1/departamentos_2022-1.csv',
    'data/2022.2/departamentos_2022-2.csv',
    'data/2023.1/departamentos_2023-1.csv',
]

deptos = {}

for fname in files:
    f = open(fname, 'rt')
    i = 0
    for line in f:
        if i == 0:
            i = i + 1
            continue
        i = i + 1

        vars = line.replace('\n','').replace('"','').split(',', 1)
        try:
            cod  = int(vars[0])
            nome = vars[1]
            deptos[cod] = nome
        except:
            continue

for cod in deptos:
    nome = deptos[cod]
    print("INSERT INTO departamentos(cod, nome) values('" + str(cod) + "','" + nome + "');")