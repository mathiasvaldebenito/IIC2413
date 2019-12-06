# gunicorn-flask-pipenv-sample

## Para correr

### Windows con una sola version de python, Ubuntu 18.04+

```bash
pip install pipenv
```

### Otros

```bash
pip3 install pipenv
```

Abrimos nuevamente la consola

#### Crear entorno

```bash
pipenv install
```


### Entrar al entorno virtual
```bash
pipenv shell
```
Si estas en windows
```
python main.py
```

Cualquier otro sistema operativo
```
gunicorn main:app --workers=3 --reload
```
### Ejemplo para hacer post
```
{
	"content": "content_message",
	"metadata": {
		"time": "2019-12-5 17:07:00",
		"sender": "sender_name_project",
		"receiver": "receiver_name_project"
	}
}
```
### schema
```
db.createCollection("documentos", {
   validator: {
      $jsonSchema: {
         bsonType: "object",
         required: ["content", "metadata"],
         properties: {
            mid: {
              bsonType: "int",
              description: "must be an int"
            },
            content: {
               bsonType: "string",
               description: "must be a string and is required"
            },
            metadata: {
              bsonType: "object",
              required: ["time"],
              properties: {
                time: {
                  bsonType: "string",
                  description: "must be a string and is required"
                },
                sender: {
                  bsonType: "string",
                  description: "must be a string if the field exists"
                },
                receiver: {
                  bsonType: "string",
                  description: "must be a string if the field exists"
                }
              }
            }
          }
       }
    }
 })
```
