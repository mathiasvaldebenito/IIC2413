from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient, TEXT
import pandas as pd
import matplotlib.pyplot as plt
import os

'''
    Código extraído de AyudantiaAPI.
'''

MESSAGES_KEYS = ['content', 'metadata'] #not sure if this actually works

#URL = "mongodb://grupo41:grupo41@gray.ing.puc.cl/grupo41"
#client = MongoClient(URL)
#db = client.get_database()
client = MongoClient()
db = client["entidades"]
messages = db.documentos

app = Flask(__name__)

@app.route("/")
def home():
    return "<h1>HELLO API GRUPO 41-52</h1>"

@app.route("/messages")
def get_messages():
    resultados = [m for m in messages.find({},{"_id":0})]
    return json.jsonify(resultados)

@app.route("/messages/<int:mid>")
def get_message(mid):
    message = list(messages.find({"mid":mid},{"_id":0}))
    return json.jsonify(message)

#@app.route("/messages/project-search")
#def get_project_messages(proyect_name):
    #La consulta funciona! La probé en mongo por consola, pero no se si funciona
    # bien con la api
    #messages = db.documentos.createIndex({"metadata.sender":"text","metadata.receiver":"text"})
    # Por ejemplo no estoy seguor que create.Index retorne una nueva db o modifica la anterior
    #search = list(messages.find({$text : {$search: proyect_name}}))
    #return search

@app.route("/messages/content-search")
def get_content_messages():
    body = request.json
    db.documentos.drop_indexes()
    db.documentos.create_index([('content', TEXT)], name='content_index', default_language='spanish')
    query = list(map(lambda str: f"\"{str}\"", body["required"]))
    query += body["desired"]
    query += list(map(lambda str: f"-{str}", body["forbidden"]))
    query = " ".join(query)
    search = list(messages.find({"$text" : {"$search": query, "$language": "es"}}, {"_id": 0}))
    return json.jsonify(search)

@app.route("/messages", methods=['POST'])
def create_message():
    # Crea un nuevo mensaje en la base de datos. Se necesitan
    # todos los valores menos el id
    # Si los parámetros son enviados con una request de tipo
    # application/json:
    data = {key: request.json[key] for key in USER_KEYS}
    # No se que pasa con las sub kyes, como la fecha y eso
    # Se genera el uid
    count = messages.count_documents({})
    data["mid"] = count + 1
    # Insertar retorna un objeto
    result = messages.insert_one(data)
    # Creo el mensaje resultado
    if (result):
        message = f"Mensaje creado. (mid: {count + 1}"
        success = True
    else:
        message = "No se pudo crear el mensaje"
        success = False
    # Retorna el texto
    return json.jsonify({"success":success, "message": message})

@app.route("/messages/<int:mid>", methods=['DELETE'])
def delete_messages(mid):
    messages.delete_one({"mid":mid})
    message = f'Mensaje con id={mid} ha sido eliminado'
    return json.jsonify({'result': 'succes', 'message': message})

if __name__ == "__main__":
    app.run()
