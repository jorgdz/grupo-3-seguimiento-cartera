<template>
     <div class="card">
        <div class="card-header">
            <h3 class="card-title">Clientes</h3>
             <br>
                          
          	<!--Buscar-->          
            <div class="form-group">
                <div class="row">                       
                    
                    <input type="text" v-model="cedula" class="form-control col-lg-6" placeholder="Buscar por cédula del cliente" />                                                   
                    <button type="submit" class="btn btn-info" @click="search">Buscar</button>

                </div>
            </div>
     
        </div>
        <div class="card-body table-responsive">
            <ul class="pagination">
                <button class="btn btn-primary" @click="lastPage">
                    <span>Anterior</span>
                </button>
                &nbsp;
                <button class="btn btn-primary" @click="nextPage">
                    <span>Siguiente</span>
                </button>
            </ul>
            <table class="table table-bordered table-hover table-striped ">
                <thead>
                    <tr>
                        <th>Id campaña</th>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Campaña</th>
                        <th>Deuda</th>
                        <th>Saldo</th>
                	    <th>Ver</th>     
                    </tr>
                </thead>
              <tbody>
                  	<tr v-for="cliente in clientes" :key="cliente.campana">
                        <td v-text="cliente.IdCampaña"></td>
                        <td v-text="cliente.Identificacion"></td>
    	                <td v-text="cliente.Nombres"></td>
    	                <td v-text="cliente.Descripcion"></td>
    	                <td v-text="cliente.ValorDeuda"></td>
    	                <td v-text="cliente.SaldoDeuda"></td>
                        <td>    
                            <a :href="['cliente?id='+cliente.id]" class="btn btn-sm btn-primary"><i class="fa fa-dollar-sign"></i></a>
                        </td>
                  	</tr>
              </tbody>         
            </table>
          </div>     
        </div>
</template>

<script>
	import axios from 'axios';

    export default {
    	data () {
            return {
            	clientes: [],
                cedula: '',
                page: 0,
                //url: '/api/clientes'
                url: 'http://192.168.1.107/ventas/public/apiclientes'
            }
        },

        methods: {
        	getClientes(){
                let me = this
                axios.get(`${me.url}?page=1`)
                //axios.get(`${me.url}`)
                    .then(res => {
                        me.clientes = res.data.data
                        //me.clientes = res.data
                        me.page = res.data.current_page
                        console.log(me.page)
                    }).catch(err => {
                        console.error(err.message)
                    })
            },

            search(){
                let me = this
                axios.get(`${me.url}?cedula=${me.cedula}`)
                    .then(res => {
                        me.clientes = res.data.data
                        me.page = res.data.current_page
                        console.log(me.page)
                    }).catch(err => {
                        console.error(err.message)
                    });
            },

            lastPage(){
                let me = this
                axios.get(`${me.url}?page=`+(me.page-1))
                    .then(res => {
                        console.log('Pagina:'+me.page)
                        me.clientes = res.data.data
                        me.page = res.data.current_page
                        console.log(me.page)
                    }).catch(err => {
                        console.error(err.message)
                    })
            }, 
            nextPage(){
                let me = this
                axios.get(`${me.url}?page=`+(me.page+1))
                    .then(res => {
                        console.log('Pagina:'+me.page)
                        me.clientes = res.data.data
                        me.page = res.data.current_page
                        console.log(me.page)
                    }).catch(err => {
                        console.error(err.message)
                    })
            }
        },

        mounted() {
            console.log('Componente cliente montado.')
            this.getClientes();
        }
    }
</script>
