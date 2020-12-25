<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Amortización</h3>
            <br>
        </div>
        <div class="card-body">
            <div class="row">  
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="saldo_deuda">Saldo de la deuda $</label>
                        <input type="text" id="saldo_deuda" v-model="saldo_deuda" class="form-control" />        
                    </div>                          
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="abono">Abono $</label>
                        <input type="text" id="abono" v-model="abono" class="form-control" />        
                    </div>                          
                </div>    

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="monto">Monto a cobrar (Cuotas) $</label>
                        <input type="text" id="monto" v-model="monto" v-on:keyup="calcularPeriodo" class="form-control" />        
                    </div>                          
                </div>   
               
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="interes">Interés %</label>
                        <input type="text" id="interes" v-model="interes" class="form-control" />        
                    </div>                          
                </div>
   

                <div v-if="periodos != null && periodos != 0" class="col-lg-4"> 
                    <div class="form-group">
                        <label for="">Pago realizados a un plazo de {{ periodos }} mes(es)</label>
                    </div>
                </div>                
            </div>  
            <div class="row">
                <div class="col-lg-5"> 
                    <div class="form-group">
                        <button type="button" class="btn btn-success" @click="calcularAmortizacion">Calcular</button>
                        <button type="button" class="btn btn-danger" @click="reset">Nuevo</button>
                    </div>
                </div>
            </div>        
            <br>
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
                        </tr>
                  </tbody>         
                </table>
            </div>      
          </div>     
    </div>
</template>

<script>	
    export default {
        data () {
            return {
                saldo_deuda: 0.0,
                abono: 0.0,
                
                monto: 0.0,

                interes: 0.0,
                fecha: '',
                periodos: 0,
                arrayData: []
            }
        },
        
        computed: {
            calcularPeriodo() 
            {
                let me = this     
                me.periodos = Math.round((parseFloat(me.saldo_deuda) - parseFloat(me.abono)) / parseFloat(me.monto))
                return Math.round(me.periodos)
            }
        },

        methods: {
            calcularAmortizacion()
            {
                let me = this
                me.arrayData = []
        
                let object = {}

                let monto_cobrar = parseFloat(me.saldo_deuda) - parseFloat(me.abono);
                let interesDecimal = (parseFloat(me.interes) / 100);
                let denominador = Math.pow((1 / (1 + parseFloat(interesDecimal))), parseFloat(me.periodos));

                let cuota_fija = (parseFloat(interesDecimal) * parseFloat(monto_cobrar)) / (1 - parseFloat(denominador));

                let intereses = 0.0
                let amortizacion = 0.0
                let saldo_final = 0.0

                for (var i = 1; i <= me.periodos; i++) 
                {      
                    intereses = parseFloat(monto_cobrar) * parseFloat(me.interes / 100)
                    amortizacion = parseFloat(cuota_fija) - parseFloat(intereses)
                    saldo_final = parseFloat(monto_cobrar) - parseFloat(amortizacion) 
                   
                    object = {
                        id: i,
                        saldo_inicial : monto_cobrar,
                        cuota: cuota_fija,
                        interes: intereses,
                        abono: amortizacion,
                        saldo_final: (saldo_final < 0.1) ? 0 : saldo_final                  
                    }

                    me.arrayData.push(object)
                    monto_cobrar = object.saldo_final
                    object = {}

                }
            },

            reset()
            {
                let me = this
                me.saldo_deuda = 0.0
                me.abono= 0.0
                me.monto= 0.0
                me.interes= 0.0
                me.fecha= ''
                me.periodos= 0
                me.arrayData= []
            }
        },

        mounted() {
            console.log('Componente de amortizaciones montado.')
        }
    }
</script>
