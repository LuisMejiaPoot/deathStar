# Lumen PHP Framework



## Encender api en el puerto 6000

$ php -S localhost:6000 -t public

## Endpoints


### Obtener listado de Jedis (GET)
######  http://localhost:6000/api/v1/Jedis/  



### Crear Jedi (POST)
######  http://localhost:6000/api/v1/Jedis/  
```json
{
    "nombre":"Maria",
    "color_sable":"morado",
    "aprendiz":false,
    "estilo_batalla":6
}
```
### Actualizar Jedi (PUT)
######  http://localhost:6000/api/v1/Jedis/  
```json
{
    "id":1
    "nombre":"Maria",
    "color_sable":"morado",
    "aprendiz":false,
    "estilo_batalla":6
}
```

### Actualizar Jedi (DELETE)
######  http://localhost:6000/api/v1/Jedis/  
```json
{
    "id":1
}
```


### Calcular numero de monedas (POST)
######  http://localhost:6000/api/v1/monedas/  

```json
{
    "monto":136
}
```
