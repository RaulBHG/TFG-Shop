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
    <h1>Edit Contacts</h1>
    <div id="appPedidos" class="container">
        <!-- Formulario para añadir pedidos -->
        <section class="form">
            <form id="formContact" action="" class="text-center">
                
                <input v-model="sender" name="sender" @keyup.enter="crearContacto" type="text" class="form-control" placeholder="Email">                

                <input v-model="phone" @keyup.enter="crearContacto" name="phone" type="tel" class="form-control" placeholder="Telefono">

                <textarea v-model="message" @keyup.enter="crearContacto" name="message" type="number" class="form-control" placeholder="Texto"></textArea>

                <input v-model="id_buy" @keyup.enter="crearContacto" name="id_buy" type="text" class="form-control" placeholder="ID_COMPRA">

                <!-- Botón para añadir -->
                <input @click="crearContacto" type="button" value="Añadir" class="btn btn-success">
            </form>
        </section>
        <!-- Tabla donde se muestran los datos -->
        <section class="data">
            <form id="formEdit">
                <caption>Pedidos</caption>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col" colspan="3">Texto</th>
                            <th scope="col">ID_COMPRA</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr v-for="(pedido, index) in pedidos">
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <input v-model="senderActualizar" name="sender" type="text" class="form-control">
                                </span>
                                <span v-else>
                                    <!-- Dato sender -->
                                    {{ pedido.sender }}
                                </span>
                            </td>
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <input v-model="phoneActualizar" name="phone" type="tel" class="form-control" placeholder="Telefono">
                                </span>
                                <span v-else>
                                    <!-- Dato phone -->
                                    {{ pedido.phone }}
                                </span>
                            </td>
                            <td colspan="3">
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <textarea v-model="messageActualizar" name="message" class="form-control" placeholder="Texto"></textArea>
                                </span>
                                <span v-else>
                                    <!-- Dato phone -->
                                    {{ pedido.message }}
                                </span>
                            </td>
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <textarea v-model="id_buyActualizar" name="id_buy" class="form-control" placeholder="Texto"></textArea>
                                </span>
                                <span v-else>
                                    <!-- Dato phone -->
                                    {{ pedido.id_buy }}
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
                                    <button @click="borrarContacto(index)" type="button" class="btn btn-danger">Borrar</button>
                                </span>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
            </form> 
        </section>
    </div>

    <script>let baseUrl = "<?= base_url();?>"; </script>
    <script>
        $(document).ready(function(){
            new Vue({
                el: '#appPedidos',
                data: {
                    // Input locate_id
                    locate_id: '',
                    // Input estado
                    estado: '',
                    // Input name
                    name: '',
                    // Input address
                    address: '',
                    // Input phone
                    phone: '',
                    // Input price
                    price: '',
                    // Input products
                    products: [],
                    // Input cant
                    cant: '',
                    // Input email
                    email: '',
                    // Ver o no ver el formulario de actualizar
                    formActualizar: false,
                    // La posición de tu lista donde te gustaría actualizar 
                    idActualizar: -1,
                    // Input nombre dentro del formulario de actualizar
                    estadoActualizar: '',                    
                    // Lista de pedidos
                    pedidos: [] 
                },
                methods: {
                    // ------ CREAR ORDER ------
                    crearContacto: function () {
                        let thisCon = this;
                        $.ajax({
                            type: "POST",
                            url: baseUrl + "/adminPage/insertElement/order",
                            // data: $("#formContact").serialize() + "&main_img=01", // serializes the form's elements.
                            data: $("#formContact").serialize(), // serializes the form's elements.
                            success: function (respuesta) {                            
                                respuesta = JSON.parse(respuesta);
                                // Anyadimos a nuestra lista
                                thisCon.pedidos.push({
                                    id: + respuesta.data.contId,
                                    sender:         thisCon.sender,
                                    phone:          thisCon.phone,
                                    message:        thisCon.message,
                                    id_buy:        thisCon.id_buy
                                });
                                // Vaciamos el formulario de añadir
                                thisCon.sender = '';
                                thisCon.phone = '';
                                thisCon.message = '';
                                thisCon.id_buy = '';
                            }
                        });
                        
                    },

                    // ------ VER ACTUALIZAR ------
                    verFormActualizar: function (pedido_id) {
                        // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                        this.idActualizar = pedido_id;
                        this.senderActualizar = this.pedidos[pedido_id].sender;
                        this.phoneActualizar = this.pedidos[pedido_id].phone;
                        this.messageActualizar = this.pedidos[pedido_id].message;
                        this.id_buyActualizar = this.pedidos[pedido_id].id_buy;
                        // Mostramos el formulario
                        this.formActualizar = true;
                    },

                    // ------ BORRAR ORDER ------
                    borrarContacto: function (pedido_id) {
                        // Borramos de la lista
                        let thisCon = this;
                        $.ajax({
                            type: "POST",
                            url: baseUrl + "/adminPage/removeElement/order/"+thisCon.pedidos[pedido_id].id,
                            success: function (respuesta) {
                                thisCon.pedidos.splice(pedido_id, 1);
                            }
                        });                        
                    },

                    // ------ ACTUALIZAR ORDER ------
                    guardarActualizacion: function (pedido_id) {
                        // Ocultamos nuestro formulario de actualizar
                        let thisCon = this;
                        $.ajax({
                            type: "POST",
                            url: baseUrl + "/adminPage/updateElement/order/"+thisCon.pedidos[pedido_id].id,
                            // data: $("#formEdit").serialize() + "&main_img=01", // serializes the form's elements.
                            data: $("#formEdit").serialize(), // serializes the form's elements.
                            success: function (respuesta) {
                                // Actualizamos los datos
                                thisCon.formActualizar = false;
                                thisCon.pedidos[pedido_id].sender = thisCon.senderActualizar;
                                thisCon.pedidos[pedido_id].phone = thisCon.phoneActualizar;
                                thisCon.pedidos[pedido_id].message = thisCon.messageActualizar;
                                thisCon.pedidos[pedido_id].id_buy = thisCon.id_buyActualizar;
                            }
                        });  
                        
                    },

                },
                beforeMount(){
                    let thisCon = this;
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "/adminPage/getElements/order",
                        success: function (respuesta) {                                                       
                            
                            respuesta = JSON.parse(respuesta);
                            console.log(respuesta);
                            respuesta.forEach(element => {
                                thisCon.pedidos.push({
                                    id:           element.id,
                                    sender:           element.sender,
                                    phone:    element.phone,
                                    message:          element.message,
                                    id_buy:          element.id_buy
                                });
                            });

                        }
                    });
                }                
            });

            
        });

    </script>
</body>
</html>