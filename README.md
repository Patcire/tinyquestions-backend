# tinyquestions - Backend con Laravel
____

---
Para ver la documentación completa de la app visita:
**https://internal-buckaroo-a26.notion.site/tinyquestions-8518a1c3128342eeb06610fc12508847?pvs=4**
---

1 - Despliegue en local
=
***
`*Requisitos previos:*` 

`*Tener Git y Docker instalados en tu sistema*`.

1. Clona el repositorio original:

```markdown
git clone https://github.com/Patcire/tinyquestions-backend.git
```

1. En la terminal del proyecto raíz usa el comando:

```markdown
docker-compose up
```

2. Espera hasta que todos los contenedores se hayan creado y hayan finalizado las instalaciones de los comandos post-levantamiento. 
    
    **`Importante: Esto puede tomar varios minutos.`**

3. Si quieres desplegar también el front-end visita el siguiente repo:
   https://github.com/Patcire/tinyquestions-frontend

2- Endpoints de la API
=
***

![IMPORTANT]
> Todas las rutas deben comenzar con: http://localhost:8001/ para probar en local

| Endpoint                   | Método | Descripción                                    |
|----------------------------|--------|------------------------------------------------|
| /api/user/all              | GET    | Obtiene todos los usuarios                     |
| /api/user/count            | GET    | Cuenta el número de usuarios                   |
| /api/user/allpag           | GET    | Obtiene todos los usuarios paginados           |
| /api/user/stats/{order}    | GET    | Obtiene estadísticas de usuarios paginadas     |
| /api/user/{username}       | GET    | Obtiene un usuario por su nombre de usuario    |
| /api/user/create           | POST   | Crea un nuevo usuario                          |
| /api/user/del/{username}   | DELETE | Elimina un usuario por su nombre de usuario    |
| /api/user/upd/{username}   | PATCH  | Actualiza un usuario por su nombre de usuario  |
| /api/user/stats/{username} | PATCH  | Actualiza estadísticas de un usuario           |
| /api/user/login            | POST   | Inicia sesión de un usuario                    |
| /api/user/allmat/{id}/{type?} | GET | Obtiene todos los partidos de un usuario       |
| /api/match/all             | GET    | Obtiene todos los partidos                     |
| /api/match/allpag          | GET    | Obtiene todos los partidos paginados           |
| /api/match/bytype/{type}   | GET    | Obtiene partidos por tipo                      |
| /api/match/relinfo/{id}    | GET    | Obtiene información relacionada con un partido |
| /api/match/create          | POST   | Crea un nuevo partido                          |
| /api/play/{id}/{number_items} | GET | Obtiene partidos jugados por un usuario        |
| /api/play/create           | POST   | Crea un nuevo registro de partido jugado       |
| /api/quiz/all              | GET    | Obtiene todos los cuestionarios                |
| /api/quiz/{id}             | GET    | Obtiene un cuestionario por su ID              |
| /api/quiz/create           | POST   | Crea un nuevo cuestionario                     |
| /api/cust/all              | GET    | Obtiene todos los cuestionarios personalizados |
| /api/cust/all/{id_user}    | GET    | Obtiene cuestionarios personalizados por usuario|
| /api/cust/{id}             | GET    | Obtiene un cuestionario personalizado por ID   |
| /api/cust/create           | POST   | Crea un cuestionario personalizado             |
| /api/cust/del/{id}         | DELETE | Elimina un cuestionario personalizado por ID   |
| /api/cust/upd/{id}         | PATCH  | Actualiza un cuestionario personalizado por ID |
| /api/rand/{id}             | GET    | Obtiene un cuestionario aleatorio por ID       |
| /api/rand/create           | POST   | Crea un cuestionario aleatorio                 |
| /api/ques/allFrom/{id}     | GET    | Obtiene todas las preguntas de un cuestionario personalizado |
| /api/ques/all/{type}       | GET    | Obtiene todas las preguntas por tipo           |
| /api/ques/rand/{number}    | GET    | Obtiene un número específico de preguntas al azar |
| /api/ques/{id}             | GET    | Obtiene una pregunta por su ID                 |
| /api/ques/create           | POST   | Crea una nueva pregunta                        |
| /api/ques/upd/{id}         | PATCH  | Actualiza una pregunta por su ID               |
| /api/ques/del/{id}         | DELETE | Elimina una pregunta por su ID                 |
| /api/li/by/{fk_id_quiz}    | GET    | Obtiene a quién le gustó un cuestionario       |
| /api/li/likes/{fk_id_user} | GET    | Obtiene los "me gusta" de un usuario           |
| /api/li/give               | POST   | Da un "me gusta"                               |
| /api/li/dis/{fk_id_user}/{fk_id_quiz} | DELETE | Elimina un "me gusta"                |
| /api/has/all               | GET    | Obtiene todos los cuestionarios aleatorios con preguntas aleatorias |
| /api/has/{id_quiz}         | GET    | Obtiene las preguntas de un cuestionario aleatorio |
| /api/has/create            | POST   | Crea una relación de cuestionario aleatorio con preguntas aleatorias |



3 - Diagrama entidad relación 
=
---

![diagram for my database]([/00-images-readme/diagrama-actual.png](https://internal-buckaroo-a26.notion.site/image/https%3A%2F%2Fprod-files-secure.s3.us-west-2.amazonaws.com%2F93ad78ff-5f34-4de9-a9e6-55c3ebc2407f%2Fa983da5f-e76c-4bf7-a26e-53a34ae9113e%2FUntitled.png?table=block&id=ccdfc173-a369-4a39-ba45-b92c53d50b8f&spaceId=93ad78ff-5f34-4de9-a9e6-55c3ebc2407f&width=2000&userId=&cache=v2))





