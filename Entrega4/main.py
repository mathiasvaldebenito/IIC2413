from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient, TEXT
import pandas as pd
import matplotlib.pyplot as plt
import os

MESSAGES_KEYS = ['content', 'metadata']

URL = "mongodb://grupo41:grupo41@gray.ing.puc.cl/grupo41"
client = MongoClient(URL)
db = client.get_database()
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

@app.route("/messages/project-search")
def get_project_messages():
    proyect_name = request.args.get('name', False)
    messages.drop_indexes()
    messages.create_index([('metadata.sender', TEXT), ('metadata.receiver', TEXT)],
     name='text', default_language='spanish')
    search = list(messages.find({"$text" : {"$search": proyect_name}},{"_id":0}))
    return json.jsonify(search)

@app.route("/messages/content-search")
def get_content_messages():
    '''
    Implement code to return all the messages with the wanted words or wanted
    sentences or prohibited word in the content.
    '''

@app.route("/messages", methods=['POST'])
def create_message():
    try:
        data = {key: request.json[key] for key in MESSAGES_KEYS}
        count = messages.count_documents({})
        data["mid"] = count + 1
        result = messages.insert_one(data)
        if (result):
            message = f"Mensaje creado con mid:{count + 1}"
            success = True
        else:
            message = "No se pudo crear el mensaje"
            success = False
        return json.jsonify({"success":success, "message": message})
    except Exception as err:
        message = str(err)
        return json.jsonify({"success":False, "Error": message})

@app.route("/messages/<int:mid>", methods=['DELETE'])
def delete_messages(mid):
    messages.delete_one({"mid":mid})
    message = f'Mensaje con mid={mid} ha sido eliminado'
    return json.jsonify({'result': 'succes', 'message': message})

if __name__ == "__main__":
    app.run()
