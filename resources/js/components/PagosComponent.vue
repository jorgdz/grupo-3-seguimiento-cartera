<template>
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-3">
                    <span><strong>Identificación:</strong> {{ cliente.Identificacion }} </span>
                </div>
                <div class="col-lg-3">
                    <span><strong>Cliente:</strong> {{ cliente.Nombres }} </span>
                </div>
                <div class="col-lg-3">
                    <span><strong>Dirección:</strong> {{ cliente.direccion }} </span>
                </div>
            </div>
            <div class="row" style="background-color:crimson; color: white;">   
                 <div class="col-lg-3">
                    <span><strong>Campaña:</strong> {{ cliente.Descripcion }} </span>
                </div>  
                <div class="col-lg-3">
                    <span><strong>Deuda:</strong> {{ cliente.ValorDeuda }} </span>
                </div>  
                <div class="col-lg-3">
                    <span><strong>Saldo:</strong> {{ cliente.SaldoDeuda }} </span>
                </div> 
            </div>
            <br>                
            <br>   
        </div>

        <div class="card-body">
            <template v-if="errorMostrarMsgPago.length > 0">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" @click="resetError()" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>  
                    <ul>
                        <li v-for="error in errorMostrarMsgPago" :key="error" v-text="error"></li>
                    </ul>
                </div>
            </template>
     
            <div class="row">
                <div class="col-lg-6">
                    
                    <div class="form-group">
                        <label for="abono">Abono ($)</label>
                        <input type="text" class="form-control" @keyup="validarAbonoNumerico()" v-model="abono" required="required" placeholder="Ingrese el abono">
                    </div>

                   <div class="form-group">
                        <label for="interes">Interés (%)</label>
                        <input type="text" class="form-control" @keyup="validarInteresNumerico()" v-model="interes" required="required" placeholder="Ingrese el Interés">
                    </div>

                    
                    <template v-if="calcularPeriodo != null && calcularPeriodo > 0">
                        <div class="form-group">
                            <label for="">Pago realizados a un plazo de {{ calcularPeriodo }} mes(es)</label>
                        </div>
                    </template>
                    
                </div>
                <div class="col-lg-6">                    
                    <div class="form-group">
                        <label for="periodo">Cuota a pagar del cliente</label>
                        <input type="text" class="form-control"@keyup="validarCuotaNumerico()" v-model="cuota" required="required" placeholder="Ingrese la cuota a pagar">
                    </div>
                    <div class="form-group">
                        <label for="fecha_pago">Fecha en la que realizará el primer pago</label>
                        <input type="date" v-model="fecha_pago" required="required" class="form-control">
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="button" @click="calculate" class="btn btn-sm btn-primary">Calcular amortización</button>
                    <button type="button" @click="reset" class="btn btn-sm btn-warning">Nuevo</button>
                    <button type="button" @click="postPago" class="btn btn-sm btn-success">Enviar</button>
                </div>
            </div>           
            
            <template v-if="amortizar == true"> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <button type="button" @click="donwloadPdf" class="btn btn-sm btn-info" style="float: right;">Descargar tabla</button>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th># Periodos</th>
                                    <th>Saldo inicial</th>
                                    <th>Cuota fija</th>
                                    <th>Interes</th>
                                    <th>Abono al capital</th>     
                                    <th>Saldo final</th>      
                                    <th>Fecha de pago</th>                                   
                                </tr>
                            </thead>
                          <tbody>
                                <tr v-for="(data, index) in arrayData" :key="data.id">
                                    <td>{{ index + 1  }}</td>
                                    <td>$ {{ data.saldo_inicial }}</td>
                                    <td>$ {{ data.cuota }}</td>
                                    <td>$ {{ data.interes }}</td>
                                    <td>$ {{ data.abono }}</td>
                                    <td>$ {{ data.saldo_final }}</td>                 
                                    <td>{{ data.fecha_pago }}</td>                 
                                </tr>
                          </tbody>         
                        </table>
                    </div>   
                </div>
            </template>

            <div class="row">
                <h5><strong>Plan de pago</strong></h5>
                <div class="table-responsive"> 
                    <table class="table table-bordered table-hover table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Periodo</th>
                                <th>Interés</th>
                                <th>Cuota</th>
                                <th>Abono</th>     
                                <th>Usuario</th>     
                                <th>Fecha de pago</th>     
                                <th colspan="2">Acciones</th>     
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(pago, index) in pagos" :key="pago.id">
                                <td>{{( index + 1 )}}</td>
                                <td>{{ pago.periodo }} mes(es)</td>
                                <td>{{ pago.interes }} %</td>
                                <td>$ {{ pago.cuota }}</td>
                                <td>$ {{ pago.abono }}</td>
                                <td>{{ pago.user.usuario }}</td>
                                <td>{{ pago.fecha_pago }}</td>
                        
                                <td>    
                                    <a :href="['/pagos/detalles/pago/' + pago.id]" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                </td>
                                <td>    
                                    <button type="button" @click="deletePago(pago.id)" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></button>
                                </td>

                            </tr>
                        </tbody>         
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	import axios from 'axios'
    import swal from 'sweetalert2'
    import jsPDF from 'jspdf';
    import autoTable from 'jspdf-autotable';

    export default {
        props: ['id'],
    	data () {
            return {
                idcampana: String(this.id),
               
                cliente: {},
                pagos: [],
                url: 'http://192.168.1.107/ventas/public/',

                abono: 0.0,
                periodo: 0,
                interes: 0.0,
                fecha_pago: '',

                cuota: 0.0,

                errorMostrarMsgPago: [],
                errorPago: 0,

                amortizar: false,
                arrayData : []
            }
        },
        
        computed: {
            calcularPeriodo() 
            {
                let me = this     
                me.periodo = Math.round((parseFloat(me.cliente.SaldoDeuda) - parseFloat(me.abono)) / parseFloat(me.cuota))
                return Math.round(me.periodo)
            }
        },

        methods: {
            getCampanaCliente()
            {
                let me = this
                axios.get(`${me.url}apiclientes?id=${me.idcampana}`)
                    .then(res => {
                        me.cliente = res.data 
                    }).catch(err => {
                        console.log(err)
                    })
            },

            getPagos()
            {
                let me = this
                axios.get(`/apipago/index?id=${me.idcampana}`)
                    .then(res => {
                        me.pagos = res.data 
                        console.log(me.pagos);
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },

            nuevaFecha(fecha, intervalo, dma) {
                let arrayFecha = fecha.split('-')
                let anio = arrayFecha[0]
                let mes = arrayFecha[1]
                let dia = arrayFecha[2]  
                  
                let fechaInicial = new Date(anio, mes - 1, dia);
                let fechaFinal = fechaInicial;

                if(dma=="m" || dma=="M")
                {
                    fechaFinal.setMonth(fechaInicial.getMonth() + parseInt(intervalo));
                }
                else if(dma=="y" || dma=="Y")
                {
                    fechaFinal.setFullYear(fechaInicial.getFullYear() + parseInt(intervalo));
                }
                else if(dma=="d" || dma=="D")
                {
                    fechaFinal.setDate(fechaInicial.getDate() + parseInt(intervalo));
                }
                else
                {
                    return fecha;
                }

                dia = fechaFinal.getDate();
                mes = fechaFinal.getMonth() + 1;
                anio = fechaFinal.getFullYear();
                 
                dia = (dia.toString().length == 1) ? "0" + dia.toString() : dia;
                mes = (mes.toString().length == 1) ? "0" + mes.toString() : mes;
                 
                return anio + "-" + mes + "-" + dia;
            },

            formatDate(date) {
                let arrayFecha = date.split('-')
                let year = arrayFecha[0]
                let month = arrayFecha[1]
                let day = arrayFecha[2]  
                  
                let fecha = new Date(year, month - 1, day);
                let meses = [
                    "Enero", "Febrero", "Marzo",
                    "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre",
                    "Noviembre", "Diciembre"
                ];

                let dia = fecha.getDate();
                let mesIndice = fecha.getMonth();
                let anio = fecha.getFullYear();

                return dia + '/' + meses[mesIndice] + '/' + anio;
            },
            calculate()
            {
                if(this.validate())
                {
                    return
                }
                else
                {
                    let me = this

                    if (me.cliente.SaldoDeuda < 0.1)
                    {
                        swal(
                            'Error',
                            'El cliente no tiene deuda para crear un plan de pago',
                            'error'
                        )
                    }
                    else
                    {  
                        me.amortizar = true

                        me.arrayData = []
                
                        let object = {}

                        let monto_cobrar = Math.round(parseFloat(me.cliente.SaldoDeuda) - parseFloat(me.abono), 3);
                        let interesDecimal = (parseFloat(me.interes) / 100);
                        let denominador = Math.pow((1 / (1 + parseFloat(interesDecimal))), parseFloat(me.periodo));

                        let cuota_fija = (parseFloat(interesDecimal) * parseFloat(monto_cobrar)) / (1 - parseFloat(denominador));

                        let intereses = 0.0
                        let amortizacion = 0.0
                        let saldo_final = 0.0

                        for (var i = 1; i <= me.periodo; i++) 
                        {      
                            intereses = parseFloat(monto_cobrar) * parseFloat(me.interes / 100)
                            amortizacion = parseFloat(cuota_fija) - parseFloat(intereses)
                            saldo_final = parseFloat(monto_cobrar) - parseFloat(amortizacion) 
                            
                            object = {
                                id: i,
                                saldo_inicial: monto_cobrar,
                                cuota: cuota_fija,
                                interes: intereses,
                                abono: amortizacion,
                                fecha_pago: me.formatDate(me.nuevaFecha(me.fecha_pago, '+'+i, 'm')),
                                saldo_final: (saldo_final < 0.1) ? 0 : saldo_final                  
                            }

                            me.arrayData.push(object)
                            monto_cobrar = object.saldo_final
                            object = {}
                        }
                    }
                }
            },  

            donwloadPdf()
            {
                let me = this
                let doc = new jsPDF('p', 'pt');
            
                let columns = [
                    {title: "# Periodos", dataKey: "id"},
                    {title: "Saldo inicial", dataKey: "saldo_inicial"},
                    {title: "Cuota fija", dataKey: "cuota"},
                    {title: "Interés", dataKey: "interes"},
                    {title: "Abono", dataKey: "abono"},
                    {title: "Fecha de pago", dataKey: "fecha_pago"},
                    {title: "Saldo final", dataKey: "saldo_final"},
                ];

                doc.text('Amortización del cliente '+me.cliente.Nombres, 10, 18)
                doc.autoTable(columns, me.arrayData)
                doc.save('amortizacion-'+(me.cliente.IdCampaña + me.cliente.Identificacion)+'.pdf')
            },

            postPago()
            {
                if(this.validate())
                {
                    return
                }
                else
                {
                    let me = this

                    if (me.cliente.SaldoDeuda < 0.1)
                    {
                        swal(
                            'Error',
                            'El cliente no tiene deuda para crear un plan de pago',
                            'error'
                        )
                    }
                    else
                    {
                        let monto_cobrar = parseFloat(me.cliente.SaldoDeuda) - parseFloat(me.abono);
                        let interesDecimal = (parseFloat(me.interes) / 100);
                        let denominador = Math.pow((1 / (1 + parseFloat(interesDecimal))), parseFloat(me.periodo));
                        
                        let cuota = (parseFloat(interesDecimal) * parseFloat(monto_cobrar)) / (1 - parseFloat(denominador));

                        axios.post(`/apipago/store`, {
                            'campania_idc': (me.cliente.IdCampaña + me.cliente.Identificacion),
                            'periodo': me.periodo,
                            'interes': me.interes,
                            'cuota': cuota,
                            'abono': me.abono,
                            'fecha_pago': me.fecha_pago,
                            'monto_cobrar' : monto_cobrar,
                            'nombres': me.cliente.Nombres,
                            'saldoDeuda': me.cliente.SaldoDeuda,
                            'valorDeuda': me.cliente.ValorDeuda,
                            'campania': me.cliente.Descripcion
                        }).then(res => {
                            me.getPagos()
                            me.amortizar = false
                            swal(
                                'Correcto',
                                res.data.success,
                                'success'
                            )

                            me.resetError()
                          
                            me.reset()
                            monto_cobrar = 0.0
                            interesDecimal = 0.0
                            cuota = 0.0

                        }).catch(err => {
                            console.log(err.response.data)

                            me.amortizar = false

                            monto_cobrar = 0.0
                            interesDecimal = 0.0
                            cuota = 0.0
                            swal(
                                'Error',
                                err.response.data,
                                'error'
                            )
                        })
                    }
                    
                }
            },

            deletePago(id)
            {
                swal({
                    title: '¿Seguro que quieres eliminar el pago?',
                    text: "No podrás revertir esta acción luego",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si, borrarlo!'
                }).then((result) => {
                    if (result.value) 
                    {
                        let me = this
                        axios.delete('/apipago/'+id)
                        .then( res => {
                            me.getPagos()

                            swal(
                            'Borrarlo!',
                            'Pago eliminado.',
                            'success'
                            )
                        })
                        .catch( err => {
                            console.log(err)
                            let error = err.response.data
                            if (err.response.data == 'Unauthorized.') 
                            {
                                error = 'Usuario con rol no autorizado'
                            }

                            swal(
                                'Error',
                                error,
                                'error'
                            )
                        })
                    }
                })
            },

            validarAbonoNumerico()
            {
                let out = ''
                let filtro = '1234567890.'
                
                for (let i=0; i < this.abono.length; i++)
                if (filtro.indexOf(this.abono.charAt(i)) != -1) 
                    out += this.abono.charAt(i)
                this.abono = out
            },

            validarCuotaNumerico()
            {
                let out = ''
                let filtro = '1234567890.'
                
                for (let i=0; i < this.cuota.length; i++)
                if (filtro.indexOf(this.cuota.charAt(i)) != -1) 
                    out += this.cuota.charAt(i)
                this.cuota = out
            },

            validarInteresNumerico()
            {
                let out = ''
                let filtro = '1234567890.'
                
                for (let i=0; i < this.interes.length; i++)
                if (filtro.indexOf(this.interes.charAt(i)) != -1) 
                    out += this.interes.charAt(i)
                this.interes = out
            },

            resetError()
            {
                this.errorMostrarMsgPago = []
                this.errorPago = 0
            },

            reset()
            {
                let me = this
                me.fecha_pago = ''
                me.periodo = 0
                me.abono = 0.0
                me.interes = 0.0
                me.cuota = 0.0
                me.arrayData = []
                me.amortizar = false
            },

            validate () 
            {
                this.errorPago = 0
                this.errorMostrarMsgPago = []

                if(!this.abono || this.abono < 0) this.errorMostrarMsgPago.push("El abono no puede estar vacío")
                if(!this.periodo || this.periodo <= 0 || this.periodo == 'Infinity') this.errorMostrarMsgPago.push("El periodo no puede estar vacío")
                if(!this.cuota || this.cuota <= 0) this.errorMostrarMsgPago.push("Debe especificar la cuota")
                if(!this.interes || this.interes <= 0) this.errorMostrarMsgPago.push("El interés no puede estar vacío ni ser menor o igual a 0")
                if(!this.fecha_pago) this.errorMostrarMsgPago.push("La fecha de pago no puede estar vacío")
                
                if (this.errorMostrarMsgPago.length) this.errorPago = 1
                return this.errorPago
            }
        },

        mounted() 
        {
            console.log('Componente pagos montado.')
            this.getCampanaCliente()
            this.getPagos()
        }
    }
</script>
