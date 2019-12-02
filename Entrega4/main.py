from flask import Flask, render_template, request, abort, json
from pymongo import MongoClient
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

@app.route("/messages/project-search")
def get_project_messages():
    '''
    Implement code to return all the messages sended and received
    by the partners of the same project.
    Example:  "/messages/project-search?name_project=xxxxx".
    '''

@app.route("/messages/content-search")
def get_content_messages():
    '''
    Implement code to return all the messages with the wanted words or wanted
    sentences or prohibited word in the content.
    '''

@app.route("/messages", methods=['POST'])
def create_message():
    '''
    Implement code to create a new message in the db
    '''

@app.route("/messages/<int:mid>", methods=['DELETE'])
def delete_messages(mid):
    messages.delete_one({"mid":mid})
    message = f'Mensaje con id={mid} ha sido eliminado'
    return json.jsonify({'result': 'succes', 'message': message})

if __name__ == "__main__":
    app.run()
