<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="<?= template_url() ?>css/appearAnimation.css">
    <link rel="stylesheet" href="<?= template_url() ?>vendor/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->     
    <link rel="stylesheet" href="<?= template_url() ?>vendor/trumbowyg/dist/ui/trumbowyg.min.css">

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

    <h1>Edit Artículos</h1>    
    <div id="appBlog" class="container">    
        <!-- Formulario para añadir articulos -->       
        <section class="form">
        
            <form id="formBlog" action="" class="text-center">
                
                <input v-model="title" name="title" @keyup.enter="crearArticulo" type="text" class="form-control" placeholder="Título">                

                <textarea v-model="description" name="description" class="form-control trumbowyg" placeholder="Descripcion"></textArea>

                <label>Imágenes del artículo. La primera estará encima, la segunda a la derecha y la última abajo.</label>

                <input type="file" @change="changeFiles" name="img1" class="form-control-file" ref="imagenes">
                
                <input type="file" @change="changeFiles" name="img2" class="form-control-file" ref="imagenes">

                <input type="file" @change="changeFiles" name="img3" class="form-control-file" ref="imagenes">

                <!-- Botón para añadir -->
                <input @click="crearArticulo" type="button" value="Añadir" class="btn btn-success">
            </form>
        </section>
        <!-- Tabla donde se muestran los datos -->
        <section class="data">
            <form id="formEdit">
                <caption>Artículos</caption>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Imagen 1</th>
                            <th scope="col">Imagen 2</th>
                            <th scope="col">Imagen 3</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr v-for="(articulo, index) in articulos">
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <input v-model="titleActualizar" name="title" type="text" class="form-control">
                                </span>
                                <span v-else>
                                    <!-- Dato name -->
                                    {{ articulo.title }}
                                </span>
                            </td>
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <textarea v-model="descriptionActualizar" name="description" class="form-control trumbowyg" placeholder="Descripcion"></textArea>
                                </span>
                                <span v-else>
                                    <!-- Dato description -->
                                    {{ articulo.description }}
                                </span>
                            </td>
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <!-- <input v-model="imagenActualizar" type="file" class="form-control-file" name="imagenes[]" title="Imagenes de muestra (la primera será la portada)"
                                    placeholder="Images" multiple> -->
                                    <input type="file" @change="changeFiles" name="img1" ref="imagenActualizar" class="form-control-file" title="Imagenes de muestra (la primera será la portada)" placeholder="Images">
                                </span>
                                <span v-else>
                                    <!-- Dato description -->
                                    <img v-bind:src="'<?= template_url() ?>img/img_blog/' + articulo.img1" alt="NO SELECCIONADA">                                
                                </span>
                            </td>
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <!-- <input v-model="imagenActualizar" type="file" class="form-control-file" name="imagenes[]" title="Imagenes de muestra (la primera será la portada)"
                                    placeholder="Images" multiple> -->
                                    <input type="file" @change="changeFiles" name="img2" ref="imagenActualizar" class="form-control-file" title="Imagenes de muestra (la primera será la portada)" placeholder="Images">
                                </span>
                                <span v-else>
                                    <!-- Dato description -->
                                    <img v-bind:src="'<?= template_url() ?>img/img_blog/' + articulo.img2" alt="NO SELECCIONADA">                                
                                </span>
                            </td>                            
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <!-- <input v-model="imagenActualizar" type="file" class="form-control-file" name="imagenes[]" title="Imagenes de muestra (la primera será la portada)"
                                    placeholder="Images" multiple> -->
                                    <input type="file" @change="changeFiles" name="img3" ref="imagenActualizar" class="form-control-file" title="Imagenes de muestra (la primera será la portada)" placeholder="Images">
                                </span>
                                <span v-else>
                                    <!-- Dato description -->
                                    <img v-bind:src="'<?= template_url() ?>img/img_blog/' + articulo.img3" alt="NO SELECCIONADA">                                
                                </span>
                            </td>
                            <td>
                                <!-- Botón para guardar la información actualizada -->
                                <span v-if="formActualizar && idActualizar == index">
                                    <button @click="guardarActualizacion(index)" type="button" class="btn btn-success">Guardar</button>
                                </span>
                                <span v-else>
                                    <!-- Botón para mostrar el formulario de actualizar -->
                                    <button @click="verFormActualizar(index)" type="button" class="btn btn-warning">Actualizar</button>
                                    <!-- Botón para borrar -->
                                    <button @click="borrarProducto(index)" type="button" class="btn btn-danger">Borrar</button>
                                </span>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
            </form> 
        </section>
    </div>

    <script>let baseUrl = "<?= base_url();?>"; </script>
    
    <script src="<?= template_url() ?>vendor/vue.js"></script>      
    <script src="<?= template_url() ?>vendor/jquery/jquery.min.js"></script>  
    <script src="<?= template_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= template_url() ?>vendor/trumbowyg/dist/trumbowyg.min.js"></script>

</body>
<script>
    $(document).ready(function(){
        new Vue({
            el: '#appBlog',
            data: {
                // Input titulo
                title: '',
                // Input description
                description: '',
                // Input img1
                img1: '',
                // Input img2
                img2: '',
                // Input img3
                img3: '',
                // Ver o no ver el formulario de actualizar
                formActualizar: false,
                // La posición de tu lista donde te gustaría actualizar 
                idActualizar: -1,
                // Input titulo dentro del formulario de actualizar
                titleActualizar: '',
                // Input description dentro del formulario de actualizar
                descriptionActualizar: '',
                // Input img1 dentro del formulario de actualizar
                img1Actualizar: '',
                // Input img2 dentro del formulario de actualizar
                img2Actualizar: '',
                // Input img3 dentro del formulario de actualizar
                img3Actualizar: '',
                // Lista de articulos
                articulos: [] 
            },
            methods: {
                // ------ CREAR PRODUCTO ------
                crearArticulo: function () {
                    let thisPro = this;

                    $("#formBlog textarea[name=description]").html($("#formBlog .trumbowyg-editor").html());

                    var formData = new FormData($("#formBlog")[0]);                        
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "/adminPage/insertElement/blog",
                        data: formData, // serializes the form's elements.
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (respuesta) {                            
                            respuesta = JSON.parse(respuesta);
                            console.log(respuesta);
                            // Anyadimos a nuestra lista
                            thisPro.articulos.push({
                                id:             respuesta.data.prodId,
                                title:          thisPro.title,
                                description:    thisPro.description,
                                img1:           respuesta.data.img1Name,
                                img2:           respuesta.data.img2Name,
                                img3:           respuesta.data.img3Name
                            });
                            // Vaciamos el formulario de añadir
                            thisPro.title = '';
                            thisPro.description = '';
                            thisPro.imagenes = '';                                

                        }
                    });
                    
                },

                // ------ VER ACTUALIZAR ------
                verFormActualizar: function (articulo_id) {
                    // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                    this.idActualizar = articulo_id;
                    this.titleActualizar = this.articulos[articulo_id].title;
                    this.descriptionActualizar = this.articulos[articulo_id].description;                        
                    // Mostramos el formulario
                    this.formActualizar = true;                    
                },

                // ------ BORRAR PRODUCTO ------
                borrarProducto: function (articulo_id) {
                    // Borramos de la lista
                    let thisPro = this;
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "/adminPage/removeElement/blog/"+thisPro.articulos[articulo_id].id,
                        success: function (respuesta) {
                            thisPro.articulos.splice(articulo_id, 1);
                        }
                    });                        
                },

                // ------ ACTUALIZAR PRODUCTO ------
                guardarActualizacion: function (articulo_id) {
                    // Ocultamos nuestro formulario de actualizar
                    let thisPro = this;
                    var formData = new FormData($("#formEdit")[0]);
                    formData.append("main_img", 01);
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "/adminPage/updateElement/blog/"+thisPro.articulos[articulo_id].id,
                        // data: $("#formEdit").serialize() + "&main_img=01", // serializes the form's elements.
                        data: formData, // serializes the form's elements.
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (respuesta) {
                            // Actualizamos los datos
                            thisPro.formActualizar = false;
                            thisPro.articulos[articulo_id].title = thisPro.titleActualizar;
                            thisPro.articulos[articulo_id].description = thisPro.descriptionActualizar;
                            thisPro.articulos[articulo_id].price = thisPro.priceActualizar;
                        }
                    });  
                    
                },

                // ------ SELECT IMG ------
                changeFiles:  function(){
                //obtenemos los archivos
                // se pueden asignar a un array u objeto
                    console.log(this.$refs.imagenes.files);
                    
                },
                
                // ------ SELECT IMG ACTUALIZAR ------
                changeFilesActualizar:  function(){
                //obtenemos los archivos
                // se pueden asignar a un array u objeto
                    console.log(this.$refs.imagenActualizar.files);
                    
                }
            },
            beforeMount(){
                let thisPro = this;
                $.ajax({
                    type: "POST",
                    url: baseUrl + "/adminPage/getElements/blog",
                    success: function (respuesta) {                                                       
                        
                        respuesta = JSON.parse(respuesta);
                        console.log(respuesta);
                        respuesta.forEach(element => {
                            thisPro.articulos.push({
                                id:             element.id,
                                title:          element.title,
                                description:    element.description,
                                img1:           element.img1,                                    
                                img2:           element.img2,                                    
                                img3:           element.img3,                                    
                            });
                        });

                    }
                });
            }                
        });

        $('#appBlog .trumbowyg').trumbowyg();
    });

</script>
</html>