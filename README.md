# tinyquestions - Backend con Laravel
____

1 - Probar en local
=
***
Para probar en local solo es necesario:

* 1 - Clonar este repositorio:

> git clone https://github.com/Patcire/tinyquestions-backend.git

* 2 - En la terminal del proyecto:

> docker-compose up

* 3 - Verificar que los contenedores se han ejecutado correctamente
y ya estaría listo para probar los endpoints.

2- Endpoints de la API
=
***

![IMPORTANT]
> Todas las rutas deben comenzar con: http://localhost:8000/

| Endpoint                               | Método | Descripción                                             |
|----------------------------------------|--------|---------------------------------------------------------|
| /api/ques/all                          | GET    | Obtiene todas las preguntas                             |
| /api/ques/rand/{number}                | GET    | Obtiene un número especificado de preguntas al azar     |
| /api/ques/{id}                         | GET    | Obtiene una pregunta por su ID                          |
| /api/ques/create                       | POST   | Crea una nueva pregunta                                 |
| /api/ques/upd/{id}                     | PATCH  | Actualiza una pregunta por su ID                         |
| /api/ques/del/{id}                     | DELETE | Elimina una pregunta por su ID                          |
| /api/user/all                          | GET    | Obtiene todos los usuarios                              |
| /api/user/{username}                   | GET    | Obtiene un usuario por su nombre de usuario             |
| /api/user/create                       | POST   | Crea un nuevo usuario                                   |
| /api/user/del/{username}               | DELETE | Elimina un usuario por su nombre de usuario             |
| /api/user/upd/{username}               | PATCH  | Actualiza un usuario por su nombre de usuario           |
| /api/user/stats/{username}             | PATCH  | Actualiza las estadísticas de un usuario por su nombre  |
| /api/user/login                        | POST   | Inicia sesión de un usuario                             |
| /api/cust/all                          | GET    | Obtiene todos los cuestionarios personalizados          |
| /api/cust/all/{id_user}                | GET    | Obtiene todos los cuestionarios personalizados por usuario |
| /api/cust/{id}                         | GET    | Obtiene un cuestionario personalizado por su ID         |
| /api/cust/create                       | POST   | Crea un nuevo cuestionario personalizado                |
| /api/cust/del/{id}                     | DELETE | Elimina un cuestionario personalizado por su ID         |
| /api/cust/upd/{id}                     | PATCH  | Actualiza un cuestionario personalizado por su ID       |
| /api/li/by/{fk_id_quiz}                | GET    | Obtiene los usuarios que dieron "me gusta" a un cuestionario |
| /api/li/likes/{fk_id_user}/            | GET    | Obtiene los cuestionarios a los que un usuario dio "me gusta" |
| /api/li/give                           | POST   | Da "me gusta" a un cuestionario                         |
| /api/li/dis/{fk_id_user}/{fk_id_quiz}  | DELETE | Quita el "me gusta" de un usuario a un cuestionario     |
| /api/usque/{id_quiz}                   | GET    | Obtiene todas las preguntas personalizadas de un cuestionario |
| /api/usque/create                      | POST   | Crea una nueva pregunta personalizada                   |
| /api/usque/upd/{id}                    | PATCH  | Actualiza una pregunta personalizada por su ID          |
| /api/usque/del/{id}                    | DELETE | Elimina una pregunta personalizada por su ID            |


3 - Diagrama entidad relación - Paso a tablas -Normalización 
=
---

![diagram for my database](/00-images-readme/diagrama-actual.png)
![diagram for my database](/00-images-readme/actual-norm.JPG)



