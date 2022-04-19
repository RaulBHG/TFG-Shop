<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="<?= template_url() ?>vendor/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->
    <script src="<?= template_url() ?>vendor/vue.js"></script>  
    <script src="<?= template_url() ?>vendor/jquery/jquery.min.js"></script>  
</head>
<style>
    h1{
        text-align:center;
        margin-bottom: 1em;
    }
    textarea, input{
        margin-bottom: 2em;
    }
    .table img{
        height: 4rem;
    }
</style>
<body>
    <h1>Edit Products</h1>
    <div id="appProductos" class="container">
        <!-- Formulario para añadir productos -->
        <section class="form">
            <form action="" class="text-center">
                <input v-model="name" @keyup.enter="crearProducto" type="text" class="form-control" placeholder="Nombre">

                <textarea v-model="description" class="form-control" placeholder="Descripcion"></textArea>

                <label>Imagenes de muestra (la primera será la portada)</label>
                <!-- <input v-model="imagenes" type="file" v-on:change="changeFiles" class="form-control-file" name="imagenes[]" title="Imagenes de muestra (la primera será la portada)"
                placeholder="Images" ref="fileInput" multiple> -->
                <input type="file" @change="changeFiles" class="form-control-file" ref="imagenes" multiple>

                <input v-model="price" @keyup.enter="crearProducto" type="number" class="form-control" placeholder="Precio">

                <!-- Botón para añadir -->
                <input @click="crearProducto" type="button" value="Añadir" class="btn btn-success">
            </form>
        </section>
        <!-- Tabla donde se muestran los datos -->
        <section class="data">
            <caption>Productos</caption>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Imagen principal</th>
                        <th scope="col">Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(producto, index) in productos">
                        <td>{{ producto.id }}</td>
                        <td>
                            <span v-if="formActualizar && idActualizar == index">
                                <!-- Formulario para actualizar -->
                                <input v-model="nameActualizar" type="text" class="form-control">
                            </span>
                            <span v-else>
                                <!-- Dato name -->
                                {{ producto.name }}
                            </span>
                        </td>
                        <td>
                            <span v-if="formActualizar && idActualizar == index">
                                <!-- Formulario para actualizar -->
                                <textarea v-model="descriptionActualizar" class="form-control" placeholder="Descripcion"></textArea>
                            </span>
                            <span v-else>
                                <!-- Dato description -->
                                {{ producto.description }}
                            </span>
                        </td>
                        <td>
                            <span v-if="formActualizar && idActualizar == index">
                                <!-- Formulario para actualizar -->
                                <!-- <input v-model="imagenActualizar" type="file" class="form-control-file" name="imagenes[]" title="Imagenes de muestra (la primera será la portada)"
                                placeholder="Images" multiple> -->
                                <input type="file" @change="changeFiles" ref="imagenActualizar" class="form-control-file" name="imagenes[]" title="Imagenes de muestra (la primera será la portada)" placeholder="Images" multiple>
                            </span>
                            <span v-else>
                                <!-- Dato description -->
                                <img v-bind:src="'<?= template_url() ?>img/img_products/' + producto.mainImg" alt="IMG PRODUCTO">                                
                            </span>
                        </td>
                        <td>
                            <span v-if="formActualizar && idActualizar == index">
                                <!-- Formulario para actualizar -->
                                <input v-model="priceActualizar" type="text" class="form-control">
                            </span>
                            <span v-else>
                                <!-- Dato price -->
                                {{ producto.price }}
                            </span>
                        </td>
                        <td>
                            <!-- Botón para guardar la información actualizada -->
                            <span v-if="formActualizar && idActualizar == index">
                                <button @click="guardarActualizacion(index)" class="btn btn-success">Guardar</button>
                            </span>
                            <span v-else>
                                <!-- Botón para mostrar el formulario de actualizar -->
                                <button @click="verFormActualizar(index)" class="btn btn-warning">Actualizar</button>
                                <!-- Botón para borrar -->
                                <button @click="borrarProducto(index)" class="btn btn-danger">Borrar</button>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>

    <script>
        $(document).ready(function(){
            
            new Vue({
                el: '#appProductos',
                data: {
                    // Input nombre
                    name: '',
                    // Input description
                    description: '',
                    // Input description
                    mainImg: '',
                    // Input description
                    imagenes: '',
                    // Input price
                    price: '',
                    // Ver o no ver el formulario de actualizar
                    formActualizar: false,
                    // La posición de tu lista donde te gustaría actualizar 
                    idActualizar: -1,
                    // Input nombre dentro del formulario de actualizar
                    nameActualizar: '',
                    // Input description dentro del formulario de actualizar
                    descriptionActualizar: '',
                    // Input description dentro del formulario de actualizar
                    imagenActualizar: '',
                    // Input price dentro del formulario de actualizar
                    priceActualizar: '',
                    // Lista de productos
                    productos: [] 
                },
                methods: {
                    crearProducto: function () {
                        // Anyadimos a nuestra lista
                        this.productos.push({
                            id: + new Date(),
                            name:           this.name,
                            description:    this.description,
                            mainImg:     "test.jpg",
                            price:          this.price
                        });
                        // Vaciamos el formulario de añadir
                        this.name = '';
                        this.description = '';
                        this.imagenes = '';
                        this.price = '';
                    },
                    verFormActualizar: function (producto_id) {
                        // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                        this.idActualizar = producto_id;
                        this.nameActualizar = this.productos[producto_id].name;
                        this.descriptionActualizar = this.productos[producto_id].description;
                        this.priceActualizar = this.productos[producto_id].price;
                        // Mostramos el formulario
                        this.formActualizar = true;
                    },
                    borrarProducto: function (producto_id) {
                        // Borramos de la lista
                        this.productos.splice(producto_id, 1);
                    },
                    guardarActualizacion: function (producto_id) {
                        // Ocultamos nuestro formulario de actualizar
                        this.formActualizar = false;
                        // Actualizamos los datos
                        this.productos[producto_id].name = this.nameActualizar;
                        this.productos[producto_id].description = this.descriptionActualizar;
                        this.productos[producto_id].price = this.priceActualizar;
                    },
                    changeFiles:  function(){
                    //obtenemos los archivos
                    // se pueden asignar a un array u objeto
                        console.log(this.$refs.imagenes.files);
                        
                    },
                    changeFilesActualizar:  function(){
                    //obtenemos los archivos
                    // se pueden asignar a un array u objeto
                        console.log(this.$refs.imagenActualizar.files);
                        
                    }
                }
            });
        });

    </script>
</body>
</html>