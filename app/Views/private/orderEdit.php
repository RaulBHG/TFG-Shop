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
    <link rel="stylesheet" href="<?= template_url() ?>css/appearAnimation.css">
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
    .lineProduct{
        background-color: antiquewhite;        
    }
    .lineProduct:last-of-type{
        border-bottom: 2px solid black;
    }
</style>
<body>
    <h1>Edit Contacts</h1>
    <div id="appPedidos" class="container">
        <!-- Tabla donde se muestran los datos -->
        <section class="data">
            <form id="formEdit">
                <caption>Pedidos</caption>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Locate ID</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Precio</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody v-for="(pedido, index) in pedidos">               
                        <tr>
                            <td>
                                <span>
                                    <!-- Dato id locate -->
                                    {{ pedido.locate_id }}
                                </span>
                            </td>
                            <td>
                                <span v-if="formActualizar && idActualizar == index">
                                    <!-- Formulario para actualizar -->
                                    <select name="estado" class="form-control" v-model="estadoActualizar">
                                        <option value="0">Solicitado</option>
                                        <option value="1">Enviado</option>
                                        <option value="2">Completado</option>
                                        <option value="2">Cancelado</option>
                                    </select>
                                </span>
                                <span v-else>
                                    <b>
                                        <!-- Dato phone -->
                                        {{ pedido.estado }}
                                    </b>
                                </span>
                            </td>
                            <td>
                                <span>
                                    <!-- Dato nombre -->
                                    {{ pedido.email }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    <!-- Dato nombre -->
                                    {{ pedido.name }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    <!-- Dato dirección -->
                                    {{ pedido.address }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    <!-- Dato phone -->
                                    {{ pedido.phone }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    <!-- Dato precio -->
                                    {{ pedido.price }}
                                </span>
                            </td>
                            <td>
                                <!-- Botón para ver lista -->
                                <span>
                                    <button @click="verProductos(index)" type="button" class="btn btn-success">Ver productos</button>
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
                                    <button @click="borrarPedido(index)" type="button" class="btn btn-danger">Borrar</button>
                                </span>
                            </td>                            
                        </tr>    
                        <tr v-if="listProductos && idProducts == index" v-for="producto in pedido.products" class="lineProduct">
                            <td>
                                <span>
                                    <!-- Dato name -->
                                    <b>CANTIDAD: </b> {{ producto.cant }}
                                </span>
                            </td>
                            <td colspan="2">
                                <span>
                                    <!-- Dato name -->
                                    <b>NOMBRE: </b> {{ producto.name }}
                                </span>
                            </td>
                            <td colspan="3">
                                <span>
                                    <!-- Dato description -->
                                    <b>DESCRIPCION: </b>{{ producto.description }}
                                </span>
                            </td>
                            <td colspan="2">
                                <span>
                                    <!-- Dato price -->
                                    <b>PRECIO: </b>{{ producto.price }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    <!-- Dato description -->
                                    <img v-bind:src="'<?= template_url() ?>img/img_products/' + producto.main_img" alt="IMG PRODUCTO">                                
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
                    // Ver o no ver lista productos
                    listProductos: false,                    
                    // Ver o no ver el formulario de actualizar
                    formActualizar: false,
                    // La posición de tu lista donde te gustaría actualizar 
                    idActualizar: -1,
                    // La posición de tu lista donde te gustaría mostrar
                    idProducts: -1,
                    // Input nombre dentro del formulario de actualizar
                    estadoActualizar: '',                    
                    // Lista de pedidos
                    pedidos: [] 
                },
                methods: {

                    // ------ VER ACTUALIZAR ------
                    verFormActualizar: function (pedido_id) {
                        // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                        this.idActualizar = pedido_id;
                        this.estadoActualizar = this.pedidos[pedido_id].estado;
                        // Mostramos el formulario
                        this.formActualizar = true;
                    },

                    // ------ VER PRODUCTOS ------
                    verProductos: function (pedido_id) {  
                        this.idProducts = pedido_id;                                              
                        if(this.listProductos == true){
                            this.listProductos = false;
                        }else{
                            this.listProductos = true;
                        }
                    },

                    // ------ BORRAR ORDER ------
                    borrarPedido: function (pedido_id) {
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
                            data: $("#formEdit").serialize(), // serializes the form's elements.
                            success: function (respuesta) {
                                // Actualizamos los datos
                                thisCon.formActualizar = false;

                                let estadoAct = getEstado(thisCon.estado);                                
                                
                                thisCon.pedidos[pedido_id].estado = estadoAct;
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
                                 
                            let estadoName = "";
                            respuesta.forEach(element => {
                                estadoName = getEstado(element.estado);  
                                thisCon.pedidos.push({
                                    id:         element.id,
                                    locate_id:  element.locate_id,
                                    estado:     estadoName,
                                    email:      element.email,
                                    name:       element.name,
                                    id_buy:     element.id_buy,
                                    address:    element.address,
                                    phone:      element.phone,
                                    price:      element.price,
                                    products:   element.products,
                                    email:      element.email
                                });
                            });

                        }
                    });
                }                
            });

            function getEstado(estadoNum) {
                let estadoAct
                switch (estadoNum){
                    case 0:
                        estadoAct = "Solicitado";
                        break;
                    case 1:
                        estadoAct = "Enviado";
                        break;
                    case 2:
                        estadoAct = "Completado";
                        break;
                    case 3:
                        estadoAct = "Cancelado";
                        break;
                
                    default:
                        estadoAct = "Solicitado";
                        break;
                }
                return estadoAct;
            }

            
        });

    </script>
</body>
</html>